<?php

include 'DBConnect.class.php';
include 'Person.class.php';
include 'User.class.php';
include 'Session.class.php';
include 'Product.class.php';

//var_dump($_SERVER);
$invalid_user=false;
/*if (isset($_GET['page']))
{
  $page=$_GET['page'];
}
else{
  $page='index.php';
}
*/
$page = $_SERVER['HTTP_REFERER'];
if (isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $page=$_POST['page'];
    $db_handle = DBConnect::getInstance();
    $logged_in_user = new User();
    $result = $logged_in_user->getUser_1($username,$password);

    if($result)
    {
      $client_id = $result->clientID;
      $login_username = $result->username;

      $session = new Session();
      $session->setUsername($login_username);
      $session->setClientID($client_id);
      $cart_content = new Product();
      $cart_content->mergeCartContent();
      header ("Location: ".$page);
      //header ("Location: ".$_SERVER['HTTP_REFERER']);  // returns the URL of the page, which is the referrer to login.php
    }
    else 
    {
      $invalid_user=true;
    }
  }
?>


<html>
<head>
  <meta charset="utf-8">
  <title>Cadeauwinkel vanhout.art: Sign in</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="#" rel="dofollow">Gift store vanhout.art</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15" style="color:#83b735;">Sign in to your account</span>
              <form  action="login.php" method="POST">
                <div class="field padding-bottom--24">
                  <label for="username">Username</label>
                  <input type="text" name="username">
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                    <div class="reset-pass">
                      <a href="#">Forgot your password?</a>
                    </div>
                  </div>
                  <input type="text" name="password">
                </div>
<!--
                <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                  <label for="checkbox">
                    <input type="checkbox" name="checkbox"> Stay signed in for a week
                  </label>
                </div>
-->
                <div class="field padding-bottom--24">
                  <input type="submit" name="login" value="Log in">
                  <input type="hidden" name="page" value="<?php echo $page ?>">
                </div>
              </form>
            </div>
          </div>
          <div class="footer-link padding-top--24">
<?php
    if ($invalid_user)
    {
      echo "<b><span style='color:red;'>No such user here.</span></b>";
    } 
?>

            <span>Don't have an account? <a href="signup.php">Sign up</a></span>
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">Gift store vanhout.art</a></span>
              <span><a href="#">Contact</a></span>
              <span><a href="#">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
