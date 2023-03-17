<h1 align="center">New product page"</h1>
<div align="center">

    <form action='cms_product_page_add.php' method='POST'>
        <label><b>Number of pictures. </b></label>
        <input type="text" name="number_of_pics">
            <input type='submit' name='submit_number_of_pics' value='Load input form'>
    </form>
    <br/><br/>
</div>

<!-- ///////////////////////////////////////////////////////////////////// -->

<?php

    include 'Product.class.php';

    if(isset($_POST['submit_number_of_pics']))
    {
        $num_pic = $_POST['number_of_pics'];

        echo '<div align="center">
                <form action="cms_product_page_add.php" method="POST">
                    <table width="50%" align="center" border="1" cellpadding="10">
                        <tr>
                            <td width="10%">
                                <label><b>Product id</b></label>
                            </td>
                            <td width="90%">
                                <input type="text" name="prod_id">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                <label><b>Product description</b></label>
                            </td>
                            <td width="90%">
                                <textarea name="prod_descr" rows="20" cols="110"></textarea>
                            </td>
                        </tr>';

        for($i=1; $i<=$num_pic; $i++)
        {
            echo '<tr>
                    <td width="10%">
                        <label><b>Image ' . $i . '</b></label>
                    </td>
                    <td width="90%">
                        <label><b>URL  </b></label>
                            <textarea name="url_' . $i . '" rows="1" cols="105"></textarea>
                        <br/><br/>
                        <label><b>ALT  </b></label>
                            <textarea name="alt_' . $i . '" rows="1" cols="105"></textarea>
                    </td>
                </tr>';
        } 

        echo '</table>  '; 

        echo "<br/><input type='submit' name='send_content' value='SEND'>
                   <input type='hidden' name='num_pic' value='". $num_pic . "'>
        </form>
    </div>";

    }

    if(isset($_POST['send_content']))
    {
        $prod_id = $_POST['prod_id'];
        $prod_descr = $_POST['prod_descr'];
        $num_pic = $_POST['num_pic'];

        $product = new Product();
        $prod_obj = $product->getProduct($prod_id);
        $prod_name = $prod_obj['name'];

        
        // create associative array, containing all the pics of one product 
        $array_gallery = array();
        for($i=1; $i<=$num_pic; $i++)
        {
            if ($_POST['url_'.$i] != "" && $_POST['alt_'.$i] != "")
            {
                $array_gallery["pic_".$i] = array( $_POST['url_'.$i], $_POST['alt_'.$i]);
            }
        }
        /* echo "array_gallery is: ";
        echo "<pre>";
        var_dump($array_gallery);  // printing complex array
        echo "</pre>";
        echo "<br/><br/>"; */
        
        $array_gallery_string = serialize($array_gallery);  // serialize the complex array
        /* echo "The serialized array_gallery is this string: ";
        echo "<pre>";
        var_dump($array_gallery_string);  // printing the serialize array
        echo "</pre>";
        echo "<br/><br/>"; */


        // import product information to DB
        $stmt = $product->dbh->prepare("INSERT INTO product_pages (prod_id, images, description)  
                                                     VALUES ('$prod_id', '$array_gallery_string', '$prod_descr')");
        $stmt->execute(); 

        //echo "Product page successfully created. Do you want to add new page?";

    }

?>