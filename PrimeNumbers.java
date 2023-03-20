import java.util.*;

class PrimeNumbers
{  
    public static void main(String args[])  
    {    
///////////////////////////////////////////////// USER ENTRY ///////////////////////////////////// 


        boolean valid_entry = false;
        int max_range=0; 

        while (valid_entry == false)
        {
            try
            {
            	Scanner entry = new Scanner(System.in);
                System.out.println("\n Check for prime numbers up to:\n");
                max_range = entry.nextInt();
                valid_entry = true;
            }
            catch (NumberFormatException e)
            {
                valid_entry = false;
                System.out.println("That's not a valid entry. Please, fill in a number.\n");
                
            }
        }   
///////////////////////////////////////////////// FIND PRIME NUMBERS /////////////////////////////////////

        int num_to_check = 0;
        int num_to_divide_on = 0;
        boolean is_prime = false;

        System.out.println("All the prime numbers up to " + max_range + " are: \n");

        for (num_to_check = 2; num_to_check <= max_range; num_to_check++)
        {
        	is_prime = true;
        	num_to_divide_on = 2;
        	
            while (num_to_divide_on < num_to_check && is_prime == true )
            {
                if (num_to_check % num_to_divide_on == 0)
                {
                    is_prime = false;
                }
                num_to_divide_on++;
            }
            
            if (is_prime == true) 
        	{
        		System.out.print(num_to_check + ", ");
        	}
        }
    }
}