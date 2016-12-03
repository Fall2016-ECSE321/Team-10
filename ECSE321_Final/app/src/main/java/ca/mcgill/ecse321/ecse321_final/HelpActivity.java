package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class HelpActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_help);
    }

    // Go back to main menu
    public void mainMenu(View v) {
        startActivity(new Intent(HelpActivity.this, MainActivity.class));
        HelpActivity.this.finish();
    }
}
