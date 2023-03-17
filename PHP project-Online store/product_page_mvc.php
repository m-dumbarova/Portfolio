<?php

    include 'Session.class.php';
    include 'Page.class.php';
    include 'Product.class.php';



//////////////////////////////////////////// SIMPLE MVC /////////////////////////////////////////////////

/////////////////////////////////////////////// model ///////////////////////////////////////////////////  
function getPageContent()
{
    $product_id = $_POST['choosen_product_to_learn_more'];
    $product = new Product();
    $array_product_page = $product->getProductContent($product_id);
    return $array_product_page;
}   

function getGallery()
{
    $product_page = getPageContent();
    $gallery = unserialize($product_page['images']);

    return $gallery;

}

/////////////////////////////////////////////// view //////////////////////////////////////////////////// 
//////////////////////////////////////////////////////// Design 1 - only 1 pic
function stylePageContent_1($page_content)
{
    $pic = unserialize($page_content['images']);

    $html = '<div align="center">  
                <br/>
                <h1>' . $page_content['name'] . '</h1>
                
                <table width="70%" valign="top" style="border-spacing: 40px;">
                    <tr>
                        <td width="50%">
                            <img src="'. $pic['pic_1'][0] .'" alt="'. $pic['pic_1'][1] .'" width="100%">
                        </td>
                        <td width="50%">
                            ' . $page_content['description'] . '
                            <br/><b>Stock: </b>' . $page_content['stock'] . '
                            <br/><br/><b>Price: </b>' . $page_content['price'] . '
                            <br/><br/>
                            <form action="cart.php" method="POST">
                            <div class="field padding-bottom--24">
                                <input type="submit" name="choosen_product" value="Add to cart">
                                    <input type="hidden" name="choosen_product" value="'. $page_content['prod_id'] . '">
                            </div>
                            </form>
                        </td>
                    </tr>
                </table>
             </div>';

    return $html;
}

////////////////////////////////////////////////// Design 2 - more than 1 pic - pics after each other
function stylePageContent_2($page_content)
{
    //echo "This product has more than 1 pic -> gallery view";

    $pic = unserialize($page_content['images']);
    $html = '<div align="center" width="70%">
                <br/>
                <h1>' . $page_content['name'] . '</h1><br/>';

                for($i=1; $i<=sizeof($pic); $i++)
                {
                    $html .= '<img src="'. $pic['pic_'.$i][0] .'" alt="'. $pic['pic_'.$i][1] .'" width="200px" border="1">&nbsp; &nbsp;';
                }
    $html .= '</div>
                <br/></br>
                <div align="center">
                <table align="center" width="50%" style="border-spacing: 40px;">
                    <tr>
                        <td width="50%">
                            <img src="'. $pic['pic_1'][0] .'" alt="'. $pic['pic_1'][1] .'" width="100%">
                        </td>
                        <td width="50%">
                            ' . $page_content['description'] . '
                            <br/><b>Stock: </b>' . $page_content['stock'] . '
                            <br/><br/><b>Price: </b>' . $page_content['price'] . '
                            <br/><br/>
                            <form action="cart.php" method="POST">
                            <div class="field padding-bottom--24">
                                <input type="submit" name="choosen_product" value="Add to cart">
                                    <input type="hidden" name="choosen_product" value="'. $page_content['prod_id'] . '">
                            </div>
                            </form>
                        </td>
                    </tr>
                </table>
                </div>';
    return $html;
}

/////////////////////////////////////////////////////// Design 3 - more than 1 pic - gallery view
function stylePageContent_3($page_content)
{
    //echo "This product has more than 1 pic -> gallery view via JavaScript";
    
    $pic = unserialize($page_content['images']);

}


///////////////////////////////////////////// controller //////////////////////////////////////////////// 
function loadPageContent()
{
    $page = new Page("shop.php");
    echo $page->header;

    $page_content = getPageContent();
    $gallery = getGallery();
    $num_pics = sizeof($gallery);

    if ($num_pics == 1)
    {
        return stylePageContent_1($page_content);
    }

    if ($num_pics > 1)
    {
        return stylePageContent_2($page_content);
    }

      
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['choosen_product_to_learn_more']))
{

    $product_id = $_POST['choosen_product_to_learn_more'];
    echo loadPageContent();
}

    include 'style_mainmenu.css';
?>