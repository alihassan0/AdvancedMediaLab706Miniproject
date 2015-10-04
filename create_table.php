<?php
	
$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
mysqli_query($con, "DROP DATABASE eBay");
if( mysqli_query($con, "CREATE DATABASE eBay"))
       	echo "db created";
else echo "error in db";

mysqli_select_db($con, "eBay");
mysqli_query($con, "CREATE TABLE user(eMail varchar(50) NOT NULL,firstName varchar(20) NOT NULL,
					lastName varchar(20) NOT NULL,password varchar(50) NOT NULL,avatar varchar(100),
					PRIMARY KEY(eMail));");
mysqli_query($con, "CREATE TABLE product(id int NOT NULL AUTO_INCREMENT ,name varchar(20),
					stock int NOT NULL, description varchar(100) , thumbnail varchar(100), PRIMARY KEY(id));");

mysqli_query($con, "CREATE TABLE transaction(id int NOT NULL , eMail varchar(20) NOT NULL ,sell int,
					FOREIGN KEY (eMail) REFERENCES user(eMail),FOREIGN KEY (id) REFERENCES product(id),
					PRIMARY KEY(id,eMail));");

?>
<?php 
header("Location: table_fill.php");
?>