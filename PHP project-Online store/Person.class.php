<?php

class Person
{
    public $dbh;
    public $client_since;
    public $first_name;
    public $surname;
    public $email;
    public $phone;
    public $street;
    public $house_number;
    public $post_code;
    public $city;
    public $country;



    public function __construct()
    {
        try
        {
            $this->dbh = new PDO('mysql:host=localhost;dbname=webstore_ppt11', 'root', '');
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

/*     function showPersons()
    {
        $sql = "SELECT * FROM clients";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    } */


    function createNewPerson($first_name,$surname,$email,$phone,$street,$house_number,$post_code,$city,$country)
    {   
        $stmt_insert = $this->dbh->prepare("INSERT INTO clients(first_name, surname, email, phone, street, house_number, post_code, city, country)  
                                            VALUES ('$first_name','$surname','$email','$phone','$street','$house_number','$post_code','$city','$country')");
        $stmt_insert->execute();
        $stmt_insert->fetch(PDO::FETCH_OBJ);
        return $this->dbh->lastInsertId();
    }  

///////////////// REDACT SET & GET CLIENT NAME ///////////////////////////////////////////////////
//////////////////////////////////////////////////////// SET CLIENT NAME /////////////////////////
function setClientName($client_id)
{
    session_start();
    $this->first_name = $first_name;;
    $_SESSION['client_name'] = $first_name;
    session_write_close();
}
//////////////////////////////////////////////////////// GET CLIENT NAME /////////////////////////	
function getClientName()
{
    return $this->username;
}
}


?>
