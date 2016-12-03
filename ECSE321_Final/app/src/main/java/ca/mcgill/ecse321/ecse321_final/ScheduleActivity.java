package ca.mcgill.ecse321.ecse321_final;


import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Spinner;
import android.widget.TimePicker;

import java.io.IOException;
import java.util.ArrayList;

import static ca.mcgill.ecse321.ecse321_final.StaffListActivity.passing;
import static ca.mcgill.ecse321.ecse321_final.ioStream.createCachedFile;
import static ca.mcgill.ecse321.ecse321_final.ioStream.readCachedFile;

public class ScheduleActivity extends AppCompatActivity {
    int index, time = 0;
    String date = "";
    ArrayList<String> tempStaffList, tempstaffSchedDate, tempstaffSchedTime;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_schedule);

        // Read from the lists and create them as empty lists if not existent
        try {
        tempStaffList = (ArrayList<String>)readCachedFile (ScheduleActivity.this, "staff");
        tempstaffSchedDate = (ArrayList<String>)readCachedFile (ScheduleActivity.this, "schedD");
        tempstaffSchedTime = (ArrayList<String>)readCachedFile (ScheduleActivity.this, "schedT");
        } catch (IOException e) {
        e.printStackTrace();
        } catch (ClassNotFoundException e) {
        e.printStackTrace();
        }

        // Get day
        String staffName = passing;
        // Get index
        index = tempStaffList.indexOf(staffName);
    }

    public void setTime(View v) throws IOException, ClassNotFoundException {
        TimePicker timePicker = (TimePicker)findViewById(R.id.time_picker);
        time = timePicker.getCurrentHour();
        Spinner spinner = (Spinner)findViewById(R.id.dateSpinner);
        date = spinner.getSelectedItem().toString();

        // Set day and time
        tempstaffSchedDate.set(index, date);
        tempstaffSchedTime.set(index, String.valueOf(time));

        // Overwrite previous files
        createCachedFile (ScheduleActivity.this, "schedD", tempstaffSchedDate);
        createCachedFile (ScheduleActivity.this, "schedT", tempstaffSchedTime);

        startActivity(new Intent(ScheduleActivity.this, StaffActivity.class));
        ScheduleActivity.this.finish();
    }
}
