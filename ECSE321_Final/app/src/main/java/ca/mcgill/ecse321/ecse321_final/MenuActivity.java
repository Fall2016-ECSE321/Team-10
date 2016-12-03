package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;

import static ca.mcgill.ecse321.ecse321_final.ioStream.createCachedFile;
import static ca.mcgill.ecse321.ecse321_final.ioStream.readCachedFile;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isInteger;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isDouble;

public class MenuActivity extends AppCompatActivity {
    ArrayList<String> menuItemList, menuItemPriceList, menuItemOrderedList;
    ArrayAdapter<String> adapterMenuList;
    EditText newMenuItem_name, newMenuItem_price, newMenuItem_ordered;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);

        final ListView listMenuView = (ListView)findViewById(R.id.listMenuItem);

        // Read from the lists and create them as empty lists if not existent
        try {
            menuItemList = (ArrayList<String>)readCachedFile (MenuActivity.this, "menuList");
            menuItemPriceList = (ArrayList<String>)readCachedFile (MenuActivity.this, "menuPrice");
            menuItemOrderedList = (ArrayList<String>)readCachedFile (MenuActivity.this, "menuOrdered");
        } catch (IOException e) {
            String[] menuname = {};
            String[] menuprice = {};
            String[] menuordered = {};
            menuItemList = new ArrayList<>(Arrays.asList(menuname));
            menuItemPriceList = new ArrayList<>(Arrays.asList(menuprice));
            menuItemOrderedList = new ArrayList<>(Arrays.asList(menuordered));
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            String[] menuname = {};
            String[] menuprice = {};
            String[] menuordered = {};
            menuItemList = new ArrayList<>(Arrays.asList(menuname));
            menuItemPriceList = new ArrayList<>(Arrays.asList(menuprice));
            menuItemOrderedList = new ArrayList<>(Arrays.asList(menuordered));
            e.printStackTrace();
        }

        // Set adapters
        adapterMenuList = new ArrayAdapter<String>(this, R.layout.menulist_item, R.id.menuitemname, menuItemList);
        listMenuView.setAdapter(adapterMenuList);

        newMenuItem_name = (EditText)findViewById(R.id.newMenuItem_name);
        newMenuItem_price = (EditText)findViewById(R.id.newMenuItem_price);
        newMenuItem_ordered = (EditText)findViewById(R.id.newMenuItem_ordered);

        // Listening to single list item on click
        listMenuView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                // Selected item
                String menu = listMenuView.getItemAtPosition(position).toString();

                // Launching new Activity on selecting single List Item
                Intent m = new Intent(getApplicationContext(), MenuListActivity.class);

                // Sending data to new activity
                m.putExtra("newMenuItem", menu);
                startActivity(m);
                MenuActivity.this.finish();
            }
        });
        refreshData();
    }

    // Refresh screen function
    private void refreshData() {
        TextView tv1 = (TextView) findViewById(R.id.newMenuItem_name);
        TextView tv2 = (TextView) findViewById(R.id.newMenuItem_price);
        TextView tv3 = (TextView) findViewById(R.id.newMenuItem_ordered);
        tv1.setText("");
        tv2.setText("");
        tv3.setText("");
        adapterMenuList.notifyDataSetChanged();
    }

    // Go back to main menu
    public void mainMenu(View v) {
        startActivity(new Intent(MenuActivity.this, MainActivity.class));
        MenuActivity.this.finish();
    }

    // Add Item function
    public void addMenuItem(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView) findViewById(R.id.error);

        // Get the new inputs
        String newItem = newMenuItem_name.getText().toString();
        String newPrice = newMenuItem_price.getText().toString();
        String newOrdered = newMenuItem_ordered.getText().toString();

        // Error checking
        if (newItem.equals("") || newPrice.equals("") || newOrdered.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newOrdered)) {
            errorTextView.setText("Number Ordered must be an integer!");
        } else if (isInteger(newItem) || isDouble(newItem)) {
            errorTextView.setText("Name can not be a number!");
        } else if (!isDouble(newPrice)) {
            errorTextView.setText("Price must be a double!");
        } else {
            // Add new inputs
            menuItemList.add(newItem);
            menuItemPriceList.add(newPrice);
            menuItemOrderedList.add(newOrdered);

            adapterMenuList.notifyDataSetChanged();
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (MenuActivity.this, "menuList", menuItemList);
            createCachedFile (MenuActivity.this, "menuPrice", menuItemPriceList);
            createCachedFile (MenuActivity.this, "menuOrdered", menuItemOrderedList);
        }
        refreshData();
    }
}
