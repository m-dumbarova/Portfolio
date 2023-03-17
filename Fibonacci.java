import java.io.*;
import java.util.*;

class Fibonacci
{  
    public static void main(String args[])  
    {            
///////////////////////////////////////////////// USER ENTRY ///////////////////////////////////// 

        Scanner num_elements = new Scanner(System.in);

        int count = 0;
        boolean valid_entry = false;
        while (valid_entry == false)
        {
            try
            {
                System.out.println("\n Enter the number of elements in the Fibonacci sequence?\n");
                count = num_elements.nextInt();
                valid_entry = true;
            }
            catch (NumberFormatException e)
            {
                System.out.println("That's not a valid entry. Please, fill in a number.\n");
                valid_entry = false;
            }
        }
///////////////////////////////////////////////// FIBONACCI CALCULATION /////////////////////////////////////
        
        int n1 = 0;
        int n2 = 1;
        int n3;

        //printing 0 and 1
        System.out.print (n1 + ", " + n2);
        int counter = count-2;
        for (int i = 0; i < counter; i++)    // bad operand types for binary operator '-'
        {
            n3 = n1 + n2;
            System.out.print(", " + n3);
            n1 = n2;
            n2 = n3;
        }

    }
}