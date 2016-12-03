package ca.mcgill.ecse321.ecse321_final;

import android.content.Context;

import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.util.ArrayList;

/**
 * Created by ynhnwn on 2016-11-29.
 */

// Create file function
public class ioStream {
    public static void createCachedFile (Context context, String key, ArrayList<String> fileName) throws IOException {

        for (String file : fileName) {
            FileOutputStream fos = context.openFileOutput (key, Context.MODE_PRIVATE);
            ObjectOutputStream oos = new ObjectOutputStream(fos);
            oos.writeObject (fileName);
            oos.close ();
            fos.close ();
        }
    }

    // Read file function
    public static Object readCachedFile (Context context, String key) throws IOException, ClassNotFoundException {
        FileInputStream fis = context.openFileInput (key);
        ObjectInputStream ois = new ObjectInputStream (fis);
        Object object = ois.readObject ();
        return object;
    }
}
