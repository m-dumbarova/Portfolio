<?php

    class Session
    {
        public $dbh;
        public $username;
        public $clientID;
//////////////////////////////////////////////////////// CONSTRUCT starts SESSION /////////////////////////
        function __construct()
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
            
            //session_write_close();
            session_start();
            if (!isset($_SESSION['username']))
            {
                session_write_close();
                $this->setUsername("guest");
                $this->setClientID(0);
            }
            else
            {
                $this->username = $_SESSION['username'];
                $this->clientID = $_SESSION['client_id'];
            }
            if (!isset($_SESSION["cart_item"])) 
            {
                $_SESSION["cart_item"] = array();
            }
            session_write_close();
        }

//////////////////////////////////////////////////////// SET USERNAME /////////////////////////
        function setUsername($username)
        {
            //session_write_close();
            session_start();
            $this->username = $username;
            $_SESSION['username'] = $username;
            session_write_close();
        }
//////////////////////////////////////////////////////// GET USERNAME /////////////////////////	
		function getUsername()
        {
            return $this->username;
        }

//////////////////////////////////////////////////////// SET CLIENT ID /////////////////////////
        function setClientID($client_id)
        {
            //session_write_close();
            session_start();
            $this->clientID = $client_id;
            $_SESSION['client_id'] = $client_id;
            session_write_close();
        }

//////////////////////////////////////////////////////// GET CLIENT ID /////////////////////////
        function getClientID()
        {
            return $this->clientID;
        }

//////////////////////////////////////////////////////// LOG OUT USER /////////////////////////
        function logOutUser()
        {
            session_start();
            session_destroy();

            session_write_close();
			header ("Location: index.php");
        }

//////////////////////////////////////////////////////// ADD TO CART ////////////////////////////
        function addToCart($product_id)
        {
            session_start();
            $my_cart = $_SESSION["cart_item"];

            if (!array_key_exists($product_id,$my_cart))
            {
                $my_cart[$product_id] = 1;
            } 
            else 
            {
                $my_cart[$product_id] += 1;
            }

            $_SESSION["cart_item"]=$my_cart;
            //var_dump($_SESSION["cart_item"]);
            session_write_close();

            return $my_cart;
        }

//////////////////////////////////////////////////////// GET CART /////////////////////////////////
        function getCart()
        {
            session_start();
            $my_cart = $_SESSION["cart_item"];
            session_write_close();
            return $my_cart;
        }

//////////////////////////////////////////////////////// REMOVE FROM CART /////////////////////////
        function removeFromCart($product_id)
        {
            session_start();
            $my_cart = $_SESSION["cart_item"];
            if ($my_cart[$product_id] > 1 )
            {
                $my_cart[$product_id] -= 1;
            }
            else
            {
                unset($my_cart[$product_id]);
            }
            $_SESSION["cart_item"]=$my_cart;
            session_write_close();

            return $my_cart;
        }

        function removeCart()
        {
            session_start();
            unset($_SESSION["cart_item"]);
            session_write_close();
        }

       
    }

?>