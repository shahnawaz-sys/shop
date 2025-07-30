<?php
include('admin\conn.php');
session_start();

// product id get-----------
// $id = $_GET['id'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// product id-----------

// query for selecting
$qry = "SELECT * FROM store";
$res = mysqli_query($conn, $qry);
$qryresfatch = mysqli_fetch_assoc($res);
// ------------------


// ----qry for product order""

// if (isset($_POST['placeorder'])) {
//     $user_id = $_SESSION['user_id'];  // Get user ID from session
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $mobileno = $_POST['mobileno'];
//     $city = $_POST['city'];
//     $address = $_POST['address'];
//     $discriptext = $_POST['text'];
//     $orderqry = "INSERT INTO users_data(user_id , firstname , lastname , mobileno , city , address , client_msg) 
//                                 value ('$user_id','$firstname','$lastname','$mobileno','$city','$address','$discriptext')";



//     $itemqry = "INSERT INTO order_items(order_id, product_id, qty, t_price)value()";




//     $orderplaceqry = mysqli_query($conn, $orderqry);
//     // Run the query
//     if ($orderplaceqry) {
//         echo "✅ Order placed successfully!";
//     } else {
//         echo "❌ Error placing order: " . mysqli_error($conn);
//     }
// }


// Get user_id from email in session
// $email = $_SESSION['user_id']; // this is the email
// $getUserIdQuery = "SELECT usr_id FROM users_data WHERE email = '$email'";
// $getUserIdResult = mysqli_query($conn, $getUserIdQuery);

// if ($getUserIdRow = mysqli_fetch_assoc($getUserIdResult)) {
//     $user_id = $getUserIdRow['usr_id']; // ✅ correct numeric user ID
// } else {
//     die("❌ User not found in database.");
// }

// if (isset($_POST['placeorder'])) {
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $mobileno = $_POST['mobileno'];
//     $city = $_POST['city'];
//     $address = $_POST['address'];
//     $client_msg = $_POST['text'];

//     // ✅ Order query using correct numeric $user_id
//     $orderqry = "INSERT INTO user_order (user_id, firstname, lastname, mobileno, city, address, client_msg)
//                  VALUES ('$user_id', '$firstname', '$lastname', '$mobileno', '$city', '$address', '$client_msg')";

//     $orderplaceqry = mysqli_query($conn, $orderqry);

//     if ($orderplaceqry) {
//         $order_id = mysqli_insert_id($conn); // last inserted order ID


//         $userorderqry = "SELECT * FROM user_order";
//         $userorder = mysqli_query($conn, $userorderqry);
//         $userqryfatch = mysqli_fetch_assoc($userorder);
//         $userorderfatch = $userqryfatch['order_id'];

//         foreach ($_SESSION['cart'] as $item) {
//             $product_id = $item['product_id'];
//             $qty = $item['quantity'];
//             $price = $item['price'];
//             $total = $qty * $price;



//             $itemqry = "INSERT INTO order_items (order_id, product_id, qty, t_price) 
//                         VALUES ('$userorderfatch', '$product_id', '$qty', '$total')";
//             mysqli_query($conn, $itemqry);
//         }


//         unset($_SESSION['cart']); // clear cart

//         echo "<script>alert('✅ Order placed successfully!'); window.location.href='order-success.php';</script>";
//     } else {
//         echo "<script>alert('❌ Error placing order: " . mysqli_error($conn) . "');</script>";
//     }
// }


// Get user_id from email in session
// $email = $_SESSION['user_id'];
// $getUserIdQuery = "SELECT usr_id FROM users_data WHERE email = '$email'";
// $getUserIdResult = mysqli_query($conn, $getUserIdQuery);

// if ($getUserIdRow = mysqli_fetch_assoc($getUserIdResult)) {
//     $user_id = $getUserIdRow['usr_id'];
// } else {
//     die("❌ User not found in database.");
// }

// if (isset($_POST['placeorder'])) {


//     if ($email = $_SESSION['user_id']) {

//         // $email = $_SESSION['user_id'];
//         $getUserIdQuery = "SELECT usr_id FROM users_data WHERE email = '$email'";
//         $getUserIdResult = mysqli_query($conn, $getUserIdQuery);

