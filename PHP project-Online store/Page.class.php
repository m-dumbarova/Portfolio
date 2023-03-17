<?php

    class Page
    {
        public $header;
        public $body;
        public $footer;
        function __construct($page_name)
        {
            $this->header = $this->show_header($page_name);
            $this->footer = $this->show_footer($page_name);
        }

        protected function show_header($page)
        {
           // session_start();
            
            $session_data = new Session();
            //var_dump($_SESSION);
            $main_menu = '';
            
            
            if ($session_data->getUsername() != "guest" && $session_data->getUsername() != "")
            {
                // $main_menu .= "Welcome ". $session_data->username;
                // $main_menu .= ". You can log out from <a href='logout.php'>here</a>.<br/><br/>";

                $main_menu .= '	<div class="top-header">
                                <table width="100%">
                                    <tr>
                                        <td width="50%" align="left">
                                            <a href="logout.php">
                                                <img src="https://martinadumbarova.info/educom_pics/logout.png" height="35px">
                                                Log out
                                            </a>
                                                &nbsp; &nbsp; &nbsp;   Welcome, '. $session_data->username .'.

                                        </td>
                                        <td width="50%" align="right">
                                            <a href="cart.php"><img src="https://martinadumbarova.info/educom_pics/cart.png" height="35px"></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="topnav" align="center">
                                <a href="index.php">Home</a>
                                <a href="#">About</a>
                                <a href="shop.php">Products</a>
                                <a href="#">Contact</a>
                                <!--
                                <a href="admin.php">Admin</a>
                                -->
                            </div>
                            
                            <div class="logo" align="center">
                                <a href="index.php" class="logo"><img src="https://martinadumbarova.info/educom_pics/logo.png" width="300px"/></a>
                            </div>'; 
            }
            else
            {

               // $main_menu .= "Hello, guest. You are not logged in! Please, <a href='login.php'>log in</a>.<br/><br/>";
        
                $main_menu .= '	<div class="top-header">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" align="left">
                                                <a href="login.php">
                                                    <img src="https://martinadumbarova.info/educom_pics/login.png" height="30px">
                                                    Log in</a>
                                                <a href="signup.php"> / Sign up</a>
                                                &nbsp; &nbsp; &nbsp;   Hello, guest.
                                            </td>
                                            <td width="50%" align="right">
                                                <a href="cart.php"><img src="https://martinadumbarova.info/educom_pics/cart.png" height="30px"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="topnav" align="center">
                                    <a href="index.php">Home</a>
                                    <a href="#">About</a>
                                    <a href="shop.php">Products</a>
                                    <a href="#">Contact</a>
                                    <!--
                                    <a href="admin.php">Admin</a>
                                    -->
                                </div>
                                
                                <div class="logo" align="center">
                                    <a href="index.php" class="logo"><img src="https://martinadumbarova.info/educom_pics/logo.png" width="300px"/></a>
                                </div>'; 
            }              
            return $main_menu;
        }
    
    
    
        protected function show_footer($page)
        {
            $footer = "<div class='footer'>
                            <center><a href='products_list_v.4.php'><img src='https://martinadumbarova.info/educom_pics/logo_white.png'  height='100px;'/></a></center>
                        </div>";
            return $footer;
        }

    }

?>