<h1 align="center">Update product page</h1>
<div align="center">

    <form action='cms_product_page_update.php' method='POST'>
        <label><b>Choose product : </b></label>
        <select name="update_product">
<?php
    include 'Product.class.php';

    $product = new Product();
    $all_products = $product->getAllProducts();

    echo "<pre>";
    var_dump($all_products);  
    echo "</pre>";

    for ($i=0; $i<sizeof($all_products); $i++)
    {
        echo'<option value="' .$all_products[$i]['id'].'">' .$all_products[$i]['name']. '</option>';
    }
?>
        </select>
            <input type='submit' name='update' value='Update'>
    </form>
    <br/><br/>
</div>

<!-- ///////////////////////////////////////////////////////////////////// -->

<?php

    if(isset($_POST['update']))
    {
        $prod_id = $_POST['update_product'];
        echo $prod_id;
    
        $update_product = $product->getProductContent($prod_id);
        $array_gallery_string = $update_product['images'];

        $unserialized_array_gallery = unserialize($array_gallery_string);  // unserializing the serialized array
        $num_pics = sizeof($unserialized_array_gallery);

        echo "<div align='center'>
                    <form action='cms_product_page_update.php' method='POST'>
                        <table width='50%' align='center' border='1' cellpadding='10'>
                            <tr>
                                <td width='10%'>
                                    <label><b>Product name</b></label>
                                </td>
                                <td width='90%'>
                                    <input type='text' name='prod_name' size='113' value='". $update_product['name'] ."'>
                                </td>
                            </tr>
                            <tr>
                                <td width='10%'>
                                    <label><b>Product description</b></label>
                                </td>
                                <td width='90%'>
                                    <textarea name='prod_descr' rows='20' cols='110'>". $update_product['description'] ."</textarea>
                                </td>
                            </tr>";
                        echo '<tr>
                                <td width="10%">
                                    <label><b>Gallery</b></label>
                                </td>
                                <td width="90%">';

                            echo "<form action='cms_product_page_update.php' method='POST'>";
                                        $elements_on_row = 5;
                                        for($i=1; $i<=$num_pics; $i+=$elements_on_row)
                                        {
                                            for ($j=$i; $j<$i+$elements_on_row && $j<=$num_pics; $j++)
                                            {
                                                echo '<img src="' . $unserialized_array_gallery['pic_'.$j][0] .'" alt="' . $unserialized_array_gallery['pic_'.$j][0] .'" width="29%" border="1"> ';  
                                                echo "<input type='submit' name='delete_pic' value='X' style='height:20px; width:20px; color:red'>
                                                            <input type='hidden' name='pic_id' value='" . $j . "'> 
                                                            <input type='hidden' name='gallery' value='" . $array_gallery_string . "'>";  
                                                // echo $j;  
                                                
                                            }
                                        } 
                                        //var_dump($unserialized_array_gallery);
                            echo '</form>
                                </td>
                            </tr>';

  ///////////////////////////////////////////////////////////// довърши!
                        echo '<tr>
                                <td width="10%">
                                    <label><b>Add new picture/s</b></label>
                                </td>
                                <td width="90%">
                                    <form action="cms_product_page_update.php" method="POST">
                                        <label><b>Number of pictures: </b></label>
                                        <input type="text" name="number_of_pics">
                                        <input type="submit" name="submit_number_of_pics" value="Load input form">
                                    </form>';
                        echo '</td>
                            </tr>
                        </table>'; 

                echo "<br/><input type='submit' name='update_content' value='Save' style='height:30px; width:250px'>
                            <input type='hidden' name='num_pic' value='". $num_pics . "'>
                </form>
            </div>";
    }


    ///////////////////////////////////////////// DELETE PICTURE ///////////////////////////////////////////

    if(isset($_POST['delete_pic']))
    {
        $pic_id = $_POST['pic_id'];
        $serialized_gallery_string = $_POST['gallery'];

        $gallery_array = unserialize($serialized_gallery_string);
        echo "<pre>";
        var_dump($gallery_array);
        echo "</pre>";

        // довърши!
    }
    

?>