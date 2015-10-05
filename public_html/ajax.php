<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eBay";
if ( isset( $_POST['action'] ) ) {
    switch ( $_POST['action'] ) {
    case 'login': logIn( $_POST['eMail'] , $_POST['password'] );break;
    case 'signup': signUp();break;
    case 'buy': buy($_POST['id'] , $_POST['quantity']);break;
    case 'upload_image':uploadImage();break;
    case 'add_to_cart':addToCart();break;
    case 'load_products':loadProducts();break;
    }
    exit();
}
function logIn( $eMail , $password ) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $sql = "select * from user where eMail = '$eMail' and password = '$password';";
    echo "$sql";
    $result = $conn->query( $sql );
    //showInTable($result);
    if ( $result->num_rows > 0 ) {
        echo 0;//navigate to php page 
    }
    else {
        echo 1; //navigate to sign up page
    }
    //---------------------------------------------------
    $conn->close();
}
function loadProducts() {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "select * from product";
    $result = $conn->query( $sql );
    
    while ( $row = $result->fetch_assoc()) 
        array_push($return_arr, array('id' => $row["id"],'name' => $row["name"], 'stock'=> $row["stock"],'description'=> $row["description"] , 'thumbnail'=> $row["thumbnail"]));

    echo json_encode($return_arr);
    //---------------------------------------------------
    $conn->close();
}
function buy($id , $quantity) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "insert into transaction(id,eMail) values('$id','omar.ihab.12@gmail.com')";
    $result = $conn->query( $sql );
    echo "$sql";
    //---------------------------------------------------
    $conn->close();
}
function signUp() {

}
function uploadImage() {

}
function addToCart() {

}

?>
