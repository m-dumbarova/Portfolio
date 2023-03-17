<form name='stenen' method='POST' action='yahtze_org_v.5.php'>
    
<div width="15%" align="center">

<?php 

    if (isset($_GET['new']))
    {
        unset($_POST);
    }

	//init
	$worp = 1;
	$laatsteworp = 3;
	$stenen = array(0, 0, 0, 0, 0);
    
    $player_id = (isset($_POST['player_id'])) ? (int)$_POST['player_id'] : 1;

	//controller
    if (isset($_POST['opnieuw'])) {
        //opnieuw beginnen
        for ($i = 0; $i <= 4; $i++) {
            $_POST["steen_" . $i]=0;
        }
        $player_id = ($_POST['player_id']==1) ? 2 : 1;
    }
	elseif( isset($_POST['dobbelen']) )
	{
        //dobbelen
        for( $i = 0; $i <= 4; $i ++ )
        {
            if (isset($_POST['steen_'.$i]))
            {
                $stenen[$i] = (int)($_POST['steen_'.$i]);
            }
            if( !isset($_POST['vast_'.$i]) )
            {
                //als steen niet is vastgezet: dobbelen
                $stenen[$i] = mt_rand(1, 6);
            }
        }
	   //volgende worp
	   $worp = $_POST['worp'] + 1;
	} 
    else{
        //opnieuw beginnen
        for ($i = 0; $i <= 4; $i++) {
            $stenen[$i] = mt_rand(1, 6);
        }
    }

	//VIEW
	$formulier = "";

    $formulier .= "<input type='hidden' name='player_id' value='".$player_id."'/>";
	for( $i = 0; $i <= 4; $i ++ )
	{
		$formulier .= "<input type='hidden' name='steen_".$i."' value='".$stenen[$i]."'/>";
        if (isset($_POST['steen_' . $i])) {
            $formulier .= "Steen " . ($i + 1) . ": <img src='pics/dubbelsteen_" . $stenen[$i] . ".png' width='40px;'/>";
        }
	   
		if( $worp > 1 )
		{
		   $formulier .= "&nbsp;&nbsp;&nbsp;<input type='checkbox' name='vast_".$i."'";
			  
		   if( isset($_POST['vast_'.$i]) )
		   {
			  $formulier .= " checked ";
		   }

		   $formulier .= "/><small>vastzetten</small>\n";
		}   
		   
		$formulier .="<br />";
	}
	   
	$formulier .="<br />";

	//knop voor nogmaals dobbelen
	if( $worp <= $laatsteworp )
	{
		$formulier .= "<input type='submit' name='dobbelen' value='Nu werpen: " .$worp. "' />\n";
	}
	else
	{
		 $formulier .= "Bepaal nu de eindscore";
	}

	//formulieren afsluiten
	$formulier .=
	   "<br /><br />".
	   "<input type='hidden' name='worp'  value='" .$worp. "' />\n". 
	   "<input type='submit' name='opnieuw' value='Next player' />\n";

	echo $formulier;
    

/////////////////////////////   FUNCTIONS for showing content in the table   ///////////////////////////////////
    function show_result($speler_id, $cat_id)
    {
        global $stenen;
        if (isset($_POST['speler_'.$speler_id.'cat_'.$cat_id.'_choice']) && $_POST['speler_'.$speler_id.'cat_'.$cat_id.'_choice']) 
        {
            $dice_value = $_POST['speler_'.$speler_id.'cat_'.$cat_id.'_dices'];
            for ($i = 0; $i <= 4; $i++) {
                echo "<img src='pics/dubbelsteen_" . $dice_value[$i] . ".png' width='25px;'/>&nbsp;";
            }
            echo '<input type="hidden" name="speler_'.$speler_id.'cat_'.$cat_id.'_dices" value=' . $dice_value . '>';
        }
        else
        {
            if (isset($_POST['steen_0']) && (int)$_POST['player_id'] == $speler_id)
            {
                for ($i = 0; $i <= 4; $i++) {
                    echo "<img src='pics/dubbelsteen_" . $stenen[$i] . ".png' width='25px;'/>&nbsp;";
                }
                echo '<input type="hidden" name="speler_'.$speler_id.'cat_'.$cat_id.'_dices" value=' . $stenen[0] . $stenen[1] . $stenen[2] . $stenen[3] . $stenen[4] . '>';
            }
        }
    }    

    function show_score($speler_id, $cat_id)
    {
        global $stenen;
        $score = 0;
        if (isset($_POST['speler_'.$speler_id.'cat_'.$cat_id.'_choice']) && $_POST['speler_'.$speler_id.'cat_'.$cat_id.'_choice']) 
        {
            $score=$_POST['speler_'.$speler_id.'cat_'.$cat_id.'_score'];
            echo '<b style="color:green;">' . $score . '</b>';
            echo '<input type="hidden" name="speler_'.$speler_id.'cat_'.$cat_id.'_score" value=' . $score .'>';
            echo '<input type="hidden" name="speler_'.$speler_id.'cat_'.$cat_id.'_choice" value=' . True . '>';
        }
        else
        {
            if (isset($_POST['steen_0']) && (int)$_POST['player_id'] == $speler_id) {
                for ($i = 0; $i <= 4; $i++) {
                    // This needs to be updated once we add more complicated categories
                    if ($stenen[$i] == $cat_id) {
                        $score += $stenen[$i];
                    }
                }
            
                echo $score;
                echo '<input type="hidden" name="speler_'.$speler_id.'cat_'.$cat_id.'_score" value=' . $score .'>';
                if ($_POST['worp'] > 2) {
                    echo '<input type="checkbox" name="speler_' . $speler_id . 'cat_' . $cat_id . '_choice">Use';
                }
            }
        }
    }

