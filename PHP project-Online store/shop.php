<?php  
    include 'Session.class.php';
	include 'Page.class.php';
	include 'Product.class.php';
	
	
	
	$page = new Page("shop.php");
    //$products = new Product();
   
    echo $page->header;
	
	echo '<div align="center" width="70%">
            <br/>
            <h1>PRODUCTS</h1>
            <br/>
            <br/>';		
			
	$products = new Product();
	$all_products = $products->getAllProducts();

//  This displays all the product in one row
//	$products->showAllProducts($all_products); 

//  This displays choosen amount of products in one row. In this case 5 products/row
    $elements_on_row = 5;
    for ($i=0; $i<sizeof($all_products); $i+=$elements_on_row)
    {
        echo "<table >
                    <tr>";
                        for ($j=$i; $j<$i+$elements_on_row && $j<sizeof($all_products); $j++)
                        {
                            echo "<td><img src='" . $all_products[$j]['url'] . "' width='260px;' border='1px;'/></td>";
                        }
            echo "</tr>
                    <tr>";
                        for ($j=$i; $j<$i+$elements_on_row && $j<sizeof($all_products); $j++)
                        {
                            echo "<td align='center'>" . $all_products[$j]['name'] . "</td>";
                        }
            echo "</tr>
                <tr>";
                        for ($j=$i; $j<$i+$elements_on_row && $j<sizeof($all_products); $j++)
                        {
                            echo "<td align='center'><b>" . $all_products[$j]['price'] . "</b></td>";
                        }
            echo "</tr>";

            echo "<tr>";
                    for ($j=$i; $j<$i+$elements_on_row && $j<sizeof($all_products); $j++)    
                    {
                        echo "<td align='center'>
                                <table cellspacing='10px'>
                                    <tr>
                                      <td>
                                        <form action='product_page_mvc.php' method='POST'>
                                        <div class='field padding-bottom--24'>
                                            <input type='submit' name='choosen_product_to_learn_more' value='Learn more'>
                                                <input type='hidden' name='choosen_product_to_learn_more' value='". $all_products[$j]['id'] . "'>
                                        </div>
                                        </form>
                                      </td>
                                      <td>
                                        <form action='cart.php' method='POST'>
                                        <div class='field padding-bottom--24'>
                                            <input type='submit' name='choosen_product' value='Add to cart'>
                                                <input type='hidden' name='choosen_product' value='". $all_products[$j]['id'] . "'>
                                        </div>
                                        </form>
                                      </td>
                                    </tr>
                                </table>
                                    
                                    
                            </td>";
                    }
            echo "</tr>";
        
        echo "</table>";
    }                
    echo '</div>';

    echo $page->footer;
    include 'style_mainmenu.css';
?>
