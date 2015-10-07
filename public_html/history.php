<?php
    require_once("templates/header.php");
?>
<div id="container">
    <script >loadHistoryProducts();</script>
    <table id = "myTable" class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>thumbnail</th>
          <th>quantity</th>
          <th>unit price</th>
          <th>cost</th>
        </tr>
      </thead>
      <tbody>
        <tr></tr>
      </tbody>
    </table>
<?php
    require_once("templates/footer.php");
?>
