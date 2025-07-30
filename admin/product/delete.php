<?php
include('..\conn.php');
// ------------query for deletion product
$id = $_GET['id'];

$qry = "DELETE FROM product WHERE id = '$id'";
$rest = mysqli_query($conn, $qry);
if ($rest) {
    header('location:..\..\admin\product\ManageProduct.php');
} else {
    echo '<script>alert("deletion faild")</script>';
}

// --------------------------------------
