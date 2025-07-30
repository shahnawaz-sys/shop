<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Add to cart
        if (isset($_POST['adtcart'])) {
            // $productid = intval($_POST['product_id']); // ✅ This line is missing!
            $productid = intval($_POST['product_id']);
            $productname = htmlspecialchars($_POST['productname']);
            $price = floatval($_POST['price']);
            $productimg = htmlspecialchars($_POST['productimg']);

            if (isset($_SESSION['cart'])) {
                $myitems = array_column($_SESSION['cart'], 'productname');

                if (in_array($productname, $myitems)) {
                    echo "<script>
                        alert('Product Already Added to Cart');
                        window.location.href='shop.php';
                    </script>";
                } else {
                    $_SESSION['cart'][] = array(
                        'product_id' => $productid,
                        'productname' => $productname,
                        'price' => $price,
                        'productimg' => $productimg,
                        'quantity' => 1
                    );
                    echo "<script>
                        alert('Product Added to Cart');
                        window.location.href='shop.php';
                    </script>";
                }
            } else {
                $_SESSION['cart'][0] = array(
                    'product_id' => $productid,
                    'productname' => $productname,
                    'price' => $price,
                    'productimg' => $productimg,
                    'quantity' => 1
                );
                echo "<script>
                    alert('Product Added to Cart');
                    window.location.href='shop.php';
                </script>";
            }
        }

        // Remove from cart
        if (isset($_POST['remove'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['productname'] == $_POST['productname']) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex the array
                    echo "<script>
                        alert('Product Removed from Cart');
                        window.location.href='cart.php';
                    </script>";
                    break;
                }
            }
        }

        // Modify quantity
        if (isset($_POST['mod_quantity'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['productname'] == $_POST['productname']) {
                    $_SESSION['cart'][$key]['quantity'] = intval($_POST['mod_quantity']);
                    echo "<script>window.location.href='cart.php';</script>";
                    break;
                }
            }
        }
} 


























// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Check if user is logged in
//     if (isset($_SESSION['user_id'])) {
//         $useremail = $_SESSION['user_id'];

//         // Add to cart
//         if (isset($_POST['adtcart'])) {
//             // $productid = intval($_POST['product_id']); // ✅ This line is missing!
//             $productid = intval($_POST['product_id']);
//             $productname = htmlspecialchars($_POST['productname']);
//             $price = floatval($_POST['price']);
//             $productimg = htmlspecialchars($_POST['productimg']);

//             if (isset($_SESSION['cart'])) {
//                 $myitems = array_column($_SESSION['cart'], 'productname');

//                 if (in_array($productname, $myitems)) {
//                     echo "<script>
//                         alert('Product Already Added to Cart');
//                         window.location.href='shop.php';
//                     </script>";
//                 } else {
//                     $_SESSION['cart'][] = array(
//                         'product_id' => $productid,
//                         'productname' => $productname,
//                         'price' => $price,
//                         'productimg' => $productimg,
//                         'quantity' => 1
//                     );
//                     echo "<script>
//                         alert('Product Added to Cart');
//                         window.location.href='shop.php';
//                     </script>";
//                 }
//             } else {
//                 $_SESSION['cart'][0] = array(
//                     'product_id' => $productid,
//                     'productname' => $productname,
//                     'price' => $price,
//                     'productimg' => $productimg,
//                     'quantity' => 1
//                 );
//                 echo "<script>
//                     alert('Product Added to Cart');
//                     window.location.href='shop.php';
//                 </script>";
//             }
//         }

//         // Remove from cart
//         if (isset($_POST['remove'])) {
//             foreach ($_SESSION['cart'] as $key => $value) {
//                 if ($value['productname'] == $_POST['productname']) {
//                     unset($_SESSION['cart'][$key]);
//                     $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex the array
//                     echo "<script>
//                         alert('Product Removed from Cart');
//                         window.location.href='cart.php';
//                     </script>";
//                     break;
//                 }
//             }
//         }

//         // Modify quantity
//         if (isset($_POST['mod_quantity'])) {
//             foreach ($_SESSION['cart'] as $key => $value) {
//                 if ($value['productname'] == $_POST['productname']) {
//                     $_SESSION['cart'][$key]['quantity'] = intval($_POST['mod_quantity']);
//                     echo "<script>window.location.href='cart.php';</script>";
//                     break;
//                 }
//             }
//         }
//     } else {
//         echo "<script>
//             alert('You must be logged in to manage your cart.');
//             window.location.href='index.php';
//         </script>";
//     }
// }
?>






























<?php

// session_start();

// $showpopupmodel = false;
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $useremail = $_SESSION['user_id'];
//     if ($useremail == true) {


//         if (isset($_POST['adtcart'])) {
//             if (isset($_SESSION['cart'])) {
//                 $myitems = array_column($_SESSION['cart'], 'productname');

//                 if (in_array($_POST['productname'], $myitems)) {
//                     echo "<script>alert('Product Already Added to Cart')
//                              window.location.href='shop.php';
//                           </script
//                 </script>";
//                 } else {
//                     $count = count($_SESSION['cart']);
//                     $_SESSION['cart'][$count] = array('productname' => $_POST['productname'], 'price' => $_POST['price'], 'productimg' => $_POST['productimg'], 'quantity' => 1);
//                     echo "<script>alert('Product Added to Cart')
//                            window.location.href='shop.php';
//                          </script
//                 </script>";
//                 }
//             } else {
    //             $_SESSION['cart'][0] = array('productname' => $_POST['productname'], 'price' => $_POST['price'], 'productimg' => $_POST['productimg'], 'quantity' => 1);
    //             echo "<script>alert('Product Added to Cart')
    //             // window.location.href='shop.php';
    //             </script>";
    //         }
    //     }

    //     if (isset($_POST['remove'])) {
    //         foreach ($_SESSION['cart'] as $key => $value) {
    //             if ($value['productname'] == $_POST['productname']) {
    //                 unset($_SESSION['cart'][$key]);
    //                 $_SESSION['cart'] = array_values($_SESSION['cart']);
    //                 echo "<script>alert('Product Removed from Cart')
    //             window.location.href='cart.php';</script
    //             </script>";
    //             }
    //         }
    //     }
    //     if (isset($_POST['mod_quantity'])) {
    //         foreach ($_SESSION['cart'] as $key => $value) {
    //             if ($value['productname'] == $_POST['productname']) {
    //                 $_SESSION['cart'][$key]['quantity'] = $_POST['mod_quantity'];

    //                 echo "<script> window.location.href='cart.php';</script>";
    //             }
    //         }
    //     }
    // } else {
    //     header("location:index.php");
    //     $showpopupmodel = true;
    // }
// }
