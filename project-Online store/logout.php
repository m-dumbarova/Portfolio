<?php
	include 'Person.class.php';
    include 'User.class.php';
    include 'Session.class.php';


	$stop_user_session = new Session();
    $stop_user_session->logOutUser();
	
?>