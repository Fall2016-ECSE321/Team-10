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

public class StaffActivity extends AppCompatActivity {
    ArrayList<String> staffList, staffIDList, staffSchedDate, staffSchedTime;
    ArrayAdapter<String> adapterList;
    EditText newStaff_name, newStaff_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_staff);

        final ListView listView = (ListView)findViewById(R.id.listStaff);

        // Read from the lists and create them as empty lists if not existent
        try {
            staffList = (ArrayList<String>)readCachedFile (StaffActivity.this, "staff");
            staffIDList = (ArrayList<String>)readCachedFile (StaffActivity.this, "id");
            staffSchedDate = (ArrayList<String>)readCachedFile (StaffActivity.this, "schedD");
            staffSchedTime = (ArrayList<String>)readCachedFile (StaffActivity.this, "schedT");
        } catch (IOException e) {
            String[] staffname = {};
            String[] staffid = {};
            String[] staffsched = {};
            staffList = new ArrayList<>(Arrays.asList(staffname));
            staffIDList = new ArrayList<>(Arrays.asList(staffid));
            staffSchedDate  = new ArrayList<>(Arrays.asList(staffsched));
            staffSchedTime  = new ArrayList<>(Arrays.asList(staffsched));
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            String[] staffname = {};
            String[] staffid = {};
            String[] staffsched = {};
            staffList = new ArrayList<>(Arrays.asList(staffname));
            staffIDList = new ArrayList<>(Arrays.asList(staffid));
            staffSchedDate  = new ArrayList<>(Arrays.asList(staffsched));
            staffSchedTime  = new ArrayList<>(Arrays.asList(staffsched));
            e.printStackTrace();
        }

        // Set adapters
        adapterList = new ArrayAdapter<String>(this, R.layout.stafflist_item, R.id.staffname, staffList);
        listView.setAdapter(adapterList);

        newStaff_name = (EditText)findViewById(R.id.newStaff_name);
        newStaff_id = (EditText)findViewById(R.id.newStaff_id);

        // Listening to single list item on click
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                // Selected item
                String staff = listView.getItemAtPosition(position).toString();

                // Launching new Activity on selecting single List Item
                Intent i = new Intent(getApplicationContext(), StaffListActivity.class);

                // Sending data to new activity
                i.putExtra("Staff", staff);
                startActivity(i);
                StaffActivity.this.finish();
            }
        });
        refreshData();
    }

    // Refresh screen function
    private void refreshData() {
        TextView tv1 = (TextView) findViewById(R.id.newStaff_name);
        TextView tv2 = (TextView) findViewById(R.id.newStaff_id);
        tv1.setText("");
        tv2.setText("");
    }

    // Go back to main menu
    public void mainMenu(View v) throws IOException, ClassNotFoundException {
        startActivity(new Intent(StaffActivity.this, MainActivity.class));
        StaffActivity.this.finish();
    }

    // Add Item function
    public void addStaff(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView) findViewById(R.id.error);

        // Get the new inputs
        String newName = newStaff_name.getText().toString();
        String newId = newStaff_id.getText().toString();

        // Error checking
        if (newName.equals("") || newId.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newId)) {
            errorTextView.setText("ID must be an integer!");
        } else if (isInteger(newName)) {
            errorTextView.setText("Name can not be a number!");
        } else {
            // Add the new inputs
            staffList.add(newName);
            staffIDList.add(newId);
            staffSchedDate.add("");
            staffSchedTime.add("");
            adapterList.notifyDataSetChanged();
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (StaffActivity.this, "staff", staffList);
            createCachedFile (StaffActivity.this, "id", staffIDList);
            createCachedFile (StaffActivity.this, "schedD", staffSchedDate);
            createCachedFile (StaffActivity.this, "schedT", staffSchedTime);
        }
        refreshData();
    }
}
