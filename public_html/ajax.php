<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eBay";
if ( isset( $_POST['action'] ) ) {
    switch ( $_POST['action'] ) {
    case 'login': logIn( $_POST['eMail'] , $_POST['password'] );break;
    case 'buy': buy($_POST['id'] , $_POST['quantity']);break;
    case 'signup': signUp($_POST['eMail'] , $_POST['password'] ,$_POST['firstname'] , $_POST['lastname'] );break;
    case 'editprofile': editprofile($_POST['eMail'] , $_POST['password'] ,$_POST['firstname'] , $_POST['lastname'] ,$_POST['newpassword']);break;
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

function signUp($eMail,$password,$firstname,$lasttname) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    $sql = "select * from user where eMail = " . $eMail .";";
    $result = $conn->query( $sql );
    if ( $result->num_rows > 0 ) {
        echo '<script language="javascript">';
        echo 'alert("this mail is already used")';
        echo '</script>'; 
    }
    else if ($eMail == "" || $password == "" || $firstname == "" || $lasttname == "" )  {
        echo '<script language="javascript">';
        echo 'alert("you must enter the eMail , password ,firstname and lastname ")';
        echo '</script>';
    }
    else {
       $sql = "insert into user(eMail,password,firstname,lastname) values(" . $eMail .",". $password .",". $firstname .",". $lastname .");";
       $result = $conn->query( $sql );     
    }
    $conn->close();
}
function editprofile($eMail,$password,$firstname,$lasttname,$newpassword,$avatar){
    $sql = "select * from user where eMail = .". $eMail . "and password = ". $password .";";
    $result = $conn->query( $sql );
    if ( $result->num_rows > 0 ) {
        if($firstname != ""){
            $sql = "update user set firstname = ". $firstname ." where eMail = .". $eMail .";";
        }
        if($lastname != ""){
            $sql = "update user set lastname = ". $lastname ." where eMail = .". $eMail .";";
        }
        if($avatar != ""){
            $sql = "update user set avatar = ". $avatar ." where eMail = .". $eMail .";";
        }
        if($newpassword != ""){
            $sql = "update user set password = ". $newpassword ." where eMail = .". $eMail .";";
        }
    }
    else {
        echo '<script language="javascript">';
        echo 'alert("the mail or the password is wrong")';
        echo '</script>';
    }
    //---------------------------------------------------
    $conn->close();


}
function uploadImage() {

}
function addToCart() {

}

?>
