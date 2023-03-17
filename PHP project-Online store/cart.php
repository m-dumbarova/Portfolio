<?php  
    include 'Session.class.php';
	include 'Page.class.php';
	include 'Product.class.php';
	
	
    $page = new Page("shop.php");
    echo $page->header;
    
	
    echo   '<div align="center">
                <br/>
                <h1>SHOPPING CART</h1>
                <br/>
                <br/>';
    $products = new Product();
    $cart = new Session();

/////////////////////////////////// Use for debuging //////////////////////////////////////
    if (isset($_GET['clean']))   
    {
        session_unset();
    }
//////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['choosen_product'])) 
    {
        $products->saveInCartPlus($_POST['choosen_product']);
    }

//////////////////////////////////////////////// +/- quantity  ///////////////////////////////////////

    if(isset($_POST['less']))
    {
        $products->saveInCartMinus($_POST['item']);
    }
    if(isset($_POST['more']))
    {
        if($_POST['amount'] < $_POST['max'])
        {
            $products->saveInCartPlus($_POST['item']);
        }
        else
        {
            echo "<p style='color:red;'>You reached the maximum quantity on stock of product: <br/>" . $_POST['product_name'] . ".</p>";
        }
        
    }



/////////////////  Importing order in the DB  ////////////////////////////
    if(isset($_POST['submit-order']))
    {   
        //$cart = new Session();
        $client_id = $cart->getClientID(); // from object session on line 23
    
        if($client_id == 0)
        {
            echo "<div align='center'>
                    <p>Please, <a href='login.php'>log in</a> first to proceed to checkout.
                    <br/>Don't have an account? Please, <a href='signup.php'>Sign up</a>.</p>
                </div>";
        }
        else
        {
            $import = $products->importCartToDB_serialized($client_id);
            echo "<img src='../pics/order_sent.png' width='200px'>";
            echo "<p style='color:#83b735;'>Thank you for your purchase! <br/><b>Order number is: " . $import . "</b></p>";
        } 
    }
///////////////////////////////////////////////////////   LOAD DB CART CONTENT  /////////////////////////////////////////////////
//$my_cart = $products->loadCartContent_DB(); // from 116 line
$my_cart = $products->loadCartContent();
    if ($my_cart == array())
    {
        echo "";
    }
    else
    {  

        echo "<table border='0px' width='50%' style='border-spacing: 40px;'>
                <th align='left'>Product picture</th>
                <th align='left'>Product name</th>
                <th>Amount</th>
                <th align='left'>Price</th>";


        $sum = 0;
        
        foreach ($my_cart as $product_id=>$amount)
        {
            $product_info = $products->getProduct($product_id);
            
            $name_product = $product_info['name'];
            $url_product = $product_info['url'];
            $price_product = $product_info['price'];
            $stock_product = $product_info['stock'];
        
            echo "<tr>
                        <td width='20%'><img src='" . $url_product . "' width='150px;'/></td>
                        <td width='59%'>" . $name_product . "</td>
                        <td width='15%'>
                            <form action='cart.php' method='POST'>
                                <div class='field padding-bottom--24'>
                                    <input type='submit' name='less' value='-' style='height:30px; width:30px'>" 
                                    . $amount . "
                                    <input type='submit' name='more' value='+' style='height:30px; width:30px'>
                                    
                                </div>
                                    <input type='hidden' name='item' value=". $product_id .">
                                    <input type='hidden' name='max' value=". $stock_product.">
                                    <input type='hidden' name='amount' value=". $amount .">
                            </form>    
                                <input type='hidden' name='product_name' value='". $name_product ."'>
                        </td>
                        <td width='5%'>" . $price_product . "</td>
                    </tr>";
            $sum += $amount * $price_product;
        
        }
            echo "<tr>
                        <td colspan='3' align='right'>
                            <b>Total price:</b>        
                        </td>
                        <td>";
                            
                            echo "<b>" . $sum . "</b>";
                    echo "</td>
                    </tr>";      
            echo "</table>"; 
            echo "<form action='cart.php' method='POST'>
                 <div class='field padding-bottom--24'>
                    <br/><input style='width: 100px;' type='submit' name='submit-order' value='Place order'>
                </div>
                </form>";
        
    }
echo '</div>';
    include 'style_mainmenu.css';
?>