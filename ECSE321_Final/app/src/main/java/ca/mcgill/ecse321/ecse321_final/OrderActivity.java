package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.util.ArrayList;

import static ca.mcgill.ecse321.ecse321_final.ioStream.createCachedFile;
import static ca.mcgill.ecse321.ecse321_final.ioStream.readCachedFile;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isInteger;

public class OrderActivity extends AppCompatActivity {
    int index;
    ArrayList<String> tempMenuItemList, tempMenuItemOrderedList;
    EditText newmenuItem_name, newmenuItem_ordered;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order);

        // Read from the lists and create them as empty lists if not existent
        try {
            tempMenuItemList = (ArrayList<String>)readCachedFile (OrderActivity.this, "menuList");
            tempMenuItemOrderedList = (ArrayList<String>)readCachedFile (OrderActivity.this, "menuOrdered");
        } catch (IOException e) {
            e.printStackTrace();
            // Display toast messages if there is no menu item yet
            Toast.makeText(getApplicationContext(),"Please add menu items first!",Toast.LENGTH_LONG).show();
            startActivity(new Intent(OrderActivity.this, MainActivity.class));
            OrderActivity.this.finish();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            // Display toast messages if there is no menu item yet
            Toast.makeText(getApplicationContext(),"Please add menu items first!",Toast.LENGTH_LONG).show();
            startActivity(new Intent(OrderActivity.this, MainActivity.class));
            OrderActivity.this.finish();
        }

        newmenuItem_name = (EditText)findViewById(R.id.order_name);
        newmenuItem_ordered = (EditText)findViewById(R.id.ordered_number);

        refreshData();
    }

    // Refresh screen function
    private void refreshData() {
        TextView tv1 = (TextView) findViewById(R.id.order_name);
        TextView tv2 = (TextView) findViewById(R.id.ordered_number);
        tv1.setText("");
        tv2.setText("");
    }

    // Go back to main menu
    public void mainMenu(View v) {
        startActivity(new Intent(OrderActivity.this, MainActivity.class));
        OrderActivity.this.finish();
    }

    // Add order function
    public void add(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView) findViewById(R.id.error);
        int tempInt1 = 0, tempInt2 = 0;

        // Get the new inputs
        String newItem = newmenuItem_name.getText().toString();
        String newOrdered = newmenuItem_ordered.getText().toString();

        // Error checking
        if (newItem.equals("") || newOrdered.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newOrdered)) {
            errorTextView.setText("Number Ordered must be an integer!");
        } else if (isInteger(newItem)) {
            errorTextView.setText("Item name can not be a number!");
        } else {
            index = tempMenuItemList.indexOf(newItem);

            if (index == -1) { // If item don't exist
                errorTextView.setText("Item nonexistent!");
            } else { // If item exists, add the new number to the old one
                tempInt1 = Integer.parseInt(newOrdered);
                tempInt2 = Integer.parseInt(tempMenuItemOrderedList.get(index));
                tempMenuItemOrderedList.set(index, String.valueOf(tempInt1 + tempInt2));
                errorTextView.setText("");

                // Overwrite previous files
                createCachedFile(OrderActivity.this, "menuOrdered", tempMenuItemOrderedList);
            }
        }
        refreshData();
    }
}
