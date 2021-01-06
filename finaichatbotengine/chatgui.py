import json
import random
import pickle
import nltk
import numpy as np
import csv
import pandas as pd
from collections import defaultdict
from sklearn import tree
from tkinter import *
from nltk.stem import WordNetLemmatizer
from keras.models import load_model
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier, DecisionTreeRegressor

lemmatizer = WordNetLemmatizer()
model = load_model('chatbot_model.h5')

intents = json.loads(open('intents.json').read())
words = pickle.load(open('words.pkl', 'rb'))
classes = pickle.load(open('classes.pkl', 'rb'))


def trainLoan():

    df = pd.read_csv("./csvs/train.csv", encoding="ISO-8859-1")

    flt = df[['Gender', 'Self_Employed', 'ApplicantIncome', 'LoanAmount', 'Loan_Status']].copy()

    # All the empty cells from Gender attributes are filled in with the value with the highest frequency
    HighGender = max(flt['Gender'].value_counts())
    AllGender = flt['Gender'].value_counts()
    IndHighFreqGender = AllGender[AllGender == HighGender].index[0]
    flt['Gender'] = flt['Gender'].fillna(IndHighFreqGender)

    # All the empty cells from Self_Employed attributes are filled in with the value with the highest frequency
    HighSelfEmployed = max(flt['Self_Employed'].value_counts())
    AllSelfEmployed = flt['Self_Employed'].value_counts()
    IndHighFreqSelfEmployed = AllSelfEmployed[AllSelfEmployed == HighSelfEmployed].index[0]
    flt['Self_Employed'] = flt['Self_Employed'].fillna(IndHighFreqSelfEmployed)

    flt = df[['Gender', 'Self_Employed', 'ApplicantIncome', 'LoanAmount', 'Loan_Status']].dropna()

    # Convert the categorical values in Gender attribute to numerical values
    allGenders = np.unique(flt['Gender'].astype(str))
    dict1 = {}
    c = 1

    for ac in allGenders:
        dict1[ac] = c
        c = c + 1

    flt['Gender'] = flt['Gender'].map(dict1)

    # print(dict1)

    # Convert the categorical values in Self_Employed attribute to numerical values
    allSelfEmployed = np.unique(flt['Self_Employed'].astype(str))
    dict2 = {}
    c = 1

    for ac in allSelfEmployed:
        dict2[ac] = c
        c = c + 1

    flt['Self_Employed'] = flt['Self_Employed'].map(dict2)

    # print(dict2)

    # Convert the categorical values in LoanStatus attribute to numerical values
    allLoans = np.unique(flt['Loan_Status'].astype(str))
    dict3 = {}
    c = 1

    for ac in allLoans:
        dict3[ac] = c
        c = c + 1

    flt['Loan_Status'] = flt['Loan_Status'].map(dict3)

    # print(dict3)

    X = (flt[['Gender', 'Self_Employed', 'LoanAmount', 'Loan_Status']])

    y = flt[['ApplicantIncome']]

    tree_clf = tree.DecisionTreeClassifier()

    print("###########")
    # Benchmark Comparison
    tree_clf.fit(X, y)
    print("Benchmark: ", tree_clf.score(X, y))

    # Use 65% of the data individuals as test set and the remaining as training set

    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.65, random_state=42)

    tree_clf33 = DecisionTreeClassifier()

    tree_clf33.fit(X_train, y_train)

    print('Training (35%):', tree_clf.score(X_train, y_train))

    print('Testing (65%):', tree_clf.score(X_test, y_test))

    DT_model = DecisionTreeRegressor(max_depth=5).fit(X_train, y_train)
    DT_predict = DT_model.predict(X_test)  # Predictions on Testing data
    print("Predicted Income:", np.mean(DT_predict))
    print("###########")
    print("")
    return np.mean(DT_predict)


def trainHouse():

    df = pd.read_csv("./csvs/houses.csv", encoding="ISO-8859-1")

    flt = df[['price', 'bedrooms', 'bathrooms', 'floors', 'grade']].copy()

    X = (flt[['bedrooms', 'bathrooms', 'floors', 'grade']])

    y = flt[['price']]

    tree_clf = tree.DecisionTreeClassifier()

    print("###########")
    # Benchmark Comparison
    tree_clf.fit(X, y)
    print("Benchmark: ", tree_clf.score(X, y))

    # Use 65% of the data individuals as test set and the remaining as training set

    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.65, random_state=42)

    tree_clf33 = DecisionTreeClassifier()

    tree_clf33.fit(X_train, y_train)

    print('Training (35%):', tree_clf.score(X_train, y_train))

    print('Testing (65%):', tree_clf.score(X_test, y_test))

    DT_model = DecisionTreeRegressor(max_depth=5).fit(X_train, y_train)
    DT_predict = DT_model.predict(X_test)  # Predictions on Testing data
    print("Predicted House Price:", np.mean(DT_predict))
    print("###########")
    print("")
    return np.mean(DT_predict)


