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
	        <form action="upload.php" method="post" enctype="multipart/form-data">
                first name : <input id = "fName" type="text" name="fname"><br>
                last name : <input id = "lName" type="text" name="lname"><br>
                password : <input id = "password" type="password" name="password"><br>
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="change" name="submit">
            </form>
        </div>
    </div>
<?php
    require_once("templates/footer.php");
?>