?>
</div>

<br/>
<br/>

<div align="center">
<label>player 
    <?php echo $player_id ?> </label>
<table width="50%" cellpadding="5px" >
    <tr>
        <td align="left"><b><u>SPELER 1</u></b></td>
        <td align="right"><b><u>SPELER 2</u></b></td>
    </tr>
    <tr>
        <td align="left">
            <p>Total score: 
                <?php
                    $sum = 0;
                    for ($i=1; $i<=6; $i++){
                        if (isset($_POST['speler_1cat_' . $i . '_choice']) && $_POST['speler_1cat_' . $i . '_choice']) {
                            $sum += (int)$_POST['speler_1cat_' . $i . '_score'];
                        }
                    }
                    echo $sum;
                ?>   
            </p>
        </td>
        <td align="right">
            <p>Total score: 
                <?php
                    $sum = 0;
                    for ($i=1; $i<=6; $i++){
                        if (isset($_POST['speler_2cat_' . $i . '_choice']) && $_POST['speler_2cat_' . $i . '_choice']) {
                            $sum += (int)$_POST['speler_2cat_' . $i . '_score'];
                        }
                    }
                    echo $sum;
                ?>   
            </p>
        </td>
    </tr>
</table>
<!-- SPELER 1 -->

 

 <table width="50%" border="1" cellpadding="5px" align="center">
    <th>category_id</th>
    <th>category</th>
    <th>scrores regarding cat</th>
    <th>dubbelsteen result</th>
    <th>My score</th>

<!-- /////////////////////////////   Speler 1 - Aces   /////////////////////////////////// -->
    <tr>
        <td>1</td>
        <td>Aces</td>
        <td>The sum of dice with the number 1</td>
        <td>
            <?php show_result(1,1) ; ?>
        </td>
        <td>
            <?php show_score(1,1) ; ?>
        <td> 
    </tr>

<!-- /////////////////////////////   Speler 1 - Twos   /////////////////////////////////// -->

    <tr>
        <td>2</td>
        <td>Twos</td>
        <td>The sum of dice with the number 2</td>
        <td>
            <?php show_result(1,2) ; ?>
        </td>
        <td>
            <?php show_score(1,2) ; ?>
        <td> 
    </tr>

<!-- /////////////////////////////   Speler 1 - Threes   /////////////////////////////////// -->

    <tr>
        <td>3</td>
        <td>Threes</td>
        <td>The sum of dice with the number 3</td>
        <td>
            <?php show_result(1,3) ; ?>
        </td>
        <td>
            <?php show_score(1,3) ; ?>
        <td> 
    </tr>

<!-- /////////////////////////////   Speler 1 - Fours   /////////////////////////////////// -->

    <tr>
        <td>4</td>
        <td>Fours</td>
        <td>The sum of dice with the number 4</td>
        <td>
            <?php show_result(1,4) ; ?>
        </td>
        <td>
            <?php show_score(1,4) ; ?>
        <td> 
    </tr>

<!-- /////////////////////////////   Speler 1 - Fives   /////////////////////////////////// -->

    <tr>
        <td>5</td>
        <td>Fives</td>
        <td>The sum of dice with the number 5</td>
        <td>
            <?php show_result(1,5) ; ?>
        </td>
        <td>
            <?php show_score(1,5) ; ?>
        <td> 
    </tr>

<!-- /////////////////////////////   Speler 1 - Sixes   /////////////////////////////////// -->

    <tr>
        <td>6</td>
        <td>Sixes</td>
        <td>The sum of dice with the number 6</td>
        <td>
            <?php show_result(1,6) ; ?>
        </td>
        <td>
            <?php show_score(1,6) ; ?>
        <td> 
    </tr>

    <tr>
        <td>1</td>
        <td>player 2 Aces</td>
        <td>The sum of dice with the number 1</td>
        <td>
            <?php show_result(2,1) ; ?>
        </td>
        <td>
            <?php show_score(2,1) ; ?>
        <td> 
    </tr>
    <tr>
        <td>2</td>
        <td>player 2 Twos</td>
        <td>The sum of dice with the number 2</td>
        <td>
            <?php show_result(2,2) ; ?>
        </td>
        <td>
            <?php show_score(2,2) ; ?>
        <td> 
    </tr>
    <tr>
        <td>3</td>
        <td>player 2 Threes</td>
        <td>The sum of dice with the number 3</td>
        <td>
            <?php show_result(2,3) ; ?>
        </td>
        <td>
            <?php show_score(2,3) ; ?>
        <td> 
    </tr>
    <tr>
        <td>4</td>
        <td>player 2 Fours</td>
        <td>The sum of dice with the number 4</td>
        <td>
            <?php show_result(2,4) ; ?>
        </td>
        <td>
            <?php show_score(2,4) ; ?>
        <td> 
    </tr>
    <tr>
        <td>5</td>
        <td>player 2 Fives</td>
        <td>The sum of dice with the number 5</td>
        <td>
            <?php show_result(2,5) ; ?>
        </td>
        <td>
            <?php show_score(2,5) ; ?>
        <td> 
    </tr>
    <tr>
        <td>6</td>
        <td>player 2 Sixes</td>
        <td>The sum of dice with the number 6</td>
        <td>
            <?php show_result(2,6) ; ?>
        </td>
        <td>
            <?php show_score(2,6) ; ?>
        <td> 
    </tr>
</table>
</div>
</form>
