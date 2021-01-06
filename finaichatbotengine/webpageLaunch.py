from flask import Flask, render_template
import subprocess

app = Flask(__name__)


@app.route("/chatbot")
def index():
    return render_template('chatbox.html'), subprocess.call(["python", "chatgui.py"])


if __name__ == "__main__":
    app.run(debug='True')
