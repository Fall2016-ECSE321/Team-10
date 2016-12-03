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

public class ingredientListActivity extends AppCompatActivity {
    int index;
    ArrayList<String> tempIngredientList, tempIngredientNumList, emptyList;
    EditText newingredient_name, newingredient_num;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ingredient_list);

        // Read from the ingredient and ingrdient number lists
        try {
            tempIngredientList = (ArrayList<String>)readCachedFile (ingredientListActivity.this, "ingredients");
            tempIngredientNumList = (ArrayList<String>)readCachedFile (ingredientListActivity.this, "ingredientsNum");
        } catch (IOException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

        // Get the ingredient name and index number
        Intent i = getIntent();
        TextView nameIngredient = (TextView) findViewById(R.id.newIngredient_name);
        TextView numIngredient = (TextView) findViewById(R.id.newIngredient_num);

        // Getting attached intent data
        String ingredientName = i.getStringExtra("ingredient");

        // Get index
        index = tempIngredientList.indexOf(ingredientName);

        // Displaying selected product name and number
        numIngredient.setText(tempIngredientNumList.get(index));
        nameIngredient.setText(ingredientName);
        newingredient_name = (EditText)findViewById(R.id.newIngredient_name);
        newingredient_num = (EditText)findViewById(R.id.newIngredient_num);
    }

    // Go back to the inventory menu
    public void backToInventory(View v) {
        startActivity(new Intent(ingredientListActivity.this, InventoryActivity.class));
        ingredientListActivity.this.finish();
    }

    // Modification function
    public void modify(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView)findViewById(R.id.error);

        // Get the new inputs
        String newName = newingredient_name.getText().toString();
        String newNum = newingredient_num.getText().toString();

        // Error checking
        if (newName.equals("") || newNum.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newNum)) {
            errorTextView.setText("Number must be an integer!");
        } else if (isInteger(newName)) {
            errorTextView.setText("Name can not be a number!");
        } else {
            // Set the lists to the new inputs
            tempIngredientList.set(index, newName);
            tempIngredientNumList.set(index, newNum);
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (ingredientListActivity.this, "ingredients", tempIngredientList);
            createCachedFile (ingredientListActivity.this, "ingredientsNum", tempIngredientNumList);

            startActivity(new Intent(ingredientListActivity.this, InventoryActivity.class));
            ingredientListActivity.this.finish();
        }
    }

    // Remove function
    public void remove(View v) throws IOException, ClassNotFoundException {
        // If list empty, clear the list completely (to get around a bug)
        if (tempIngredientList.size() == 1) {
            String[] tempList = {""};
            emptyList = new ArrayList<>(Arrays.asList(tempList));

            createCachedFile (ingredientListActivity.this, "ingredients", emptyList);
            createCachedFile (ingredientListActivity.this, "ingredientsNum", emptyList);

            startActivity(new Intent(ingredientListActivity.this, InventoryActivity.class));
            ingredientListActivity.this.finish();
        } else {
            // Remove selected item
            tempIngredientList.remove(index);
            tempIngredientNumList.remove(index);

            // Overwrite previous files
            createCachedFile(ingredientListActivity.this, "ingredients", tempIngredientList);
            createCachedFile(ingredientListActivity.this, "ingredientsNum", tempIngredientNumList);

            startActivity(new Intent(ingredientListActivity.this, InventoryActivity.class));
            ingredientListActivity.this.finish();
        }
    }
}
