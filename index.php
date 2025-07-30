<?php
include('admin/conn.php');
session_start();


// -------------for product selection-------------
$sqlry = "SELECT * From product";
$relt = mysqli_query($conn, $sqlry);
// --------------------------


// ---------- selection form store
$query = "SELECT * FROM store ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);



// -------------query for form insertion data into database------------------

// if ($_SERVER["REQUEST_METHOD"] == "POST")
// if (isset($_POST['create_account']))
// $showalert = false;
// $showerror = false;
// --------------------------------
// if (isset($_POST['create_account'])) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//     $password = $_POST['password'];
//     $formqry = "INSERT INTO users_data(name,email,password) value ('$name','$email','$password')";

//     $loginqry = mysqli_query($conn, $formqry);
//     if ($loginqry) {
//         echo "<script>alert('account is created sucessfuly')</script>";

//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         // $pass = password_verify($password,$row['password']);
//         // 2) Fetch the user by email
//         $sql  = "SELECT * from users_data WHERE email = '$email' && password = '$password'";
//         $res  = mysqli_query($conn, $sql);

//         // $total_rows = mysqli_num_rows($res);
//         if ($res) {
//             $_SESSION['user_id'] = $email;
//             header('location:index.php');
//             exit;
//         }
//     } else {
//         echo "<script>alert('account is not created')</script>";
//     };
// }
// if (isset($_POST['create_account'])) {
//              $name = $_POST['name'];
//     $email = $_POST['email'];
//     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//     $formqry = "INSERT INTO users_data(name,email,password) value ('$name','$email','$password')";

//     $loginqry = mysqli_query($conn, $formqry);

//     if ($loginqry) {
//         echo "<script>alert('account is created sucessfuly')</script>";
//     } else {
//         echo "<script>alert('account is not created')</script>";
//     };
// };
// -------------------------------