def clean_up_sentence(sentence):
    # tokenize the pattern - split words into array
    sentence_words = nltk.word_tokenize(sentence)
    # stem each word - create short form for word
    sentence_words = [lemmatizer.lemmatize(word.lower()) for word in sentence_words]
    return sentence_words


def bow(sentence, words, show_details=True):
    # tokenize the pattern
    sentence_words = clean_up_sentence(sentence)
    # bag of words - matrix of N words, vocabulary matrix
    bag = [0] * len(words)
    for s in sentence_words:
        for i, w in enumerate(words):
            if w == s:
                # assign 1 if current word is in the vocabulary position
                bag[i] = 1
                if show_details:
                    print("found in bag: %s" % w)
    return np.array(bag)


def predict_class(sentence, model):
    # filter out predictions below a threshold
    p = bow(sentence, words, show_details=False)
    res = model.predict(np.array([p]))[0]
    ERROR_THRESHOLD = 0.25
    results = [[i, r] for i, r in enumerate(res) if r > ERROR_THRESHOLD]
    # sort by strength of probability
    results.sort(key=lambda x: x[1], reverse=True)
    return_list = []
    for r in results:
        return_list.append({"intent": classes[r[0]], "probability": str(r[1])})
    return return_list


def getResponse(ints, intents_json):
    tag = ints[0]['intent']
    list_of_intents = intents_json['intents']
    for i in list_of_intents:
        if i['tag'] == tag:
            result = random.choice(i['responses'])
            break
    return result


def chatbot_response(msg):
    ints = predict_class(msg, model)
    res = getResponse(ints, intents)
    return res


def send():
    msg = EntryBox.get("1.0", 'end-1c').strip()
    EntryBox.delete("0.0", END)

    adminLogIn = True

    if msg != '':

        if msg == "/quit" or msg == "quit":
            sys.exit()

        ChatLog.config(state=NORMAL)
        ChatLog.insert(END, "You: " + msg + '\n\n')
        ChatLog.config(foreground="#442265", font=("Verdana", 12))

        if msg == "/signIn":
            ChatLog.insert(END, "Bot: Enter your username and password \n(Eg: aSignIn/bSignIn/cSignIn, BillyB, Pwd123)\n(a = Admin, b = Broker, c = Client)" + '\n\n')

        elif msg == "/requestLoan":
            ChatLog.insert(END, "Bot: Enter name (Eg: requestLoan, BillyB)\n\n")

        elif msg == "/requestHouse":
            ChatLog.insert(END, "Bot: Enter name (Eg: requestHouse, BillyB)\n\n")

        elif msg.startswith("aSignIn"):
            result = adminSignIn(msg)
            if result:
                ChatLog.insert(END, "Admin Sign In Successful!" + '\n\n')
            else:
                ChatLog.insert(END, "Command Failed! Try again!" + '\n\n')

        elif msg.startswith("bSignIn"):
            result = brokerSignIn(msg)
            if result:
                ChatLog.insert(END, "Broker Sign In Successful!" + '\n\n')
            else:
                ChatLog.insert(END, "Command Failed! Try again!" + '\n\n')

        elif msg.startswith("cSignIn"):
            result = clientSignIn(msg)
            if result:
                ChatLog.insert(END, "Client Sign In Successful!" + '\n\n')
            else:
                ChatLog.insert(END, "Command Failed! Try again!" + '\n\n')

        elif msg.startswith("requestLoan"):
            name, income = requestLoan(msg)
            if float(income) >= float(predictedLoan):
                ChatLog.insert(END, "Bot: " + name + " is suitable for a loan!\n\n")
            else:
                ChatLog.insert(END, "Bot: " + name + " is NOT suitable for a loan.\n\n")

        elif msg.startswith("requestHouse"):
            result = True
            name = requestHouse(msg)
            if result:
                ChatLog.insert(END, "Bot: " + name + " is suitable for a House Mortgage (>=€", predicatedHousePrice, ")!\n\n")
            else:
                ChatLog.insert(END, "Bot: " + name + " is NOT suitable for a House Mortgage\n\n")

        elif msg == "/create" or msg == "/export":
            if not adminLogIn:
                ChatLog.insert(END, "Must be logged in as Admin to access these features!\n\n")
            else:
                ChatLog.insert(END, "Access Granted!\n\n")

        else:
            res = chatbot_response(msg)
            ChatLog.insert(END, "Bot: " + res + '\n\n')

        ChatLog.config(state=DISABLED)
        ChatLog.yview(END)


