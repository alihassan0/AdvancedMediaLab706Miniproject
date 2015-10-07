<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eBay";
session_start();
if ( isset( $_POST['action'] ) ) {
    switch ( $_POST['action'] ) {
    case 'login': logIn( $_POST['eMail'] , $_POST['password'] );break;
    case 'addtoCart': addToCart($_POST['id'] , $_POST['quantity']);break;
    case 'buy': buy($_POST['id'] , $_POST['quantity']);break;
    case 'signup': signUp($_POST['eMail'] , $_POST['password'] ,$_POST['firstname'] , $_POST['lastname'] );break;
    case 'upload_image':uploadImage();break;
    case 'add_to_cart':addToCart();break;
    case 'load_products':loadProducts();break;
    case 'load_cart_products':loadCartProducts();break;
    case 'load_history_products':loadHistoryProducts();break;
    case 'signOut':signOut();break;
    }
    exit();
}
function logIn( $eMail , $password ) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $sql = "select * from user where eMail = '$eMail' and password = '$password';";
    //echo "$sql";
    $result = $conn->query( $sql );
    $row = $result->fetch_assoc();
    //showInTable($result);
    if ( $result->num_rows > 0 ) {
        $_SESSION["eMail"] = $eMail;
        $_SESSION["avatar"] =  $row["avatar"];
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
function loadCartProducts() {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "select product.id, product.thumbnail, cart.quantity ,product.price from product , cart where cart.id = product.id and cart.eMail = '".$_SESSION["eMail"]."';";
    $result = $conn->query( $sql );
    while ( $row = $result->fetch_assoc()) 
        array_push($return_arr, array('id' => $row["id"],'thumbnail' => $row["thumbnail"], 'quantity'=> $row["quantity"],'price'=> $row["price"]));

    echo json_encode($return_arr);
    //---------------------------------------------------
    $conn->close();
}
function loadHistoryProducts() {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "select product.id, product.thumbnail, transaction.quantity ,product.price from product , transaction where transaction.id = product.id and transaction.eMail = '".$_SESSION["eMail"]."';";
    $result = $conn->query( $sql );
    while ( $row = $result->fetch_assoc()) 
        array_push($return_arr, array('id' => $row["id"],'thumbnail' => $row["thumbnail"], 'quantity'=> $row["quantity"],'price'=> $row["price"]));

    echo json_encode($return_arr);
    //---------------------------------------------------
    $conn->close();
}
function buy($id , $quantity) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "INSERT into transaction (id ,eMail, quantity) select id ,eMail, quantity from cart where email = '".$_SESSION["eMail"]."';";
    $result = $conn->query( $sql );
    $sql = "UPDATE product INNER JOIN cart ON (product.id = cart.id) SET product.stock = product.stock - cart.quantity where cart.eMail = '".$_SESSION["eMail"]."';";
    $result = $conn->query( $sql );
    $sql = "truncate cart;";
    $result = $conn->query( $sql );
    //---------------------------------------------------
    $conn->close();
}

function signUp($eMail,$password,$firstname,$lastname) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    $sql = "select * from user where eMail = '$eMail';";
    $result = $conn->query( $sql );
    $row = $result->fetch_assoc();
    if ( $result->num_rows > 0 ) {
        echo '<script language="javascript">';
        echo 'alert("this mail is already used")';
        echo '</script>'; 
    }
    else if ($eMail == "" || $password == "" || $firstname == "" || $lastname == "" )  {
        echo '<script language="javascript">';
        echo 'alert("you must enter the eMail , password ,firstname and lastname ")';
        echo '</script>';
    }
    else {
       $sql = "insert into user(eMail,password,firstname,lastname) values('" . $eMail ."','". $password ."','". $firstname ."','". $lastname ."');";
        echo "ok";
       $result = $conn->query( $sql );     
    }
    $conn->close();
}

function signOut() {
 session_destroy();
}
function addToCart($id , $quantity) {
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "insert into cart(id,eMail,quantity) values('$id','".$_SESSION["eMail"]."','$quantity')";
    $result = $conn->query( $sql );
    echo "$sql";
    //---------------------------------------------------
    $conn->close();
}
function uploadImage() {
    if(isset($_FILES["file"]["type"]))
    {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
        ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
        && in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
            }
            else
            {
                if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                }
                else
                {
                    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
                    move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                }
            }
        }
    }
}
function upload() {
    $target_dir = "img/avatars/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $conn = new mysqli( $GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname'] );
    //----------------------------------------------------
    $return_arr = Array();
    $sql = "insert into cart(id,eMail,quantity) values('$id','".$_SESSION["eMail"]."','$quantity')";
    $result = $conn->query( $sql );
    echo "$sql";
    //---------------------------------------------------
    $conn->close();
}

?>
