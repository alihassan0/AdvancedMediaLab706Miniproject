<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );

$con = mysqli_connect( "localhost", "root", "", "eBay" ) or die( mysql_error() );
mysqli_query( $con, "insert into user(eMail,firstname,lastname,password) values('omar.ihab.12@gmail.com','omar','omar','omar')" );
$text = file_get_contents("public_html/js/data.json");
$json = json_decode($text, true);//parse Json data

foreach ($json['data'] as $key => $value)
{
	mysqli_query($con , "insert into product(name,thumbnail,stock,description) values('$value[name]','$value[path]',5 , 'fresh')");
}
?>