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

public class StaffListActivity extends AppCompatActivity {
    int index;
    public static String passing;

    ArrayList<String> tempStaffList, tempStaffIDList, tempstaffSchedDate, tempstaffSchedTime, emptyList;
    EditText newstaff_name, newstaff_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_staff_list);

        // Read from the ingredient and staff number lists
        try {
            tempStaffList = (ArrayList<String>)readCachedFile (StaffListActivity.this, "staff");
            tempStaffIDList = (ArrayList<String>)readCachedFile (StaffListActivity.this, "id");
            tempstaffSchedDate = (ArrayList<String>)readCachedFile (StaffListActivity.this, "schedD");
            tempstaffSchedTime = (ArrayList<String>)readCachedFile (StaffListActivity.this, "schedT");
        } catch (IOException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

        // Get the staff name and index number
        Intent i = getIntent();
        TextView idStaff = (TextView) findViewById(R.id.newStaff_id);
        TextView nameStaff = (TextView) findViewById(R.id.newStaff_name);
        TextView schedTime= (TextView) findViewById(R.id.newScheduleTime);
        TextView schedDate= (TextView) findViewById(R.id.newScheduleDate);

        // Getting attached intent data
        String staffName = i.getStringExtra("Staff");
        passing = staffName;
        // Get index
        index = tempStaffList.indexOf(staffName);


        // Displaying selected product name
        idStaff.setText(tempStaffIDList.get(index));
        nameStaff.setText(staffName);
        schedTime.setText(tempstaffSchedTime.get(index));
        schedDate.setText(tempstaffSchedDate.get(index));

        newstaff_name = (EditText)findViewById(R.id.newStaff_name);
        newstaff_id = (EditText)findViewById(R.id.newStaff_id);
    }

    // Go back to the staff menu
    public void backToStaff(View v) {
        startActivity(new Intent(StaffListActivity.this, StaffActivity.class));
        StaffListActivity.this.finish();
    }

    // Go to schedule menu
    public void schedule(View v) {
        startActivity(new Intent(StaffListActivity.this, ScheduleActivity.class));
        StaffListActivity.this.finish();
    }

    // Modification function
    public void modify(View v) throws IOException, ClassNotFoundException {
        TextView errorTextView = (TextView)findViewById(R.id.error);

        // Get the new inputs
        String newName = newstaff_name.getText().toString();
        String newId = newstaff_id.getText().toString();

        // Error checking
        if (newName.equals("") || newId.equals("")) {
            errorTextView.setText("Enter all fields!");
        } else if (!isInteger(newId)) {
            errorTextView.setText("ID must be an integer!");
        } else if (isInteger(newName)) {
            errorTextView.setText("Name can not be a number!");
        } else {
            // Set the lists to the new inputs
            tempStaffList.set(index, newName);
            tempStaffIDList.set(index, newId);
            errorTextView.setText("");

            // Overwrite previous files
            createCachedFile (StaffListActivity.this, "staff", tempStaffList);
            createCachedFile (StaffListActivity.this, "id", tempStaffIDList);

            startActivity(new Intent(StaffListActivity.this, StaffActivity.class));
            StaffListActivity.this.finish();
        }
    }

    // Remove function
    public void remove(View v) throws IOException, ClassNotFoundException {
        // If list empty, clear the list completely (to get around a bug)
        if (tempStaffList.size() == 1) {
            String[] tempList = {""};
            emptyList = new ArrayList<>(Arrays.asList(tempList));

            // Overwrite previous files
            createCachedFile(StaffListActivity.this, "staff", emptyList);
            createCachedFile(StaffListActivity.this, "id", emptyList);
            createCachedFile (StaffListActivity.this, "schedD", emptyList);
            createCachedFile (StaffListActivity.this, "schedT", emptyList);

            startActivity(new Intent(StaffListActivity.this, StaffActivity.class));
            StaffListActivity.this.finish();
        } else {
            // Remove selected item
            tempStaffList.remove(index);
            tempStaffIDList.remove(index);
            tempstaffSchedDate.remove(index);
            tempstaffSchedTime.remove(index);

            // Overwrite previous files
            createCachedFile(StaffListActivity.this, "staff", tempStaffList);
            createCachedFile(StaffListActivity.this, "id", tempStaffIDList);
            createCachedFile (StaffListActivity.this, "schedD", tempstaffSchedDate);
            createCachedFile (StaffListActivity.this, "schedT", tempstaffSchedTime);

            startActivity(new Intent(StaffListActivity.this, StaffActivity.class));
            StaffListActivity.this.finish();
        }
    }
}
