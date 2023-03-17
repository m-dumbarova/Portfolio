<?php
    include 'DBConnect.class.php';
    include 'Person.class.php';
    include 'User.class.php';
    include 'Session.class.php';

    $page = $_SERVER['HTTP_REFERER'];
    echo $page;

    if (isset($_POST['signup']))
    {
        // Create new client and new user
        if(isset($_POST['username']) && 
           isset($_POST['password'])  &&
           isset($_POST['first_name']) && 
           isset($_POST['surname']) &&
           isset($_POST['email']) &&
           isset($_POST['phone']) &&
           isset($_POST['street']) &&
           isset($_POST['house_number']) &&
           isset($_POST['post_code']) &&
           isset($_POST['city']) &&
           isset($_POST['country']) )
        {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $first_name = $_POST['first_name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $street = $_POST['street'];
            $house_number = $_POST['house_number'];
            $post_code = $_POST['post_code'];
            $city = $_POST['city'];
            $country = $_POST['country'];

            $client = new Person();
            $client_id = $client->createNewPerson($first_name,$surname,$email,$phone,$street,$house_number,$post_code,$city,$country);
            
            $user = new User();
            $user->createNewUser($client_id,$username,$password);

            $session = new Session();
            $session->setUsername($username);

           // echo $page;
           //exit();

           // header ("Location: ".$page);   // doesn't work
        }
        // Create new client (order as a guest)
        elseif (!isset($_POST['username']) && $_POST['username'] = '' &&
            !isset($_POST['password'])  && $_POST['password'] = '' &&
            isset($_POST['first_name']) && 
            isset($_POST['surname']) &&
            isset($_POST['email']) &&
            isset($_POST['phone']) &&
            isset($_POST['street']) &&
            isset($_POST['house_number']) &&
            isset($_POST['post_code']) &&
            isset($_POST['city']) &&
            isset($_POST['country']) )
            {
            $username = NULL;
            $password = NULL;
            $first_name = $_POST['first_name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $street = $_POST['street'];
            $house_number = $_POST['house_number'];
            $post_code = $_POST['post_code'];
            $city = $_POST['city'];
            $country = $_POST['country'];

            $client = new Person();
            $client_id = $client->createNewPerson($first_name,$surname,$email,$phone,$street,$house_number,$post_code,$city,$country);

            $session = new Session();
            $session->setUsername("Guest");
            var_dump($_SESSION);
            // header ("Location: ".$page);  // doesn't work
        }
        else
        {
            echo "Please, fill in all the information.";
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
              <form id="signup_form" action="signup.php" method="POST">
                    <div class="field padding-bottom--24">
                        <label for="username">Username</label>
                        <input type="username" name="username">
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="password">Password</label>
                        </div>
                        <input type="password" name="password">
                    </div>
                    <span class="padding-bottom--15" style="color:#83b735;">Order as a guest</span>
                    <div class="field padding-bottom--24">
                        <label for="first_name">First name</label>
                        <input type="first_name" name="first_name">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="surname">Surname</label>
                        <input type="surname" name="surname">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="email">E-mail</label>
                        <input type="email" name="email">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="phone">Phone</label>
                        <input type="phone" name="phone">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="street">Street</label>
                        <input type="street" name="street">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="house_number">House number</label>
                        <input type="house_number" name="house_number">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="post_code">Post code</label>
                        <input type="post_code" name="post_code">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="city">City</label>
                        <input type="city" name="city">
                    </div>
                    <div >
                        <label for="country">Country</label>
                        <select id="country" name="country" form="signup_form">
                            <option value="The Netherlands">The Netherlands</option>
                            <option value="Germany">Germany</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="USA">USA</option>
                        </select>
                    </div>

                    <div class="field padding-bottom--24">
                        <input type="submit" name="signup" value="Sign up">
                    </div>
              </form>
              </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>Have an account? <a href="login.php">Log in</a></span>
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


