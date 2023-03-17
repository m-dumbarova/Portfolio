import java.io.*;
import java.util.*;
import java.util.regex.*; 

class LogIn 
{
    public static void main(String args[])       
    {           
        /////////////////// PRINT OUT ALL THE Mi6 AGENTS FROM DB ///////////////////////////////////////////// 
        
        SecretAgent agent = new SecretAgent();
        agent.printAgents();
       
        /////////////////////////// USER INPUT /////////////////////////////////////////////

        Scanner agent_num = new Scanner(System.in);  

        String agent_num_string = "";
        int num_int = 0;
        boolean valid_number = false;

        while (valid_number == false)
        {
            System.out.println("\n Which is your agent number?\n");  
            agent_num_string = agent_num.next(); //receive the agent number (as string) which the user has been typed in.

            if(Pattern.matches("[0-9]*",agent_num_string))
            {
                valid_number = true;
                num_int = Integer.valueOf(agent_num_string);
            }
            else
            {
                valid_number = false;
                System.out.println("That's not a valid agent number.\n");
            }

            if ((valid_number == true) && ((num_int > 999) || (num_int < 0)))
            {
                 System.out.println("That's not a valid agent number.\n");
                 valid_number = false;
            }
        }
        
        if(agent_num_string.length() == 1)
        {
            agent_num_string = ("00" + agent_num_string);
        }
        else if(agent_num_string.length() == 2)
        {
            agent_num_string = ("0" + agent_num_string);
        }

        ///////////////////////////// CHECK IF AGENT NUMBER EXISTS /////////////////////////////////////////////

        if ( agent.existAgent(agent_num_string) )
        {
            String agent_name = agent.agentName(agent_num_string);
            String agent_surname = agent.agentSurname(agent_num_string);

            System.out.println("\n\nWelcome back, Agent " + agent_num_string + ". \nYour mission, should you decide to accept it, is... \nThis tape will self-destruct in five seconds. \nGood luck, " + agent_name + " " + agent_surname + ".");
        } 
        else
        {
            System.out.println("\nAgent " + agent_num_string +" does not exist!");
        }  
        
    }          
}