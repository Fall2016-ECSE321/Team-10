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

public class toolListActivity extends AppCompatActivity {
    int index;
    ArrayList<String> tempToolList, tempToolNumList, emptyList;
    EditText newtool_name, newtool_num;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tool_list);

        try {
            tempToolList = (ArrayList<String>)readCachedFile (toolListActivity.this, "tools");
            tempToolNumList = (ArrayList<String>)readCachedFile (toolListActivity.this, "toolsNum");
        } catch (IOException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

        // Get the tool name and index number
        Intent t = getIntent();
        TextView nameTool = (TextView) findViewById(R.id.newTool_name);
        TextView numTool = (TextView) findViewById(R.id.newTool_num);

        // Getting attached intent data
        String toolName = t.getStringExtra("tool");

        // Get index
        index = tempToolList.indexOf(toolName);

        // Displaying selected product name
        numTool.setText(tempToolNumList.get(index));
        nameTool.setText(toolName);
        newtool_name = (EditText)findViewById(R.id.newTool_name);
        newtool_num = (EditText)findViewById(R.id.newTool_num);
    }

    // Go back to the inventory menu
    public void backToInventory(View v) {
        startActivity(new Intent(toolListActivity.this, InventoryActivity.class));
        toolListActivity.this.finish();
    }

    // Modification function
    public void modify(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView)findViewById(R.id.error);

        // Get the new inputs
        String newName = newtool_name.getText().toString();
        String newNum = newtool_num.getText().toString();

        // Error checking
        if (newName.equals("") || newNum.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newNum)) {
            errorTextView.setText("Number must be an integer!");
        } else if (isInteger(newName)) {
            errorTextView.setText("Name can not be a number!");
        } else {
            // Set the lists to the new inputs
            tempToolList.set(index, newName);
            tempToolNumList.set(index, newNum);
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (toolListActivity.this, "tools", tempToolList);
            createCachedFile (toolListActivity.this, "toolsNum", tempToolNumList);

            startActivity(new Intent(toolListActivity.this, InventoryActivity.class));
            toolListActivity.this.finish();
        }
    }

    // Remove function
    public void remove(View v) throws IOException, ClassNotFoundException {
        // If list empty, clear the list completely (to get around a bug)
        if (tempToolList.size() == 1) {
            String[] tempList = {""};
            emptyList = new ArrayList<>(Arrays.asList(tempList));

            createCachedFile (toolListActivity.this, "tools", emptyList);
            createCachedFile (toolListActivity.this, "toolsNum", emptyList);

            startActivity(new Intent(toolListActivity.this, InventoryActivity.class));
            toolListActivity.this.finish();
        } else {
            // Remove selected item
            tempToolList.remove(index);
            tempToolNumList.remove(index);

            // Overwrite previous files
            createCachedFile(toolListActivity.this, "tools", tempToolList);
            createCachedFile(toolListActivity.this, "toolsNum", tempToolNumList);

            startActivity(new Intent(toolListActivity.this, InventoryActivity.class));
            toolListActivity.this.finish();
        }
    }
}
