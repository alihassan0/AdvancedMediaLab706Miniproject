<?php
    require_once("templates/header.php");
?>
<div id="container stitched">
    <?php
        require_once("templates/rightPanel.php");
    ?>
    <div class = "col-md-8" id="content">
        <!-- content -->
        this is an e-commerce site<br>
		first name : <input id = "fName" type="text" name="fname"><br>
	    last name : <input id = "lName" type="text" name="lname"><br>
        email : <input id = "eMail" type="text" name="lname"><br>
        password : <input id = "password" type="password" name="password"><br>

	    <button class=" invoke btn btn-primary login" >login</button>
    </div>
</div>
<?php
    require_once("templates/footer.php");
?>