//         if ($getUserIdRow = mysqli_fetch_assoc($getUserIdResult)) {
//             $user_id = $getUserIdRow['usr_id'];
//         }
//         // else {
//         //     echo "<script>alert('❌ User not found in database.');</script>";    
//         // }
//     } else {
//         echo "<script>alert('You should login first.');</script>";
//         header("Location: index.php");
//         error_reporting(0);
//     }


//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $mobileno = $_POST['mobileno'];
//     $city = $_POST['city'];
//     $address = $_POST['address'];
//     $client_msg = $_POST['text'];

//     $orderqry = "INSERT INTO user_order (user_id, firstname, lastname, mobileno, city, address, client_msg, status)
//     VALUES ('$user_id', '$firstname', '$lastname', '$mobileno', '$city', '$address', '$client_msg', 'Pending')";


//     $orderplaceqry = mysqli_query($conn, $orderqry);

//     if ($orderplaceqry) {
//         $order_id = mysqli_insert_id($conn); // ✅ correct order_id

//         foreach ($_SESSION['cart'] as $item) {
//             $product_id = $item['product_id'];
//             $qty = $item['quantity'];
//             $price = $item['price'];
//             $total = $qty * $price;

//             // Validate product ID before inserting
//             if (!is_numeric($product_id)) {
//                 die("❌ Invalid product_id: " . var_export($product_id, true));
//             }

//             $itemqry = "INSERT INTO order_items (order_id, product_id, qty, t_price) 
//                         VALUES ('$order_id', '$product_id', '$qty', '$total')";
//             mysqli_query($conn, $itemqry);
//         }

//         unset($_SESSION['cart']); // clear the cart

//         echo "<script>alert('✅ Order placed successfully!'); window.location.href='shop-detail.php';</script>";
//     } else {
//         echo "<script>alert('❌ Error placing order: " . mysqli_error($conn) . "');</script>";
//     }
// } 

// working query-------
// if (isset($_POST['placeorder'])) {

//     // 1. Check if user is logged in
//     if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//         echo "<script>alert('Please log in first.'); window.location='index.php';</script>";
//         exit;
//     }
//     $email = $_SESSION['user_id']; // assuming user_id session holds email

//     // 2. Get user_id from users_data table
//     $sql = "SELECT usr_id FROM users_data WHERE email = '$email'";
//     $result = mysqli_query($conn, $sql);
//     if ($row = mysqli_fetch_assoc($result)) {
//         $user_id = $row['usr_id'];
//     } else {
//         die("User not found in database.");
//     }

//     // 3. Insert order
//     $firstname  = $_POST['firstname'];
//     $lastname   = $_POST['lastname'];
//     $mobileno   = $_POST['mobileno'];
//     $city       = $_POST['city'];
//     $address    = $_POST['address'];
//     $client_msg = $_POST['text'];

//     $orderSql = "
//         INSERT INTO user_order
//         (user_id, firstname, lastname, mobileno, city, address, client_msg, status)
//         VALUES
//         ('$user_id', '$firstname', '$lastname', '$mobileno', '$city', '$address', '$client_msg', 'Pending')
//     ";

//     if (mysqli_query($conn, $orderSql)) {
//         $order_id = mysqli_insert_id($conn);

//         // 4. Insert each cart item
//         foreach ($_SESSION['cart'] as $item) {
//             $pid = $item['product_id'];
//             $qty = $item['quantity'];
//             $price = $item['price'];
//             $total = $qty * $price;

//             mysqli_query($conn, "
//                 INSERT INTO order_items
//                 (order_id, product_id, qty, t_price)
//                 VALUES
//                 ('$order_id', '$pid', '$qty', '$total')
//             ");
//         }

//         // 5. Clear cart and show success
//         unset($_SESSION['cart']);
//         echo "<script>alert('Order placed successfully!'); window.location='shop-detail.php';</script>";
//         exit;
//     } else {
//         echo "<script>alert('Error placing order: " . mysqli_error($conn) . "');</script>";
//     }
// }
// working query-------


// working query-------
// if (isset($_POST['placeorder'])) {

//     if (!isset($_SESSION['user_id'])) {
//         echo "<script>alert('Please log in first.'); window.location='index.php';</script>";
//         exit;
//     }
//     $user_id = intval($_SESSION['user_id']);

