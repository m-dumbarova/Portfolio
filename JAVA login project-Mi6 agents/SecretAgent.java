import java.sql.*;

class SecretAgent 
{
//////////////////////////////////// PRINT OUT ALL THE Mi6 AGENTS FROM DB ///////////////////////////////////////////// 
	
    public void printAgents() 
    {

        MySQLCon rs = new MySQLCon();
        ResultSet data_rs = rs.getAgent();
        try 
        {
            while(data_rs.next()) 
            {
                System.out.println(data_rs.getString(1) + "  " + data_rs.getString(2) + "  " + data_rs.getString(3));
            }
        }
        catch (Exception e)
        {
            System.out.println(e);
        }

	}

//////////////////////////////////// CHECK IF AGENT NUMBER EXISTS ///////////////////////////////////////////// 
   
    public boolean existAgent(String agentNum) 
    {

        MySQLCon rs = new MySQLCon();
        ResultSet data_rs = rs.getAgent();

        boolean agent_not_found = true;
        try 
        {
            while(data_rs.next()) 
            {
                if (data_rs.getString(1).equals(agentNum))
                {
                    return true;
                }
            }
        }
        catch (Exception e)
        {
            System.out.println(e);
            return false;
        }
        return false;
	}

//////////////////////////////////// GET AGENT NAME ///////////////////////////////////////////// 
    
    public String agentName(String agentNum) 
    {

        MySQLCon rs = new MySQLCon();
        ResultSet data_rs = rs.getAgentInfo(agentNum);
        try 
        {
            return data_rs.getString(2); 
        }
        catch (Exception e)
        {
            System.out.println(e);
            return "";
        }
	}

//////////////////////////////////// GET AGENT SURNAME ///////////////////////////////////////////// 
    
    public String agentSurname(String agentNum) 
    {

        MySQLCon rs = new MySQLCon();
        ResultSet data_rs = rs.getAgentInfo(agentNum);
        try 
        {
            return data_rs.getString(3); 
        }
        catch (Exception e)
        {
            System.out.println(e);
            return "";
        }

	}


}
