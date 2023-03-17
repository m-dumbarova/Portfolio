<?php

    class Product
    {
		public $dbh;
		
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
//////////////////////////////////////////////////////// GET ALL PRODUCTS /////////////////////////		
        public function getAllProducts()
        {   
            $sql = "SELECT url,name,price,id FROM products";
            $stmt = $this->dbh->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
          
			return $result;
        }

//////////////////////////////////////////////////////// GET PRODUCT /////////////////////////
        public function getProduct($product_id)
        {   
            $sql = "SELECT * FROM products WHERE id=$product_id";
            $stmt = $this->dbh->prepare($sql);
            //var_dump($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
        }

//////////////////////////////////////////////////////// GET PRODUCT CONTENT/////////////////////////
        public function getProductContent($product_id)
        {   
            $sql = "SELECT * FROM products, product_pages WHERE product_pages.prod_id=products.id AND products.id=$product_id";
            $stmt = $this->dbh->prepare($sql);
            //var_dump($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

//////////////////////////////////////////////////////// UPDATE PRODUCT GALLERY /////////////////////////
        public function updateProductGallery($product_id,$serialized_gallery)
        {   
            $sql = "UPDATE product_pages SET images='$serialized_gallery'
                                         WHERE prod_id=$product_id";
            $stmt = $this->dbh->prepare($sql);
            //var_dump($sql);
            $stmt->execute();
        }

/////////////////////////////////////////////////// CART CONTENT (BEFORE PLACING ORDER) GOES TO ...  ////////////////////////////////  

////////////////////////////////// PLUS ///////////////////////////////
        function saveInCartPlus($product_id)
        {
            $client_session = new Session();
            $client_ID = $client_session->getClientID();

            if($client_ID == 0)
            {
                $client_session->addToCart($product_id);
            }
            else
            {
                $session_date = date("YmdHis");

                // Check if there is such client_ID in table session
                $sql = "SELECT * FROM session WHERE client_ID=$client_ID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute();
                $result = $stmt->rowCount();

                if($result == 0)
                {
                    $my_cart = array();
                    $my_cart[$product_id] = 1;
                    try 
                    {
                        $cart_content_str = serialize($my_cart); // Convert array to str (The assoc. array $my_cart from session is being converted into string and goes to only one cell in the DB)
                        $stmt = $this->dbh->prepare("INSERT INTO session(client_ID, date, cart_content)  
                                                     VALUES ('$client_ID', '$session_date', '$cart_content_str')");
                        $stmt->execute();
                    }
                    catch (PDOException $e)
                    {
                        echo $e->getMessage();
                    }
                }
                else
                {
                    $result = $stmt->fetch(PDO::FETCH_OBJ);
                    $my_cart=unserialize($result->cart_content);
                    if (!array_key_exists($product_id,$my_cart))
                    {
                        $my_cart[$product_id] = 1;
                    } 
                    else 
                    {
                        $my_cart[$product_id] += 1;
                    }
                    
                    $cart_content_str = serialize($my_cart);                    
                    $stmt = $this->dbh->prepare("UPDATE session SET date='$session_date', cart_content='$cart_content_str' 
                                                 WHERE client_ID=$client_ID");
                    $stmt->execute();
                }                
            }
        }

////////////////////////////////// MINUS ///////////////////////////////
        function saveInCartMinus($product_id)
        {
            $client_session = new Session();
            $client_ID = $client_session->getClientID();

            if($client_ID == 0)
            {
                $client_session->removeFromCart($product_id);
            }
            else
            {
                $session_date = date("YmdHis");

                // Check if there is such client_ID in table session
                $sql = "SELECT * FROM session WHERE client_ID=$client_ID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);

                $my_cart=unserialize($result->cart_content);

                if ($my_cart[$product_id] > 1 )
                {
                    $my_cart[$product_id] -= 1;
                }
                else
                {
                    unset($my_cart[$product_id]);
                }
                
                if ($my_cart != array())
                {
                    $cart_content_str = serialize($my_cart);
                    $stmt = $this->dbh->prepare("UPDATE session SET date='$session_date', cart_content='$cart_content_str' 
                                                    WHERE client_ID=$client_ID");
                    $stmt->execute();
                }
                else
                {
                    $stmt = $this->dbh->prepare("DELETE FROM session WHERE client_ID=$client_ID");
                    $stmt->execute();
                }                
            }
        }

//////////////////////////////////////////////////////// LOAD CART CONTENT (LOGGED IN USERS / GUEST)  ///////////////////////////////////////////////////////
        function loadCartContent()
        {
            $client_session = new Session();
            $client_ID = $client_session->getClientID();

            if($client_ID != 0)
            {
                try 
                    {
                        $stmt = $this->dbh->prepare("SELECT cart_content FROM session WHERE client_ID=$client_ID");
                        $stmt->execute();
                        if ($stmt->rowCount() ==0)
                        {
                            return array();
                        }
                        else 
                        {
                            $cell_cart_content_as_array = $stmt->fetch(PDO::FETCH_OBJ);
                            $serialized_data = $cell_cart_content_as_array->cart_content;
                            $unserialized_array_cart_content = unserialize($serialized_data); // Convert str to assoc. array and it's possible again to manipulate with the keys and their values
                            return $unserialized_array_cart_content;
                        }  
                    }
                    catch (PDOException $e)
                    {
                        echo $e->getMessage();
                    }
            }
            else
            {
                $cart_content_session = new Session();
                $cart_content = $cart_content_session->getCart();

                return $cart_content;
            }
        }

//////////////////////////////////////////////////////// LOAD CART CONTENT (LOGGED IN USERS)  ///////////////////////////////////////////////////////
function loadCartContent_DB()
{
    $client_session = new Session();
    $client_ID = $client_session->getClientID();

    try 
    {
        $stmt = $this->dbh->prepare("SELECT cart_content FROM session WHERE client_ID=$client_ID");
        $stmt->execute();
        if ($stmt->rowCount() == 0)
        {
            return array();
        }
        else 
        {
            $cell_cart_content_as_array = $stmt->fetch(PDO::FETCH_OBJ);
            $serialized_data = $cell_cart_content_as_array->cart_content;
            $unserialized_array_cart_content = unserialize($serialized_data); // Convert str to assoc. array and it's possible again to manipulate with the keys and their values
           
            return $unserialized_array_cart_content;
        }  
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    
}

//////////////////////////////////////////////////////// LOAD CART CONTENT FROM LOCAL SESSION AND FROM DB (LOGGED IN USERS)  ///////////////////////////////////////////////////////
// Merge the array from local session before log in and the array from DB after log in

function loadTotalCartContent()
{
    $client_session = new Session();
    $client_ID = $client_session->getClientID();

    $my_loc_cart = $client_session->getCart();

    try 
    {
        $stmt = $this->dbh->prepare("SELECT cart_content FROM session WHERE client_ID=$client_ID");
        $stmt->execute();
        if ($stmt->rowCount() == 0)
        {
            return  $my_loc_cart;
        }
        else 
        {
            $cell_cart_content_as_array = $stmt->fetch(PDO::FETCH_OBJ);
            $serialized_data = $cell_cart_content_as_array->cart_content;
            $unserialized_array_cart_content = unserialize($serialized_data); // Convert str to assoc. array and it's possible again to manipulate with the keys and their values
           
            foreach($my_loc_cart as $product_id => $amount)
            {
                if(array_key_exists($product_id, $unserialized_array_cart_content))
                {
                    $amount_product_from_loc_session = $my_loc_cart[$product_id];
                    $amount_product_from_db = $unserialized_array_cart_content[$product_id];
                    $total_amount = $amount_product_from_loc_session + $amount_product_from_db;
                    //$merged_array_cart_content = 
                    $unserialized_array_cart_content[$product_id] = $total_amount; // add the pair key=>value to the array  
                }
                else
                {
                    $amount_product_from_loc_session = $my_loc_cart[$product_id];
                    $unserialized_array_cart_content[$product_id] = $amount_product_from_loc_session; // add the pair key=>value to the array
                    
                }
            }

            $session_date = date("YmdHis");
            $merged_array_cart_content_str = serialize($unserialized_array_cart_content);
            $stmt = $this->dbh->prepare("UPDATE session SET date='$session_date', cart_content='$merged_array_cart_content_str' 
                                            WHERE client_ID=$client_ID");
            $stmt->execute();
            return $unserialized_array_cart_content;
            
        }  
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
}

//////////////////////////////////////////////////////// LOAD CART CONTENT FROM LOCAL SESSION AND FROM DB (LOGGED IN USERS)  ///////////////////////////////////////////////////////
// Merge the array from local session before log in and the array from DB after log in

function mergeCartContent()
{
    $client_session = new Session();

    $my_loc_cart = $client_session->getCart();
    foreach ($my_loc_cart as $product_id => $amount){
        for ($count=0;$count < $amount;$count++)
            $this->saveInCartPlus($product_id);
    }
    $client_session->removeCart(); 
}

//////////////////////////////////////////////////////// SEND ORDER  ///////////////////////////////////////////////////////  

        public function importCartToDB($my_cart,$client_id)
        {
            ///// Generating an unique order number 
            $order_number = date("YmdHis");

            ///// Generating the date of the order
            $order_date = date("Ymd");

            foreach($my_cart as $product_id => $product_quantity)
            {
               // echo "From product_id " . $product_id . " the client ordered " . $product_quantity . " piece/pices.";
                try 
                {
                    $stmt = $this->dbh->prepare("INSERT INTO orders(order_num, clientID, date, product, quantity, status)  
                                                 VALUES ('$order_number', '$client_id', '$order_date', '$product_id', '$product_quantity', 1)");
                    $stmt->execute();
                }
                catch (PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            return $order_number;
        }

//////////////////////////////////////////////////////// SEND ORDER  ///////////////////////////////////////////////////////  

        public function importCartToDB_serialized($client_id)
        {
            ///// Generating an unique order number 
            $order_number = date("YmdHis");

            ///// Generating the date of the order
            $order_date = date("Ymd");  
            
            try 
            {
                $my_cart = $this->loadCartContent();
                $cart_content_str = serialize($my_cart);
                $stmt = $this->dbh->prepare("INSERT INTO orders(order_num, clientID, date, cart_content, status)  
                                            VALUES ('$order_number', '$client_id', '$order_date', '$cart_content_str', 1)");
                $stmt->execute();

                $stmt = $this->dbh->prepare("DELETE FROM session WHERE client_ID = $client_id");
                $stmt->execute();
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }

            return $order_number;
        }

    }
    

?>