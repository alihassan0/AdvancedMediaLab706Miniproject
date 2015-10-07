<?php
    require_once("templates/header.php");
?>
<div id="container">
    <!-- content -->
    <script >
      loadProducts();
    </script>
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome to our grocery shop</h1>
        <p>here you can find all the best fruits and vegetables</p>
      </div>
    </div>
    <div class="page-container">
      <div class="row">
        <div class="template col-sm-6 col-md-3">
          <div class="thumbnail">
            <img class = "productImage" src="img/btngan.jpg" alt="...">
            <div class="caption">
              <h3 class = "productName" >btngan</h3>
              <p class = "productDescription">best btngan evaaaa...</p>
              <p><input class = "productQuantity" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input></p>
              <p class = "productStockmsg ">available:</p> 
              <p class = "productStock ">available:</p> 
              <p><a  id="" class="btn btn-default stitched cart productBuy" role="button">buy</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>    
<?php
    require_once("templates/footer.php");
?>
