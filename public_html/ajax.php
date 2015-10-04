<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eBay";
if ( isset( $_POST['action'] ) ) {
    switch ( $_POST['action'] ) {
    case 'login': logIn( $_POST['eMail'] , $_POST['password'] );break;
    case 'signup': signUp($_POST['eMail'] , $_POST['password'] ,$_POST['firstname'] , $_POST['lastname'] );break;
    case 'editprofile': editprofile($_POST['eMail'] , $_POST['password'] ,$_POST['firstname'] , $_POST['lastname'] ,$_POST['newpassword'] , $_POST['avatar'] )
    case 'upload_image':uploadImage();break;
    case 'add_to_cart':addToCart();break;


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
       $sql = "insert into user(eMail,password,firstname,lastname) values(" . $eMail .",". $password .",". $firstname .",". $lastname .");"
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
function showInTable( $result ) {
    if ( $result->num_rows > 0 ) {
        // output data of each row
        echo "<table class = 'table table-hover tablesorter '>";
        echo "<thead><tr>";
        while ( $finfo = $result->fetch_field() ) {
            $string = $finfo->name;
            $string = str_replace( "_", "\n", $string );
            echo "<th>".$string."</th>";
        }
        echo "</thead></tr><tbody>";
        while ( $row = $result->fetch_assoc() ) {
            echo "<tr>";
            foreach ( $row as $key => $value ) {
                if ( is_null( $row[$key] ) )
                    echo "<td>"."-NA-"."</td>";
                else if ( substr( $row[$key], 0, 4 )=="http" && ( substr( $row[$key], strlen( $row[$key] )-4, 4 )==".png"||substr( $row[$key], strlen( $row[$key] )-4, 4 )==".gif" ) )
                        echo "<td><img src=".$row[$key]."></td>";
                    else if ( substr( $row[$key], 0, 4 )=="http" )
                            echo "<td><a href=".$row[$key]." target='_blank'>link</a></td>";
                        else if ( $row[$key]=="yellow" )
                                echo "<td style ='background-color:#FFFF66;'>".$row[$key]."</td>";
                            else if ( $row[$key]=="red" )
                                    echo "<td style ='background-color:#FF0000;'>".$row[$key]."</td>";

                                else
                                    echo "<td>".$row[$key]."</td>";

            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo " 0 results";
    }
}
?>
