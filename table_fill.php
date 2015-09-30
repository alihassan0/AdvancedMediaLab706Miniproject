<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );

$con = mysqli_connect( "localhost", "root", "", "eBay" ) or die( mysql_error() );
mysqli_query( $con, "insert into user(eMail,firstname,lastname,password) values('omar.ihab.12@gmail.com','omar','omar','omar')" );
mysqli_query($con , "insert into product(name,eMail,stock) values('ay7aga','omar',5)");
?>