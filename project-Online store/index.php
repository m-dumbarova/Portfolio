<?php  

    include 'Session.class.php';
	include 'Page.class.php';
	// include 'Product.class.php';
	

	
	
	$page = new Page("index.php");
	//include 'style_mainmenu.css';
	
    echo $page->header;
	echo '<div align="center">
			<a href="shop.php"><img src="https://vanhout.art/wp-content/uploads/home-page-banner-2-in-1-2048x577.jpg" width="100%"></a>
		 </div>';
	
	echo $page->footer;

	include 'style_mainmenu.css';
?>