//     $fn  = mysqli_real_escape_string($conn, $_POST['firstname']);
//     $ln  = mysqli_real_escape_string($conn, $_POST['lastname']);
//     $mob = mysqli_real_escape_string($conn, $_POST['mobileno']);
//     $city = mysqli_real_escape_string($conn, $_POST['city']);
//     $addr = mysqli_real_escape_string($conn, $_POST['address']);
//     $msg  = mysqli_real_escape_string($conn, $_POST['text']);

//     $sql = "
//       INSERT INTO user_order
//         (user_id, firstname, lastname, mobileno, city, address, client_msg, status)
//       VALUES
//         ('$user_id', '$fn', '$ln', '$mob', '$city', '$addr', '$msg', 'Pending')
//     ";

//     if (mysqli_query($conn, $sql)) {
//         $order_id = mysqli_insert_id($conn);
//         foreach ($_SESSION['cart'] as $item) {
//             $pid = intval($item['product_id']);
//             $qty = intval($item['quantity']);
//             $price = floatval($item['price']);
//             $total = $qty * $price;

//             mysqli_query($conn, "
//               INSERT INTO order_items (order_id, product_id, qty, t_price)
//               VALUES ('$order_id', '$pid', '$qty', '$total')
//             ");
//         }
//         unset($_SESSION['cart']);
//         echo "<script>alert('✅ Order placed!'); window.location='shop-detail.php';</script>";
//         exit;
//     } else {
//         echo "<script>alert('Error placing order: " . mysqli_error($conn) . "');</script>";
//     }
// }
// working query-------

if (isset($_GET['id'])) {

    // Fetch the product with the specific ID
    $sqlry = "SELECT * FROM product WHERE id = '$id'";
    $relt = mysqli_query($conn, $sqlry);
    $rw = mysqli_fetch_assoc($relt);
} else {
}


// ---------query for product order---------

