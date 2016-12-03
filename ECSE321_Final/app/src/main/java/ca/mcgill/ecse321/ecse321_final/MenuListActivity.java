package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;

import static ca.mcgill.ecse321.ecse321_final.ioStream.createCachedFile;
import static ca.mcgill.ecse321.ecse321_final.ioStream.readCachedFile;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isInteger;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isDouble;

public class MenuListActivity extends AppCompatActivity {
    int index;
    ArrayList<String> tempMenuItemList, tempMenuItemPriceList, tempMenuItemOrderedList, emptyList;
    EditText newmenuItem_name, newmenuItem_price, newmenuItem_ordered;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_list);

        // Read from the lists and create them as empty lists if not existent
        try {
            tempMenuItemList = (ArrayList<String>)readCachedFile (MenuListActivity.this, "menuList");
            tempMenuItemPriceList = (ArrayList<String>)readCachedFile (MenuListActivity.this, "menuPrice");
            tempMenuItemOrderedList = (ArrayList<String>)readCachedFile (MenuListActivity.this, "menuOrdered");
        } catch (IOException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

        // Get the ingredient name and index number
        Intent m = getIntent();
        TextView itemMenu = (TextView) findViewById(R.id.newMenuItem_name);
        TextView priceMenu = (TextView) findViewById(R.id.newMenuItem_price);
        TextView orderedMenu = (TextView) findViewById(R.id.newMenuItem_ordered);

        // Getting attached intent data
        String itemName = m.getStringExtra("newMenuItem");

        // Get index
        index = tempMenuItemList.indexOf(itemName);

        // Displaying selected product name and numbers
        priceMenu.setText(tempMenuItemPriceList.get(index));
        orderedMenu.setText(tempMenuItemOrderedList.get(index));
        itemMenu.setText(itemName);
        newmenuItem_name = (EditText)findViewById(R.id.newMenuItem_name);
        newmenuItem_price = (EditText)findViewById(R.id.newMenuItem_price);
        newmenuItem_ordered = (EditText)findViewById(R.id.newMenuItem_ordered);
    }

    // Go back to the inventory menu
    public void backToMenu(View v) {
        startActivity(new Intent(MenuListActivity.this, MenuActivity.class));
        MenuListActivity.this.finish();
    }

    // Modification function
    public void modify(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView)findViewById(R.id.error);

        // Get the new inputs
        String newItem = newmenuItem_name.getText().toString();
        String newPrice = newmenuItem_price.getText().toString();
        String newOrdered = newmenuItem_ordered.getText().toString();

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
            // Set the lists to the new inputs
            tempMenuItemList.set(index, newItem);
            tempMenuItemPriceList.set(index, newPrice);
            tempMenuItemOrderedList.set(index, newOrdered);
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (MenuListActivity.this, "menuList", tempMenuItemList);
            createCachedFile (MenuListActivity.this, "menuPrice", tempMenuItemPriceList);
            createCachedFile (MenuListActivity.this, "menuOrdered", tempMenuItemOrderedList);

            startActivity(new Intent(MenuListActivity.this, MenuActivity.class));
            MenuListActivity.this.finish();
        }
    }

    // Remove function
    public void remove(View v) throws IOException, ClassNotFoundException {
        // If list empty, clear the list completely (to get around a bug)
        if (tempMenuItemList.size() == 1) {
            String[] tempList = {""};
            emptyList = new ArrayList<>(Arrays.asList(tempList));

            // Overwrite previous files
            createCachedFile (MenuListActivity.this, "menuList", emptyList);
            createCachedFile (MenuListActivity.this, "menuPrice", emptyList);
            createCachedFile (MenuListActivity.this, "menuOrdered", emptyList);

            startActivity(new Intent(MenuListActivity.this, MenuActivity.class));
            MenuListActivity.this.finish();
        } else {
            // Remove selected item
            tempMenuItemList.remove(index);
            tempMenuItemPriceList.remove(index);
            tempMenuItemOrderedList.remove(index);

            // Overwrite previous files
            createCachedFile(MenuListActivity.this, "menuList", tempMenuItemList);
            createCachedFile(MenuListActivity.this, "menuPrice", tempMenuItemPriceList);
            createCachedFile(MenuListActivity.this, "menuOrdered", tempMenuItemOrderedList);

            startActivity(new Intent(MenuListActivity.this, MenuActivity.class));
            MenuListActivity.this.finish();
        }
    }
}
