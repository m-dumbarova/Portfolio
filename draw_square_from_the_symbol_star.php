<?php

/*

*****
*   *
*   *
*   *
*****

*/
?>

<html>
	<body>
		<form action="vierkant.php" method="POST">
			<h1>Voer een getal in:</h1>
			<input type="text" id="getal" name="getal_van_gebruiker">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>

<?php
	if (isset($_POST['getal_van_gebruiker']))
	{
		$lengte_vierkant = $_POST['getal_van_gebruiker'];
	} 
	else 
	{
		$lengte_vierkant = 0;
	} 
	echo "Het programa zal een vierkant uitprinten. De lengte van de vierkant bestaat uit " . $lengte_vierkant . " sterretjes!";
	echo "<br/>";
	echo "<br/>";

	

	for ($i=1; $i<=$lengte_vierkant; $i++)
	{ 
		if ($i==1 || $i==$lengte_vierkant){
			for ($j=1; $j<=$lengte_vierkant; $j++)
			{ 
				echo "*";
			}
			echo "<br/>";
		}
		else
		{
			for ($j=1; $j<=$lengte_vierkant; $j++)
			{
				if ($j==1 || $j==$lengte_vierkant)
				{
					echo "*";
				}
				else 
				{
					echo "&nbsp; ";
				}
			}
			echo "<br/>";
		}
		
	}

?>