def adminSignIn(namePassword):
    columns = defaultdict(list)

    with open('./csvs/finai_admin.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            for (k, v) in row.items():
                columns[k].append(v)

    admin_names = []
    admin_passwords = []

    for i in columns['admin_username']:
        admin_names.append(i)

    for i in columns['admin_pwd']:
        admin_passwords.append(i)

    try:

        split = namePassword.split(", ")
        name = split[1]
        password = split[2]

        if name in admin_names and password in admin_passwords:
            if admin_names.index(name) == admin_passwords.index(password):
                return True
        else:
            return False

    except (ValueError, IndexError):
        return False



def brokerSignIn(name):
    columns = defaultdict(list)

    with open('./csvs/finai_broker.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            for (k, v) in row.items():
                columns[k].append(v)

    broker_name = []

    for i in columns['broker_username']:
        broker_name.append(i)

    try:

        split = name.split(", ")
        name = split[1]

        if name in broker_name:
            return True
        else:
            return False

    except(ValueError, IndexError):
        return False


def clientSignIn(namePassword):
    columns = defaultdict(list)

    with open('./csvs/finai_client.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            for (k, v) in row.items():
                columns[k].append(v)

    client_names = []
    client_passwords = []

    for i in columns['username']:
        client_names.append(i)

    for i in columns['user_pwd']:
        client_passwords.append(i)

    try:

        split = namePassword.split(", ")
        name = split[1]
        password = split[2]

        if name in client_names and password in client_passwords:
            if client_names.index(name) == client_passwords.index(password):
                return True
        else:
            return False

    except(ValueError, IndexError):
        return False


def requestLoan(name):
    columns = defaultdict(list)

    with open('./csvs/finai_broker.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            for (k, v) in row.items():
                columns[k].append(v)

    broker_name = []
    broker_incomes = []

    for i in columns['broker_username']:
        broker_name.append(i)

    for i in columns['broker_income']:
        broker_incomes.append(i)

    split = name.split(", ")
    name = split[1]

    try:
        if name in broker_name:
            return name, broker_incomes[broker_name.index(name)]

    except ValueError:
        return "ERROR"
    except IndexError:
        return "ERROR"


def requestHouse(name):
    columns = defaultdict(list)

    with open('./csvs/finai_broker.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            for (k, v) in row.items():
                columns[k].append(v)

    broker_name = []
    broker_incomes = []

    for i in columns['broker_username']:
        broker_name.append(i)

    for i in columns['broker_income']:
        broker_incomes.append(i)

    split = name.split(", ")
    name = split[1]

    try:
        if name in broker_name:
            if float(broker_incomes[broker_name.index(name)]) > float(predictedLoan):
                if int(broker_incomes[broker_name.index(name)] * 120) > float(predicatedHousePrice):
                    return name

    except ValueError:
        return "ERROR"
    except IndexError:
        return "ERROR"


predictedLoan = trainLoan()
predicatedHousePrice = trainHouse()
base = Tk()
base.iconbitmap('icon.ico')
base.title("Type 'Hello' to Begin")
base.geometry("650x500")
base.resizable(width=FALSE, height=FALSE)

# Create Chat window
ChatLog = Text(base, bd=0, bg="#F0F0F0", height="8", width="50", font="Arial", )

ChatLog.config(state=DISABLED)

# Bind scrollbar to Chat window
scrollbar = Scrollbar(base, command=ChatLog.yview, cursor="heart")
ChatLog['yscrollcommand'] = scrollbar.set

# Create Button to send message
SendButton = Button(base, font=("Verdana", 12, 'bold'), text="Send", width="12", height=5,
                    bd=0, bg="#32de97", activebackground="#3c9d9b", fg='#ffffff',
                    command=send)

# Create the box to enter message
EntryBox = Text(base, bd=0, bg="white", width="29", height="5", font="Arial")
# EntryBox.bind("<Return>", send)

# Place all components on the screen
scrollbar.place(x=630, y=6, height=386)
ChatLog.place(x=6, y=6, height=386, width=630)
EntryBox.place(x=150, y=401, height=90, width=450)
SendButton.place(x=6, y=401, height=90)

base.mainloop()
