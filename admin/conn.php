<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "fruitables";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
   // echo "connection is ok";
} else {
    echo "connection is faild";
}






// $fname = $_POST['fname'];
// $email = $_POST['email'];
// $message = $_POST['message'];

// $conn = new mysqli('localhost','root','','form_user');

// if($conn->connect_error){
//     die('Connection faild :'.$conn->connect_error);
// }

// else{
//     $stmt - $conn->prepare("insert into registration (fname,email,message)");
//     $stmt->bind_param("sss",$fname,$email,$message);
//     $stmt->execute();
//     echo "Form submited";
//     $stmt->close();
//     $conn->close();
// }