if (isset($_POST['placeorder'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['show_signin_modal'] = true;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }


    $user_id = $_SESSION['user_id'];
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $mob = $_POST['mobileno'];
    $city = $_POST['city'];
    $addr = $_POST['address'];
    $msg = $_POST['text'];

    $sql = "INSERT INTO user_order (user_id, firstname, lastname, mobileno, city, address, client_msg, status)
      VALUES ('$user_id', '$fn', '$ln', '$mob', '$city', '$addr', '$msg', 'Pending')";

    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $item) {
            $pid = $item['product_id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            $total = $qty * $price;
            mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, qty, t_price)
              VALUES ('$order_id', '$pid', '$qty', '$total')
            ");
        }

        unset($_SESSION['cart']);
        echo "<script>alert('✅ Order placed!'); window.location='shop-detail.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}


// --------------------


// --------------------
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT usr_id, password FROM users_data WHERE email = '$email'");
    if (mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['usr_id'];
            header("Location: chackout.php");
            exit;
        } else {
            echo "<script>alert('❌ Wrong password');</script>";
        }
    } else {
        echo "<script>alert('❌ Email not found');</script>";
    }
}
// --------------------------

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>



    <!-- form for signin first -->
    <!-- Sign-in Modal -->
    <div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinLabel" aria-hidden="true">
        <div class="modal-dialog">

        </div>
        <!-- Auth form Modal -->

        <div class="auth-content" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <span class="close-btns float-end" style="cursor:pointer" data-bs-dismiss="modal" onclick="toggleAuthModal()">&times;</span>

            <div class="auth-tabs">
                <div class="auth-tab active" onclick="switchForm('login')">Sign In</div>
                <div class="auth-tab" onclick="switchForm('register')">Sign Up</div>
            </div>

            <!-- Login Form -->
            <form class="auth-form active" id="loginForm" method="POST">
                <div class="flex-column">
                    <label>Email </label>
                </div>
                <div class="inputForm">
                    <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
                        <g id="Layer_3" data-name="Layer 3">
                            <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input type="text" class="input" placeholder="Enter your Email" name="email" required>
                </div>

                <div class="flex-column">
                    <label>Password </label>
                </div>
                <div class="inputForm">
                    <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg>
                    <input type="password" class="input" placeholder="Enter your Password" name="password" required>
                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path>
                    </svg>
                </div>

                <div class="flex-row">
                    <!-- <div>
                        <input type="checkbox">
                        <label>Remember me </label>
                    </div> -->
                    <span class="span">Forgot password?</span>
                </div>
                <input type="submit" class="button-submit" name="signin" value="Sign In"></input>
                <p class="p">Don't have an account? <span class="span" onclick="switchForm('register')">Sign Up</span>

                </p>
                <p class="p line">Or With</p>


            </form>

            <!-- Registration Form -->
            <form class="auth-form" id="registerForm" method="POST">
                <div class="flex-column">
                    <label>Full Name</label>
                </div>
                <div class="inputForm">
                    <input type="text" class="input" placeholder="Enter your Name" name="name">
                </div>

                <div class="flex-column">
                    <label>Email</label>
                </div>
                <div class="inputForm">
                    <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
                        <g id="Layer_3" data-name="Layer 3">
                            <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input type="text" class="input" placeholder="Enter your Email" name="email">
                </div>

                <div class="flex-column">
                    <label>Password</label>
                </div>
                <div class="inputForm">
                    <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg>
                    <input type="password" class="input" placeholder="Enter your Password" name="password">
                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path>
                    </svg>
                </div>

                <button class="button-submit" name="create_account">Create Account</button>
            </form>

            <div class="flex-row">
                <button class="btns google">
                    <svg version="1.1" width="20" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <path style="fill:#FBBB00;" d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
	                                                        c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
	                                                        C103.821,274.792,107.225,292.797,113.47,309.408z"></path>
                        <path style="fill:#518EF8;" d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
	                                                        c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
	                                                        c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"></path>
                        <path style="fill:#28B446;" d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
	                                                        c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
	                                                        c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"></path>
                        <path style="fill:#F14336;" d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
	                                                        c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
	                                                        C318.115,0,375.068,22.126,419.404,58.936z"></path>

                    </svg>

                    Google

                </button><button class="btns apple">
                    <svg version="1.1" height="20" width="20" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 22.773 22.773" style="enable-background:new 0 0 22.773 22.773;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M15.769,0c0.053,0,0.106,0,0.162,0c0.13,1.606-0.483,2.806-1.228,3.675c-0.731,0.863-1.732,1.7-3.351,1.573 c-0.108-1.583,0.506-2.694,1.25-3.561C13.292,0.879,14.557,0.16,15.769,0z"></path>
                                <path d="M20.67,16.716c0,0.016,0,0.03,0,0.045c-0.455,1.378-1.104,2.559-1.896,3.655c-0.723,0.995-1.609,2.334-3.191,2.334 c-1.367,0-2.275-0.879-3.676-0.903c-1.482-0.024-2.297,0.735-3.652,0.926c-0.155,0-0.31,0-0.462,0 c-0.995-0.144-1.798-0.932-2.383-1.642c-1.725-2.098-3.058-4.808-3.306-8.276c0-0.34,0-0.679,0-1.019 c0.105-2.482,1.311-4.5,2.914-5.478c0.846-0.52,2.009-0.963,3.304-0.765c0.555,0.086,1.122,0.276,1.619,0.464 c0.471,0.181,1.06,0.502,1.618,0.485c0.378-0.011,0.754-0.208,1.135-0.347c1.116-0.403,2.21-0.865,3.652-0.648 c1.733,0.262,2.963,1.032,3.723,2.22c-1.466,0.933-2.625,2.339-2.427,4.74C17.818,14.688,19.086,15.964,20.67,16.716z"></path>
                            </g>
                        </g>
                    </svg>

                    Apple

                </button>
            </div>
        </div>
        <!-- Auth form Modal end -->



        <script>
            function toggleAuthModal() {
                const modal = document.getElementById('authModal');
                modal.classList.toggle('show');
            }

            function switchForm(formType) {
                // Switch tabs
                document.querySelectorAll('.auth-tab').forEach(tab => {
                    tab.classList.remove('active');
                });
                document.querySelectorAll('.auth-form').forEach(form => {
                    form.classList.remove('active');
                });

                // Show selected form
                if (formType === 'login') {
                    document.querySelectorAll('.auth-tab')[0].classList.add('active');
                    document.getElementById('loginForm').classList.add('active');
                } else {
                    document.querySelectorAll('.auth-tab')[1].classList.add('active');
                    document.getElementById('registerForm').classList.add('active');
                }
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('authModal');
                if (event.target === modal) {
                    modal.classList.remove('show');
                }
            }
        </script>


        <!-- user sign in script -->
        <script>
            const userIcon = document.getElementById('userIcon');
            const userCard = document.getElementById('userCard');

            userIcon.addEventListener('click', () => {
                userCard.style.display = userCard.style.display === 'block' ? 'none' : 'block';
            });

            // Optional: Hide if clicked outside
            document.addEventListener('click', (e) => {
                if (!userIcon.contains(e.target) && !userCard.contains(e.target)) {
                    userCard.style.display = 'none';
                }
            });
        </script>

        <style>
            /* From Uiverse.io by micaelgomestavares */
            .form {
                display: flex;
                flex-direction: column;
                gap: 10px;
                background-color: #ffffff;
                padding: 30px;
                width: 450px;
                border-radius: 20px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            ::placeholder {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            .form button {
                align-self: flex-end;
            }

            .flex-column>label {
                color: #151717;
                font-weight: 600;
            }

            .inputForm {
                border: 1.5px solid #ecedec;
                border-radius: 10px;
                height: 50px;
                display: flex;
                align-items: center;
                padding-left: 10px;
                margin: 10px 0px;
                transition: 0.2s ease-in-out;
            }

            .input {
                margin-left: 10px;
                border-radius: 10px;
                border: none;
                width: 85%;
                height: 100%;
            }

            .input:focus {
                outline: none;
            }

            .inputForm:focus-within {
                border: 1.5px solid #2d79f3;
            }

            .flex-row {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 10px;
                justify-content: space-between;
            }

            .flex-row>div>label {
                font-size: 14px;
                color: black;
                font-weight: 400;
            }

            .span {
                font-size: 14px;
                margin-left: 5px;
                color: #2d79f3;
                font-weight: 500;
                cursor: pointer;
            }

            .button-submit {
                margin: 20px 0 10px 0;
                background-color: #151717;
                border: none;
                color: white;
                font-size: 15px;
                font-weight: 500;
                border-radius: 10px;
                height: 50px;
                width: 100%;
                cursor: pointer;
            }

            .button-submit:hover {
                background-color: #252727;
            }

            .p {
                text-align: center;
                color: black;
                font-size: 14px;
                margin: 5px 0;
            }

            .btns {
                margin-top: 10px;
                width: 100%;
                height: 50px;
                border-radius: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: 500;
                gap: 10px;
                border: 1px solid #ededef;
                background-color: white;
                cursor: pointer;
                transition: 0.2s ease-in-out;
            }

            .btns:hover {
                border: 1px solid #2d79f3;
                ;
            }


            .auth-content {
                background: white;
                padding: 30px;
                border-radius: 10px;
                width: 400px;
                position: relative;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .close-btn {
                position: absolute;
                top: 15px;
                right: 15px;
                font-size: 24px;
                cursor: pointer;
                color: #666;
            }

            .auth-tabs {
                display: flex;
                margin-bottom: 25px;
                border-bottom: 2px solid #eee;
            }

            .auth-tab {
                padding: 12px 25px;
                cursor: pointer;
                font-weight: 500;
                color: #666;
                transition: all 0.3s;
            }

            .auth-tab.active {
                color: #2c3e50;
                border-bottom: 3px solid #3498db;
            }

            .auth-form {
                display: none;
            }

            .auth-form.active {
                display: block;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: #333;
                font-size: 14px;
            }

            .form-group input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 14px;
                transition: border-color 0.3s;
            }

            .form-group input:focus {
                outline: none;
                border-color: #3498db;
            }

            .auth-btn {
                width: 100%;
                padding: 12px;
                background: #3498db;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background 0.3s;
            }

            .auth-btn:hover {
                background: #2980b9;
            }

            .social-auth {
                margin-top: 25px;
                text-align: center;
                display: flex;
            }

            .social-btn {
                padding: 10px 20px;
                margin: 0 5px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
            }

            .google-btn {
                background: #db4437;
                color: white;
            }

            .facebook-btn {
                background: #3b5998;
                color: white;
            }

            .forgot-password {
                text-align: center;
                margin-top: 15px;
            }

            .forgot-password a {
                color: #3498db;
                text-decoration: none;
                font-size: 14px;
            }
        </style>


    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($_SESSION['show_signin_modal'])):
        unset($_SESSION['show_signin_modal']); ?>
        <script>
            $(window).on('load', function() {
                var myModal = new bootstrap.Modal(document.getElementById('signinModal'));
                myModal.show();
            });
        </script>
    <?php endif; ?>


    <!-- form for signin first end -->



    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white"><?php echo $qryresfatch['address'] ?></a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white"><?php echo $qryresfatch['email'] ?></a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6"> <?php echo $qryresfatch['storename'] ?> </h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <a href="shop-detail.php" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="cart.php" class="dropdown-item">Cart</a>
                                <a href="chackout.php" class="dropdown-item active">Chackout</a>
                                <!-- <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                                    <a href="404.php" class="dropdown-item">404 Page</a> -->
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <?php
                            $count = 0;
                            if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                            } ?>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $count; ?>
                            </span>
                        </a>


                        <?php
                        if (isset($_SESSION['user_id'])) {

                            // echo "Welcome" . $_SESSION['user_id'];
                            $userdata = "SELECT * FROM users_data WHERE usr_id = '$_SESSION[user_id]'";
                            $udataqry = mysqli_query($conn, $userdata);
                            $udata1 = mysqli_fetch_assoc($udataqry);

                        ?>
                            <!-- User Icon -->
                            <div class='position-relative d-inline-block'>
                                <i class='bi bi-person-circle fa-2x' id='userIcon' style='color:#81c408; cursor: pointer;'></i>

                                <!-- User Card -->
                                <div id='userCard' class='card position-absolute end-0' style='margin-top:-8px; width: 15rem; display: none; z-index: 1000; background: #81c408; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);'>
                                    <div class='card-body text-center'>
                                        <img src='img\avatar.jpg' class='rounded-circle mb-2' width='80' height='80' alt='User'>
                                        <h5 class='card-title mb-3' style="color: white;"><?php echo $udata1['name']; ?></h5>
                                        </h5>
                                        <small class='text-muted' style="padding: 8px; background-color: white; border: 2px solid orange; border-radius: 20px;"> <?php echo $udata1['email']; ?> </small>
                                        <hr>
                                        <a href='logout.php' style="padding: 5px 8px; background-color: white; border: 2px solid orange; border-radius: 30px; color: orange;" class="btn">Logout</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            echo "<a class='my-auto c' id='user_icon' onclick='toggleAuthModal()'>
                                    <i class='fas fa-user fa-2x'></i>
                                  </a>";
                        }
                        ?>


                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="#" method="POST">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name</label>
                                    <input type="text" class="form-control" name="lastname">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-item">
                            <label class="form-label my-3">Company Name<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div> -->

                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="number" class="form-control" name="mobileno" required>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" name="city" required>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name" name="address" required>
                        </div>

                        <!-- <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div> -->
                        <!-- <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" name="email">
                        </div> -->
                        <!-- <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                            <label class="form-check-label" for="Account-1">Create an account?</label>
                        </div>
                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                            <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                        </div> -->
                        <div class="form-item my-4">
                            <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    <?php
                                    // Inside POST handling
                                    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;


                                    if (isset($_GET['id'])) {
                                        // Fetch the product with the specific ID
                                        $sqlry = "SELECT * FROM product WHERE id = '$id'";
                                        $relt = mysqli_query($conn, $sqlry);
                                        $rw = mysqli_fetch_assoc($relt);

                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="img/<?php echo $rw['product_img']; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?php echo $rw['product_name']; ?></td>
                                            <td class="py-5"><?php echo $prices = $rw['price']; ?></td>
                                            <td class="py-5"><?php echo intval($rw['quantity'] ?? $value['quantity']); ?></td>
                                            <td class="py-5">Rs<?php echo $totl = $prices * $qtys; ?></td>
                                        </tr>
                                        <?php } else {
                                        if (isset($_SESSION['cart'])) {
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                $sn = $key + 1;
                                        ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="d-flex align-items-center mt-2">
                                                            <img src="img/<?php echo $value['productimg']; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                        </div>
                                                    </th>
                                                    <td class="py-5"><?php echo $value['productname']; ?></td>
                                                    <td class="py-5"><?php echo $prices = $value['price']; ?></td>
                                                    <td class="py-5"><?php echo $qtys = $value['quantity'] ?></td>
                                                    <td class="py-5">Rs<?php echo $totl = $prices * $qtys; ?></td>
                                                </tr>
                                    <?php }
                                        }
                                    }
                                    ?>





                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-3">Subtotal</p>
                                        </td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">Rs<?php $totlsum = 0;
                                                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                                                $totlsum = $totlsum + $value['price'] * $value['quantity'];
                                                                            }
                                                                            echo $totlsum; ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-4">Shipping</p>
                                        </td>
                                        <td colspan="3" class="py-5">
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-1" name="Shipping-1" value="Shipping">
                                                <label class="form-check-label" for="Shipping-1">Free Shipping</label>
                                            </div>
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-2" name="Shipping-1" value="Shipping">
                                                <label class="form-check-label" for="Shipping-2">Flat rate: $15.00</label>
                                            </div>
                                            <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping">
                                                <label class="form-check-label" for="Shipping-3">Local Pickup: $8.00</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">Rs<?php $totlsum = 0;
                                                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                                                $totlsum = $totlsum + $value['price'] * $value['quantity'];
                                                                            }
                                                                            echo $totlsum; ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody> -->


                                <tbody>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        // Single product view
                                        $id   = intval($_GET['id']);
                                        $res  = mysqli_query($conn, "SELECT * FROM product WHERE id = $id LIMIT 1");
                                        $rw   = mysqli_fetch_assoc($res);

                                        if ($rw) {
                                            $prices = floatval($rw['price']);
                                            $qtys   = intval($rw['quantity'] ?? 1);  // default to 1 if null
                                            $totl   = $prices * $qtys;
                                    ?>
                                            <tr>
                                                <th scope="row">
                                                    <img src="img/<?php echo htmlspecialchars($rw['product_img']); ?>"
                                                        class="img-fluid rounded-circle" style="width:90px; height:90px" alt="">
                                                </th>
                                                <td class="py-5"><?php echo htmlspecialchars($rw['product_name']); ?></td>
                                                <td class="py-5">Rs<?php echo number_format($prices, 2); ?></td>
                                                <td class="py-5"><?php echo $qtys; ?></td>
                                                <td class="py-5">Rs<?php echo number_format($totl, 2); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        // Cart view
                                        if (!empty($_SESSION['cart'])) {
                                            foreach ($_SESSION['cart'] as $value) {
                                                $prices = floatval($value['price']);
                                                $qtys   = intval($value['quantity']);
                                                $totl   = $prices * $qtys;
                                            ?>
                                                <tr>
                                                    <th scope="row">
                                                        <img src="img/<?php echo htmlspecialchars($value['productimg']); ?>"
                                                            class="img-fluid rounded-circle" style="width:90px; height:90px" alt="">
                                                    </th>
                                                    <td class="py-5"><?php echo htmlspecialchars($value['productname']); ?></td>
                                                    <td class="py-5">Rs<?php echo number_format($prices, 2); ?></td>
                                                    <td class="py-5"><?php echo $qtys; ?></td>
                                                    <td class="py-5">Rs<?php echo number_format($totl, 2); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                    }

                                    // Subtotal row (only in cart view)
                                    if (!isset($_GET['id']) && !empty($_SESSION['cart'])):
                                        $totlsum = 0;
                                        foreach ($_SESSION['cart'] as $value) {
                                            $totlsum += floatval($value['price']) * intval($value['quantity']);
                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="py-5"><strong>Subtotal</strong></td>
                                            <td class="py-5">Rs<?php echo number_format($totlsum, 2); ?></td>
                                        </tr>
                                        <!-- Add Shipping and Total rows as needed -->
                                    <?php endif; ?>


                                </tbody>




                            </table>
                        </div>
                        <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                    <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                </div>
                                <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                    <label class="form-check-label" for="Payments-1">Check Payments</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                    <label class="form-check-label" for="Paypal-1">Paypal</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" name="placeorder">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0"><?php echo $qryresfatch['storename'] ?></h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: <?php echo $qryresfatch['address'] ?></p>
                        <p>Email: <?php echo $qryresfatch['email'] ?></p>
                        <p>Phone: <?php echo $qryresfatch['contactno'] ?></p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- User sign in script end -->

    <script>
        $(document).ready(function() {
            $('#myInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#myTable tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>



</body>

</html>