// -------------for product selection-------------
// ------------------------------
if (isset($_POST['create_account'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 🔒 hashed password

    $qry = "INSERT INTO users_data (name, email, password) VALUES ('$name', '$email', '$password')";
    $run = mysqli_query($conn, $qry);

    if ($run) {
        echo "<script>alert('✅ Account created');</script>";
    } else {
        echo "<script>alert('❌ Failed to create account');</script>";
    }
}


// ------------------------------------------
// if (isset($_POST['signin'])) {
//     // 1) Grab & escape inputs
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     // $pass = password_verify($password,$row['password']);
//     // 2) Fetch the user by email
//     $sql  = "SELECT * from users_data WHERE email = '$email' && password = '$password'";
//     $res  = mysqli_query($conn, $sql);

//     // $total_rows = mysqli_num_rows($res);
//     if ($res) {
//         $_SESSION['user_id'] = $email;
//         header('location:index.php');
//         exit;
//     } else {
//         echo '<script>alert("Invalid email or password try again")</script>';
//     }


//     // if ($total_rows == 1) {
//     //     while ($fetchdata = mysqli_fetch_assoc($res))
//     //         if (password_verify($password, $row['password'])) {
//     //             session_start();
//     //             $_SESSION['user_id'] = $email;
//     //             header('location:shop.php');
//     //             exit;
//     //         }
//     // } else {
//     //     echo "Invalid email or password";
//     // }

//     // $pass  = password_verify($password, $row['password']);
//     // 3) If we found exactly one, check password
//     // if ($res && mysqli_num_rows($res) === 1) {
//     //     $row = mysqli_fetch_assoc($res);
//     //     session_start();
//     //     if (password_verify($pass, $row['password'])) {
//     //         // 4) Success: set session and redirect
//     //         $_SESSION['user_id'] = $row['id'];
//     //         header('Location: index.php');
//     //         exit;
//     //     }
//     // }

//     // 5) Failure
//     // echo 'Invalid email or password.';
// }



// -------real work------
// if (isset($_POST['signin'])) {
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $password = $_POST['password'];

//     $sql = "SELECT usr_id, password FROM users_data WHERE email = '$email'";
//     $res = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($res) === 1) {
//         $user = mysqli_fetch_assoc($res);
//         if (password_verify($password, $user['password'])) {
//             $_SESSION['user_id'] = $user['usr_id'];
//             header("Location: index.php");
//             exit;
//         } else {
//             echo "<script>alert('❌ Wrong password');</script>";
//         }
//     } else {
//         echo "<script>alert('❌ Email not found');</script>";
//     }
//  }


if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT usr_id, password FROM users_data WHERE email = '$email'");
    if (mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['usr_id'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('❌ Wrong password');</script>";
        }
    } else {
        echo "<script>alert('❌ Email not found');</script>";
    }
}
// --------------------------



// -----------add to cart qry---------------
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Add to cart
//     if (isset($_POST['adtcart'])) {
//         // $productid = intval($_POST['product_id']); // ✅ This line is missing!
//         $productid = intval($_POST['product_id']);
//         $productname = htmlspecialchars($_POST['productname']);
//         $price = floatval($_POST['price']);
//         $productimg = htmlspecialchars($_POST['productimg']);

//         if (isset($_SESSION['cart'])) {
//             $myitems = array_column($_SESSION['cart'], 'productname');

//             if (in_array($productname, $myitems)) {
//                 echo "<script>
//                         alert('Product Already Added to Cart');
//                         window.location.href='shop.php';
//                     </script>";
//             } else {
//                 $_SESSION['cart'][] = array(
//                     'product_id' => $productid,
//                     'productname' => $productname,
//                     'price' => $price,
//                     'productimg' => $productimg,
//                     'quantity' => 1
//                 );
//                 echo "<script>
// document.querySelector('button[name='adtcart']').addEventListener('click', function(e) {
//   e.preventDefault(); // prevent form submission for demo; remove if needed

//   const badge = document.getElementById('cartBadge');
//   let count = parseInt(badge.textContent) || 0;
//   count++;
//   badge.textContent = count;
//   badge.style.display = 'inline-block';

//   // Optionally continue form submission after badge update:
//   // this.closest('form').submit();
// });
// </script>
// ";
//             }
//         } else {
//             $_SESSION['cart'][0] = array(
//                 'product_id' => $productid,
//                 'productname' => $productname,
//                 'price' => $price,
//                 'productimg' => $productimg,
//                 'quantity' => 1
//             );
//             echo "<script>
//                     alert('Product Added to Cart');
//                     window.location.href='shop.php';
//                 </script>";
//         }
//     }
// }
// --------------------------
?>

<!-- -----add to cart work this q uery------- -->
<?php
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['adtcart'])) {
//     $productid   = intval($_POST['product_id']);
//     $productname = $_POST['productname'];
//     $price       = floatval($_POST['price']);
//     $productimg  = $_POST['productimg'];

//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }

//     $names = array_column($_SESSION['cart'], 'productname');

//     if (in_array($productname, $names)) {
//         // Product already in cart – show badge but don’t double-add
//     } else {
//         $_SESSION['cart'][] = [
//             'product_id'   => $productid,
//             'productname'  => $productname,
//             'price'        => $price,
//             'productimg'   => $productimg,
//             'quantity'     => 1
//         ];

//         // Only add badge if it's newly added
//         echo '<script>
//           var badge = document.getElementById("cartBadge");
//           var count = parseInt(badge.textContent) || 0;
//           badge.textContent = count + 1;
//           badge.style.display = "inline-block";
//         </script>';
//     }
// }
?>
<!-- --------------end -->


<?php

$showAlert = false;
$isNew = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adtcart'])) {
    $productname = $_POST['productname'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $names = array_column($_SESSION['cart'], 'productname');
    $isNew = !in_array($productname, $names);

    if ($isNew) {
        // Add to cart
        $_SESSION['cart'][] = [
            'product_id' => intval($_POST['product_id']),
            'productname' => $productname,
            'price' => floatval($_POST['price']),
            'productimg' => $_POST['productimg'],
            'quantity' => 1
        ];
    }

    $showAlert = true; // Always show alert and badge
}
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


    <!-- bootsrap files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- form styles -->
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
    </style>

    <style>
        .auth-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
        }

        .auth-modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
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

    <!-- form js code -->
    <!-- <script>
        function toggleAuthModal() {
            const modal = document.getElementById("authModal");
            if (modal) {
                modal.classList.toggle("show");
            }
        }

        function switchForm(formType) {
            document.querySelectorAll(".auth-tab").forEach((tab) => {
                tab.classList.remove("active");
            });
            document.querySelectorAll(".auth-form").forEach((form) => {
                form.classList.remove("active");
            });

            if (formType === "login") {
                document.querySelectorAll(".auth-tab")[0].classList.add("active");
                document.getElementById("loginForm").classList.add("active");
            } else {
                document.querySelectorAll(".auth-tab")[1].classList.add("active");
                document.getElementById("registerForm").classList.add("active");
            }
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById("authModal");
            if (event.target === modal) {
                modal.classList.remove("show");
            }
        };
    </script> -->

    <style>
        /* From Uiverse.io by Na3ar-17 */

        #user_icon:hover .card {
            display: block;
        }


        .card {
            width: 200px;
            /* background-color: rgba(36, 40, 50, 1);
        background-image: linear-gradient(135deg, rgba(36, 40, 50, 1) 0%, rgba(36, 40, 50, 1) 40%, rgba(37, 28, 40, 1) 100%); */

            background-color: rgba(36, 40, 50, 1);
            background-image: linear-gradient(139deg,
                    rgba(36, 40, 50, 1) 0%,
                    rgba(36, 40, 50, 1) 0%,
                    rgba(37, 28, 40, 1) 100%);

            border-radius: 10px;
            padding: 15px 0px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 9999;
            display: none;
            top: 75px;
            right: -50px;
            position: absolute;
            transition: 1s;
        }

        .card .separator {
            border-top: 1.5px solid #42434a;
        }

        .card .list {
            list-style-type: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 0px 10px;
        }

        .card .list .element {
            display: flex;
            align-items: center;
            color: #7e8590;
            gap: 10px;
            transition: all 0.3s ease-out;
            padding: 4px 7px;
            border-radius: 6px;
            cursor: pointer;
        }

        .card .list .element svg {
            width: 19px;
            height: 19px;
            transition: all 0.3s ease-out;
        }

        .card .list .element .label {
            font-weight: 600;
        }

        .card .list .element:hover {
            background-color: #5353ff;
            color: #ffffff;
            transform: translate(1px, -1px);
        }

        .card .list .delete:hover {
            background-color: #8e2a2a;
        }

        .card .list .element:active {
            transform: scale(0.99);
        }

        .card .list:not(:last-child) .element:hover svg {
            stroke: #ffffff;
        }

        .card .list:last-child svg {
            stroke: #bd89ff;
        }

        .card .list:last-child .element {
            color: #bd89ff;
        }

        .card .list:last-child .element:hover {
            background-color: rgba(56, 45, 71, 0.836);
        }
    </style>


