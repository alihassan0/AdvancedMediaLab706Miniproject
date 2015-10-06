<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>the btngan shop</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/mystyle.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
  </head>
  <?php  session_start() ?>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">btnganShop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <?php 
              if(isset($_SESSION["eMail"]))
              {
                echo '<li><a href="cart.php" role="button">'.$_SESSION["eMail"].'</a></li>';
                echo '<li><a href="history.php" role="button">history</a></li>';
                echo '<li><a href="cart.php" role="button">cart</a></li>';
                echo '<li><a class="btn" href="signup.php" role="button">sign out</a></p></li>';
              }
              else
              {
                echo '<li><a  href="signup.php" role="button">sign up</a></p></li>';
                echo '<li><a  href="index.php" role="button">sign in</a></p></li>';
              }
              ?>
          </ul>
          <li>$_SESSION["eMail"]</li>
        </div>
      </div>
    </nav>
    
