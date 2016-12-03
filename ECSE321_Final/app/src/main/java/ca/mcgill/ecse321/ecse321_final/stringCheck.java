package ca.mcgill.ecse321.ecse321_final;

/**
 * Created by ynhnwn on 2016-11-29.
 */

public class stringCheck {
    // Check if input is an integer
    public static boolean isInteger(String s) {
        try {
            Integer.parseInt(s);
        } catch(NumberFormatException e) {
            return false;
        } catch(NullPointerException e) {
            return false;
        }
        // Only get here if we didn't return false
        return true;
    }

    // Check if input is a double
    public static boolean isDouble(String s) {
        try {
            Double.parseDouble(s);
        } catch (NumberFormatException e) {
            return false;
        } catch(NullPointerException e) {
            return false;
        }
        // Only get here if we didn't return false
        return true;
    }
}
