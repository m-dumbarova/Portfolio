<?php

class User extends Person
{
    public $login_username;
    public $login_user_id;
    public function __construct()
    {
        parent::__construct();
    }

    function showUsers()
    {
        $sql = "SELECT client_id,client_since, first_name,surname,email,phone,street,house_number,post_code,city,country,user_id, username,password 
                FROM clients,users 
                WHERE clients.client_id = users.clientID;";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }

/////////////////////////////////// Prepare statements: named placeholders //////////////////////////////////////////
    function getUser_1($username,$password) 
    {
        $password = md5($password);

        try 
        {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
            $stmt->bindParam('username', $username, PDO::PARAM_STR);
            $stmt->bindParam('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return NULL;
        }
    }

 
/////////////////////////////////////////////////// ??? SQL injection ///////////////////////////
    function getUser_2($username,$password)
    {
        $password = md5($password);
        $stmt = $this->dbh->prepare("SELECT * FROM users WHERE username='$username' AND password = '$password'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
            
        return $result;
    }
 

    function createNewUser($client_id,$username,$password)
        {        
            $stmt = $this->dbh->prepare("INSERT INTO users(clientID,username, password)  VALUES ('$client_id','$username','$password')");
            $stmt->execute();
            $stmt->fetch(PDO::FETCH_OBJ);

        }
    
}



?>