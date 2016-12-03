package ca.mcgill.ecse321.ecse321_final;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;

import static ca.mcgill.ecse321.ecse321_final.ioStream.createCachedFile;
import static ca.mcgill.ecse321.ecse321_final.ioStream.readCachedFile;
import static ca.mcgill.ecse321.ecse321_final.stringCheck.isInteger;

public class InventoryActivity extends AppCompatActivity {
    boolean check = true;
    ArrayList<String> ingredientsList, toolsList, ingredientsNumList, toolsNumList;
    ArrayAdapter<String> adapterList1, adapterList2;
    EditText newInventory_name, newInventory_number;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_inventory);

        final ListView listView1 = (ListView) findViewById(R.id.listIngredients);
        final ListView listView2 = (ListView) findViewById(R.id.listTools);
        CheckBox isIng = (CheckBox) findViewById(R.id.checkIngredient);

        // Read from the lists and create them as empty lists if not existent
        try {
            ingredientsList = (ArrayList<String>) readCachedFile(InventoryActivity.this, "ingredients");
            ingredientsNumList = (ArrayList<String>) readCachedFile(InventoryActivity.this, "ingredientsNum");
        } catch (IOException e) {
            String[] IngredientsName = {};
            String[] IngredientsNum = {};
            ingredientsList = new ArrayList<>(Arrays.asList(IngredientsName));
            ingredientsNumList = new ArrayList<>(Arrays.asList(IngredientsNum));
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            String[] IngredientsName = {};
            String[] IngredientsNum = {};
            ingredientsList = new ArrayList<>(Arrays.asList(IngredientsName));
            ingredientsNumList = new ArrayList<>(Arrays.asList(IngredientsNum));
            e.printStackTrace();
        }

        // Read from the lists and create them as empty lists if not existent
        try {
            toolsList = (ArrayList<String>) readCachedFile(InventoryActivity.this, "tools");
            toolsNumList = (ArrayList<String>) readCachedFile(InventoryActivity.this, "toolsNum");
        } catch (IOException e) {
            String[] toolsName = {};
            String[] toolsNum = {};
            toolsList = new ArrayList<>(Arrays.asList(toolsName));
            toolsNumList = new ArrayList<>(Arrays.asList(toolsNum));
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            String[] toolsName = {};
            String[] toolsNum = {};
            toolsList = new ArrayList<>(Arrays.asList(toolsName));
            toolsNumList = new ArrayList<>(Arrays.asList(toolsNum));
            e.printStackTrace();
        }

        // Set adapters
        adapterList1 = new ArrayAdapter<String>(this, R.layout.ingredientlist_item, R.id.ingredientname, ingredientsList);
        listView1.setAdapter(adapterList1);
        adapterList2 = new ArrayAdapter<String>(this, R.layout.toollist_item, R.id.toolname, toolsList);
        listView2.setAdapter(adapterList2);

        newInventory_name = (EditText) findViewById(R.id.newInventory_name);
        newInventory_number = (EditText) findViewById(R.id.newInventory_number);

        // Listening to single list item on click
        listView1.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                // Selected item
                String ingredient = listView1.getItemAtPosition(position).toString();

                // Launching new Activity on selecting single List Item
                Intent i = new Intent(getApplicationContext(), ingredientListActivity.class);

                // Sending data to new activity
                i.putExtra("ingredient", ingredient);
                startActivity(i);
                InventoryActivity.this.finish();
            }
        });

        // Listening to single list item on click
        listView2.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                // Selected item
                String tool = listView2.getItemAtPosition(position).toString();

                // Launching new Activity on selecting single List Item
                Intent t = new Intent(getApplicationContext(), toolListActivity.class);

                // Sending data to new activity
                t.putExtra("tool", tool);
                startActivity(t);
                InventoryActivity.this.finish();
            }
        });

        // Checkbox
        isIng.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                //is chkIos checked?
                if (((CheckBox) v).isChecked()) {
                    check = true;
                } else {
                    check = false;
                }
            }
        });
        refreshData();
    }

    // Refresh screen function
    private void refreshData() {
        TextView tv1 = (TextView) findViewById(R.id.newInventory_name);
        TextView tv2 = (TextView) findViewById(R.id.newInventory_number);
        tv1.setText("");
        tv2.setText("");
        adapterList1.notifyDataSetChanged();
        adapterList2.notifyDataSetChanged();
    }

    // Go back to main menu
    public void mainMenu(View v) {
        startActivity(new Intent(InventoryActivity.this, MainActivity.class));
        InventoryActivity.this.finish();
    }

    // Add Item function
    public void addInventory(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView) findViewById(R.id.error);

        // Get the new inputs
        String newName = newInventory_name.getText().toString();
        String newNum = newInventory_number.getText().toString();

        // Error checking
        if (newName.equals("") || newNum.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newNum)) {
            errorTextView.setText("Number must be an integer!");
        } else if (isInteger(newName)) {
            errorTextView.setText("Name can not be a number!");
        } else {
            // Set the lists to the new inputs
            if (check) { // If checkbox checked
                ingredientsList.add(newName);
                ingredientsNumList.add(newNum);

                adapterList1.notifyDataSetChanged();
                errorTextView.setText("");

                // Overwrite previous files
                createCachedFile(InventoryActivity.this, "ingredients", ingredientsList);
                createCachedFile(InventoryActivity.this, "ingredientsNum", ingredientsNumList);
            } else { // If checkbox unchecked
                toolsList.add(newName);
                toolsNumList.add(newNum);

                adapterList2.notifyDataSetChanged();
                errorTextView.setText("");

                // Overwrite previous files
                createCachedFile(InventoryActivity.this, "tools", toolsList);
                createCachedFile(InventoryActivity.this, "toolsNum", toolsNumList);
            }
        }
        refreshData();
    }
}
