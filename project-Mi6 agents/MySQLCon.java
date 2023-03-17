import java.sql.*;

class MySQLCon 
{
	private Connection con;

	////////////////////////////////// CONSTRUCTOR - connect to the DB ///////////////////////////////////////
	MySQLCon()
	{
		try
		{
			Class.forName("com.mysql.cj.jdbc.Driver"); //voor Java 9 of cj weghalen
			this.con = DriverManager.getConnection("jdbc:mysql://localhost:3306/mi6_agents","root","");
		}		
		catch (Exception e)
		{
			System.out.println(e);
		}
	}

//////////////////////////////////// GET INFO FOR ALL THE AGENTS ///////////////////////////////////////////// 	
	
	public ResultSet getAgent()
	{
		try 
		{
			Statement stmt = this.con.createStatement();
			ResultSet rs = stmt.executeQuery("SELECT number,name,surname FROM agents");
			return rs;
		} 
		catch(Exception e) 
		{ 
			System.out.println(e);
		}
		return null;
	}

//////////////////////////////////// GET AGENT INFO, CORRESPONDING TO SPECIFIEC AGENT NUMBER ///////////////////////////////////////////// 
	
	public ResultSet getAgentInfo(String agentNum)
	{
		try 
		{
			Statement stmt = con.createStatement();
			ResultSet rs = stmt.executeQuery("SELECT number,name,surname FROM agents WHERE number = " + agentNum);
			rs.next();
			return rs;
		} 
		catch(Exception e) 
		{ 
			System.out.println(e);
		}
		return null;
	}
}
