<?php
    require_once("templates/header.php");
?>
<div class="jumbotron">
  <div class="container">

  </div>
</div>
<div id="page-container">
    <div class = "row">
        <div class = "col-md-8" id="content">
            <div class = "error"></div>
            <!-- content -->
            this is an e-commerce site<br>
    		first name : <input id = "fName" type="text" name="fname"><br>
    	    last name : <input id = "lName" type="text" name="lname"><br>
            email : <input id = "eMail" type="text" name="eMail"><br>
            password : <input id = "password" type="password" name="password"><br>

    	    <button class=" invoke btn btn-primary signup" >signup</button>
        </div>
    </div>
<?php
    require_once("templates/footer.php");
?>
