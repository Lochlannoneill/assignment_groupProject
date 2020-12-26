package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;

public class LoginActivity extends AppCompatActivity {
    EditText editEmail, editPassword, editName;
    Button registerButton, loginButton;

    String URL = "http://192.168.42.110/finai/index.php";

    JSONParser jsonParser = new JSONParser();

    int i = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_activity);

        editEmail=(EditText)findViewById(R.id.email);
        editName=(EditText)findViewById(R.id.username);
        editPassword=(EditText)findViewById(R.id.password);

        loginButton=(Button)findViewById(R.id.loginButton);
        registerButton=(Button)findViewById(R.id.registerButton);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AttemptLogin attemptLogin= new AttemptLogin();
                attemptLogin.execute(editName.getText().toString(),editPassword.getText().toString(),"");
            }
        });

        registerButton.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view){
                if(i==0){
                    i=1;
                    editEmail.setVisibility(View.VISIBLE);
                    loginButton.setVisibility(View.INVISIBLE);
                }else{
                    registerButton.setText("Register");
                    editEmail.setVisibility(View.GONE);
                    loginButton.setVisibility(View.VISIBLE);
                    i=0;
                    AttemptLogin attemptLogin= new AttemptLogin();
                    attemptLogin.execute(editName.getText().toString(),editPassword.getText().toString(),editEmail.getText().toString());
                    onPostExecute(attemptLogin.json);
                }
            }
        });
    }

    private class AttemptLogin extends AsyncTask<String, String, JSONObject> {
        JSONObject json;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            Intent intent_name = new Intent();
            intent_name.setClass(getApplicationContext(),MainActivity.class);
            startActivity(intent_name); ///Logs in either way
        }

        @Override
        protected JSONObject doInBackground(String... args) {
            String email = args[2];
            String password = args[1];
            String name= args[0];

            ArrayList params = new ArrayList();
            params.add(new BasicNameValuePair("username", name));
            params.add(new BasicNameValuePair("password", password));
            if(email.length()>0)
                params.add(new BasicNameValuePair("email",email));
            JSONObject json = jsonParser.makeHttpRequest(URL, "POST", params);
            this.json = json;
            return json;
        }
    }

    protected void onPostExecute(JSONObject result){
        try {
            if (result != null) {
                Toast.makeText(getApplicationContext(),result.getString("message"),Toast.LENGTH_LONG).show();
                if(result.getString("message").equals("Successfully logged in")){
                    System.out.println("LOGGED IN");
                    Intent intent_name = new Intent(LoginActivity.this,MainActivity.class);
//                  intent_name.setClass(getApplicationContext(),MainActivity.class);
                    startActivity(intent_name); ///Logs in either way
                    finish();
                }
            }else {
                Toast.makeText(getApplicationContext(), "Unable to retrieve any data from server", Toast.LENGTH_LONG).show();
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}