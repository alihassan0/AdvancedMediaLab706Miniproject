<?php
    // load up your config file
    //require_once("/path/to/resources/config.php");
     
    require_once("templates/header.php");
?>
<div id="container">
    <!-- content -->
    <div class = "row">
        <div class="col-md-4 col-md-offset-4">
        <div class = "error"></div>
        this is an e-commerce site<br>
        user name: <input id = "userName" type="text" name="fname"><br>
        password: <input id = "password" type="text" name="lname"><br>
        <button class=" invoke btn btn-primary login" >login</button><p>
        <a class="btn btn-default" href="signup.php" role="button">signUp</a></p>
        <a href="">forgot password</a>
        </div>
    </div>
<?php
    require_once("templates/footer.php");
?>