</head>

<body>

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
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white"><?php echo $row['address']; ?></a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white"><?php echo $row['email']; ?></a></small>
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
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-primary display-6"><?php echo $row['storename']; ?></h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <a href="shop-detail.php" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="cart.php" class="dropdown-item">Cart</a>
                                <a href="chackout.php" class="dropdown-item">Chackout</a>
                                <!-- <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                                <a href="404.php" class="dropdown-item">404 Page</a> -->
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="cart.php" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <!-- <?php
                                    $count = 0;
                                    if (isset($_SESSION['cart'])) {
                                        $count = count($_SESSION['cart']);
                                    } ?> -->
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $count; ?></span>
                        </a>


                        <!-- User Icon Start -->

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



                        <!-- <a class="my-auto c" id="user_icon" onclick="toggleAuthModal()">
                            <i class="fas fa-user fa-2x"></i>
                        </a> -->

                        <!-- ---------------- -->
                        <!-- User Icon -->
                        <!-- <div class="position-relative d-inline-block">
                            <i class="bi bi-person-circle fs-3" id="userIcon" style="cursor: pointer;"></i>

                             User Card -->
                        <!-- <div id="userCard" class="card position-absolute end-0 mt-2" style="width: 18rem; display: none; z-index: 1000;">
                                <div class="card-body text-center">
                                    <img src="your-image.jpg" class="rounded-circle mb-2" width="80" height="80" alt="User">
                                    <h5 class="card-title mb-0">Shah Nawaz</h5>
                                    <small class="text-muted">shah.nawaz@gmail.com</small>
                                    <hr>
                                    <a href="logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
                                </div>
                            </div> -->
                        <!-- </div> -->





                        <!-- ------------- -->
                        <!-- User Icon End -->

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="shop.php" method="POST">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" value="<?php if (isset($_POST['search_term'])) echo htmlspecialchars($_POST['search_term']); ?>" name="search_term">
                            <button type="submit" id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal Search End -->

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                    <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                    <!-- <form action="shop.php" method="POST">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" name="search_term" type="text" placeholder="Search">
                            <button type="submit" name="search_term" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                        </div>
                    </form> -->
                    <form action="shop.php" method="POST">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" name="search_term" type="text" placeholder="Search" value="<?php if (isset($_POST['search_term'])) echo htmlspecialchars($_POST['search_term']); ?>">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <!-- <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a> -->
                            </div>
                            <div class="carousel-item rounded">
                                <img src="img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                <!-- <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a> -->
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Free Shipping</h5>
                            <p class="mb-0">Free on order over Rs100</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Security Payment</h5>
                            <p class="mb-0">100% security payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>1 Day Return</h5>
                            <p class="mb-0">1 day money guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-5 text-start">
                        <h1>Our Organic Products</h1>
                    </div>
                    <div class="col-lg-7 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Vegetables</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Fruits</span>
                                </a>
                            </li> -->

                            <?php

                            $i = 2;

                            // -------------for product selection-------------
                            $selectcate = "SELECT DISTINCT category FROM product";
                            $caterelt = mysqli_query($conn, $selectcate);

                            mysqli_data_seek($caterelt, 0); // Reset result pointer
                            while ($cat = mysqli_fetch_assoc($caterelt)) {
                                $catName = $cat['category'];
                                $activeClass = ($i === 2) ? "" : "";
                            ?>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill <?= $activeClass ?>" data-bs-toggle="pill" href="#tab-<?= $i ?>">
                                        <span class="text-dark" style="width: 130px;"><?= $catName ?></span>
                                    </a>
                                </li>
                            <?php
                                $i++;
                            }
                            // --------------------------
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    while ($rw = mysqli_fetch_assoc($relt)) {
                                    ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <form method="POST">
                                                <div class="rounded position-relative fruite-item">

                                                    <a href="shop-detail.php?id=<?php echo $rw['id']; ?>">
                                                        <div class="fruite-img">
                                                            <img style="height: 200px;" src="img/<?php echo $rw['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $rw['product_name']; ?>">
                                                        </div>
                                                    </a>

                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $rw['category'];  ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $rw['product_name']; ?></h4>
                                                        <p><?php echo $rw['discription'] ?></p>

                                                        <input type="hidden" name="product_id" value="<?php echo $rw['id']; ?>">
                                                        <input type="hidden" name="productname" value="<?php echo $rw['product_name']; ?>">
                                                        <input type="hidden" name="price" value="<?php echo $rw['price']; ?>">
                                                        <input type="hidden" name="productimg" value="<?php echo $rw['product_img']; ?>">

                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs <?php echo $rw['price']; ?>/kg</p>
                                                            <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                            </button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    $sql2 = "SELECT * FROM product where category='Vegetable'";
                                    $showdta = mysqli_query($conn, $sql2);
                                    while ($vege = mysqli_fetch_assoc($showdta)) {
                                    ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <form action="manage-cart.php" method="POST">
                                                <div class="rounded position-relative fruite-item">

                                                    <a href="shop-detail.php?id=<?php echo $vege['id']; ?>">
                                                        <div class="fruite-img">
                                                            <img style="height: 200px;" src="img/<?php echo $vege['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $vege['product_name']; ?>">
                                                        </div>
                                                    </a>

                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $vege['category'];  ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $vege['product_name']; ?></h4>
                                                        <p><?php echo $vege['discription'] ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs <?php echo $vege['price']; ?>/kg</p>

                                                            <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                            <input type="hidden" name="productname" value="<?php echo $vege['product_name']; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $vege['price']; ?>">
                                                            <input type="hidden" name="productimg" value="<?php echo $vege['product_img']; ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    <?php
                                    $sql2 = "SELECT * FROM product where category='Fruits'";
                                    $showdta = mysqli_query($conn, $sql2);
                                    while ($vege = mysqli_fetch_assoc($showdta)) {
                                    ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <form action="manage-cart.php" method="POST">
                                                <div class="rounded position-relative fruite-item">

                                                    <a href="shop-detail.php?id=<?php echo $vege['id']; ?>">
                                                        <div class="fruite-img">
                                                            <img style="height: 200px;" src="img/<?php echo $vege['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $vege['product_name']; ?>">
                                                        </div>
                                                    </a>

                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $vege['category'];  ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $vege['product_name']; ?></h4>
                                                        <p><?php echo $vege['discription'] ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs <?php echo $vege['price']; ?>/kg</p>

                                                            <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                            <input type="hidden" name="productname" value="<?php echo $vege['product_name']; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $vege['price']; ?>">
                                                            <input type="hidden" name="productimg" value="<?php echo $vege['product_img']; ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    <?php
                                    $sql2 = "SELECT * FROM product where category='Dried Fruit'";
                                    $showdta = mysqli_query($conn, $sql2);
                                    while ($vege = mysqli_fetch_assoc($showdta)) {
                                    ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <form action="manage-cart.php" method="POST">
                                                <div class="rounded position-relative fruite-item">

                                                    <a href="shop-detail.php?id=<?php echo $vege['id']; ?>">
                                                        <div class="fruite-img">
                                                            <img style="height: 200px;" src="img/<?php echo $vege['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $vege['product_name']; ?>">
                                                        </div>
                                                    </a>

                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $vege['category'];  ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $vege['product_name']; ?></h4>
                                                        <p><?php echo $vege['discription'] ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs <?php echo $vege['price']; ?>/kg</p>

                                                            <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                            <input type="hidden" name="productname" value="<?php echo $vege['product_name']; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $vege['price']; ?>">
                                                            <input type="hidden" name="productimg" value="<?php echo $vege['product_img']; ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Grapes</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Apricots</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div id="tab-5" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Banana</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Raspberries</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Oranges</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Fresh Apples</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Tasty Fruits</h5>
                                    <h3 class="mb-0">Free delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Exotic Vegitable</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Fresh Organic Vegetables</h1>

            <div class="owl-carousel vegetable-carousel justify-content-center">
                <?php
                $carosalsql = "SELECT * FROM product";
                $carosaldata = mysqli_query($conn, $carosalsql);
                while ($carosal = mysqli_fetch_assoc($carosaldata)) {
                ?>

                    <div class="border border-primary rounded position-relative vesitable-item">
                        <form action="manage-cart.php" method="POST">
                            <a href="shop-detail.php?id=<?php echo $carosal['id']; ?>">
                                <div class="fruite-img">
                                    <img style="height: 200px;" src="img/<?php echo $carosal['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $carosal['product_name']; ?>">
                                </div>
                            </a>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $carosal['category']; ?></div>
                            <div class="p-4 rounded-bottom">
                                <h4><?php echo $carosal['product_name']; ?></h4>
                                <p><?php echo $carosal['discription']; ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo $carosal['price']; ?>/ kg</p>
                                    <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $rowrelt['id']; ?>">
                                <input type="hidden" name="productname" value="<?php echo $carosal['product_name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $carosal['price']; ?>">
                                <input type="hidden" name="productimg" value="<?php echo $carosal['product_img']; ?>">
                            </div>
                        </form>
                    </div>
                    <!-- </div> -->
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                        <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p>
                        <a href="shop.php" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50<small>Rs</small></span>
                                <span class="h4 text-muted mb-0">kg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Best Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>
            <div class="row g-4">
                <?php
                $carosalsql = "SELECT * FROM product";
                $carosaldata = mysqli_query($conn, $carosalsql);
                while ($carosal = mysqli_fetch_assoc($carosaldata)) {
                ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <form action="manage-cart.php" method="POST">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img style="border-radius: 60%; height:200px;" src="img/<?php echo $carosal['product_img']; ?>" class="img-fluid" alt="<?php echo $carosal['product_name']; ?>">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5"><?php echo $carosal['product_name']; ?></a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3"><?php echo $carosal['price']; ?>Rs</h4>
                                        <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo $rowrelt['id']; ?>">
                                    <input type="hidden" name="productname" value="<?php echo $carosal['product_name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $carosal['price']; ?>">
                                    <input type="hidden" name="productimg" value="<?php echo $carosal['product_img']; ?>">
                                </div>
                            </form>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->

    <!-- Bestsaler Product-->
    <div class="container-fluid">
        <div class="container">
            <!-- <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Best Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div> -->
            <div class="row g-4">
                <?php
                $carosalsql = "SELECT * FROM product";
                $carosaldata = mysqli_query($conn, $carosalsql);
                while ($carosal = mysqli_fetch_assoc($carosaldata)) {
                ?>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <form action="manage-cart.php" method="POST">
                            <div class="text-center">
                                <img src="img/<?php echo $carosal['product_img']; ?>" class="img-fluid rounded" style=" height: 200px;" alt="<?php echo $carosal['product_name']; ?>">
                                <div class="py-4">
                                    <a href="#" class="h5"><?php echo $carosal['product_name']; ?></a>
                                    <div class="d-flex my-3 justify-content-center">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><?php echo $carosal['price']; ?> Rs</h4>
                                    <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>

                                </div>

                                <input type="hidden" name="product_id" value="<?php echo $rowrelt['id']; ?>">
                                <input type="hidden" name="productname" value="<?php echo $carosal['product_name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $carosal['price']; ?>">
                                <input type="hidden" name="productimg" value="<?php echo $carosal['product_img']; ?>">
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/fruite-item-2.jpg" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/fruite-item-3.jpg" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/fruite-item-4.jpg" class="img-fluid rounded" alt="">
                        <div class="py-2">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->



    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-shopping-basket fa-3x text-success mb-3"></i>
                            <h4>Available Products</h4>
                            <?php
                            $countqry = "SELECT COUNT(*) astotal FROM product";
                            $countrelt = mysqli_query($conn, $countqry);
                            $count =  mysqli_fetch_assoc($countrelt);
                            $counts = $count['astotal'];
                            ?>
                            <h1><?php echo $counts; ?></h1>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-truck fa-3x text-primary mb-3"></i>
                            <h4>Fast Delivery</h4>
                            <h1>99%</h1>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-lock fa-3x text-warning mb-3"></i>
                            <h4>Secure Payment</h4>
                            <h1>100%</h1>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users fa-3x text-danger mb-3"></i>
                            <h4>Happy Clients</h4>
                            <h1>1.2K+</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial Start -->
    <!-- <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <?php
                $data = file_exists('testimonials.json') ? json_decode(file_get_contents('testimonials.json'), true) : [];

                foreach ($data as $t) {
                    echo '<div class="testimonial-item img-border-radius bg-light rounded p-4">';
                    echo '  <div class="position-relative">';
                    echo '      <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>';
                    echo '      <div class="mb-4 pb-4 border-bottom border-secondary">';
                    echo '          <p class="mb-0">' . htmlspecialchars($t['review']) . '</p>';
                    echo '      </div>';
                    echo '      <div class="d-flex align-items-center flex-nowrap">';
                    echo '          <div class="bg-secondary rounded">';
                    echo '              <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">';
                    echo '          </div>';
                    echo '          <div class="ms-4 d-block">';
                    echo '              <h4 class="text-dark">' . htmlspecialchars($t['name']) . '</h4>';
                    echo '              <p class="m-0 pb-3">Client</p>';
                    echo '              <div class="d-flex pe-5">';

                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= (int)$t['stars']) {
                            echo '<i class="fas fa-star text-primary"></i>';
                        } else {
                            echo '<i class="fas fa-star text-secondary"></i>';
                        }
                    }

                    echo '              </div>';
                    echo '          </div>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div> -->
    <!-- Testimonial End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0"><?php echo $row['storename']; ?></h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <!-- <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div> -->
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div> -->
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
                        <a class="btn-link" href="contact.php">Contact Us</a>
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
                        <a class="btn-link" href="cart.php">Shopping Cart</a>
                        <span class="btn-link">Wishlist</span>
                        <span class="btn-link">Order History</span>
                        <span class="btn-link">International Orders</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: <?php echo $row['address']; ?></p>
                        <p>Email: <?php echo $row['email']; ?></p>
                        <p>Phone: <?php echo $row['contactno']; ?></p>
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
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i><?php echo $row['storename']; ?></a>, All right reserved.</span>
                </div>
                <!-- <div class="col-md-6 my-auto text-center text-md-end text-white"> -->
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!-- /*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/ -->
                <!-- /*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/ -->
                <!-- Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a> -->
            </div>
        </div>
    </div>
    </div>
    <!-- Copyright End -->


    <!-- Auth form Modal -->
    <div class="auth-modal" id="authModal">

        <div class="auth-content">
            <span class="close-btns float-end" style="cursor:pointer" onclick="toggleAuthModal()">&times;</span>

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
    </div>
    <!-- Auth form Modal end -->

    <!-- ----badge for add to cart -->
    <!-- Toast container (place once globally) -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
        <div id="cartToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Cart</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Product added to cart!
            </div>
        </div>
    </div>


    <!-- <?php if ($updated_status): ?>
                <div class="alert alert-warning w-25 fade show" role="alert"
                    id="statusAlert"
                    style="z-index: 1000; position: fixed; top: 10%; right: 5%; padding:20px;">
                    ✅ Order marked as <strong>Shipped</strong>.
                </div>

                <script>
                    // Hide after 3 seconds
                    setTimeout(function() {
                        const alert = document.getElementById("statusAlert");
                        if (alert) {
                            alert.classList.remove("show");
                            alert.classList.add("fade");
                            alert.style.display = "none";
                        }
                    }, 3000);
                </script>
            <?php endif; ?> -->





    <!-- <?php if ($wasAdded): ?>
      <div class="alert alert-success alert-dismissible fade show position-fixed"
       role="alert" style="top:20px; right:20px; z-index:1050;">
     ✅ Product added to cart!
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
      $(document).ready(function() {
        setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).alert('close');
          });
        }, 3000);
      });
    </script>
<?php endif; ?> optional-->

    <?php if ($showAlert): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed"
            role="alert" style="line-height:35px; height:70px; bottom:20px; right:100px; z-index:1050; background:#81c408; color:white; font-weight:700;">
            Product <?php echo $isNew ? 'added to cart!' : 'is already in your cart!'; ?>
            <button type="button" class="btn-close mt-1" data-bs-dismiss="alert"></button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(function() {
                // Update badge every time
                const badge = $('#cartBadge');
                const current = parseInt(badge.text()) || 0;
                badge.text(current + 1).show();

                // Auto-dismiss alert after 3 seconds
                setTimeout(() => {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).alert('close');
                    });
                }, 3000);
            });
        </script>
    <?php endif; ?>

    <!-- ----badge for add to cart end -->

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
    <!-- User sign in script end -->



    <!-- add to  cart script-->
    <!-- User sign in script end -->


</body>

</html>