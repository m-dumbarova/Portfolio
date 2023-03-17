<?php

    echo '<h1>Collatz conjecture calculator</h1>
            <form action="collatz.php" method="POST">
                <lable>Choose a number to start from: </lable>
                    <input type="number" name="choosen_num" id="choosen_num">
                    <input type="submit" name="start_calculation" value="Start">
                <p>or</p>
                <lable>Calculate with a random number: </lable>
                    <input type="submit" name="generate_num" value="Generate">
                        <input type="hidden" name="generated_num" value= "' . $generated_num = rand(-100, 100) . '">  
            </form>';


    function collatzCalc($num)
    {
        $num_array = array();
        while (in_array($num, $num_array) == false)
        {
            array_push($num_array, $num);
            if ($num % 2 == 0)
            {
                $num = $num/2;
            }
            else
            {
                $num = ($num*3)+1;
            }
        }
        
        array_push($num_array, $num);
        $remove_the_last_element = array_pop($num_array); 

        foreach($num_array as $array_element)
        {
            echo $array_element . ", ";
        } 
    }        
    
////////////////////////////////////////////////////////////////////////////////////////////////

    echo '</br></br>';

    if(isset($_POST['start_calculation']) && $_POST['choosen_num']!="")
    {
		$num = $_POST['choosen_num'];
        echo 'The choosen number is ' . $num;
        echo '</br></br>';
        collatzCalc($num);
	} 
	else 
    {
		if(isset($_POST['generate_num']) && $_POST['generated_num']!="")
        {
            $num = $_POST['generated_num'];
            echo 'The generated number is ' . $num;
            echo '</br></br>';
            collatzCalc($num);
        }
        
	} 
  
?>