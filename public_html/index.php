<?php
    // load up your config file
    //require_once("/path/to/resources/config.php");
     
    require_once("templates/header.php");
?>
<div id="container stitched">
    <?php
        require_once("templates/rightPanel.php");
    ?>
    <div class = "col-md-8" id="content">
        <!-- content -->
        this is an e-commerce site<br>
		user name: <input type="text" name="fname"><br>
	    password: <input type="text" name="lname"><br>
	    <input type="button" class='login' name="newThread" value="click here" onclick="window.open('home.php')"/>
        <button class=" invoke btn btn-primary login" >login</button>
    </div>
</div>
<?php
    require_once("templates/footer.php");
?>
