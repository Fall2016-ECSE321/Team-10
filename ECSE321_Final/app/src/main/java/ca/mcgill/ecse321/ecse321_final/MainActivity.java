package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    // Go to staff menu
    public void staff(View v) {
        startActivity(new Intent(MainActivity.this, StaffActivity.class));
        MainActivity.this.finish();
    }

    // Go to inventory menu
    public void inventory(View v) {
        startActivity(new Intent(MainActivity.this, InventoryActivity.class));
        MainActivity.this.finish();
    }

    // Go to food menu
    public void menu(View v) {
        startActivity(new Intent(MainActivity.this, MenuActivity.class));
        MainActivity.this.finish();
    }

    // Go to order menu
    public void orders(View v) {
        startActivity(new Intent(MainActivity.this, OrderActivity.class));
        MainActivity.this.finish();
    }

    // Go to help menu
    public void help(View v) {
        startActivity(new Intent(MainActivity.this, HelpActivity.class));
        MainActivity.this.finish();
    }
}
