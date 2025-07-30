<?php
include('admin/conn.php');
session_start();
// $id = $_GET['id'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


// -------------------
$query = "SELECT * FROM store ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
// -------------------


// -------------for product selection-------------


if (isset($_GET['id'])) {

    // Fetch the product with the specific ID
    $sqlry = "SELECT * FROM product WHERE id = '$id'";
    $relt = mysqli_query($conn, $sqlry);
    $rw = mysqli_fetch_assoc($relt);
} else {
    // If no ID is provided, show a random product
    $sqlry = "SELECT * FROM product ORDER BY RAND() LIMIT 1";
    $relt = mysqli_query($conn, $sqlry);
    $rw = mysqli_fetch_assoc($relt);
}


//  if ($id == $_GET['id']) 
//   {

//     $sqlry = "SELECT * From product where id = '$id'";
//     $relt = mysqli_query($conn, $sqlry);
//     $rw = mysqli_fetch_assoc($relt);
//     } 
//      else {
//     $sqlry = "SELECT * From product ";
//     $relt = mysqli_query($conn, $sqlry);
//     $rw = mysqli_fetch_assoc($relt);
// }

// --------------------------





// --------------------------
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Add to cart
//     if (isset($_POST['buyadtcart'])) {
//         $productid = intval($_POST['product_id']);
//         $productname = htmlspecialchars($_POST['productname']);
//         $price = floatval($_POST['price']);
//         $productimg = htmlspecialchars($_POST['productimg']);

//         if (isset($_SESSION['cart'])) {
//             $myitems = array_column($_SESSION['cart'], 'productname');

//             if (in_array($productname, $myitems)) {
//                 echo "<script>
//                         alert('Product Already Added to Cart');
//                         window.location.href='shop-detail.php';
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
//                         // alert('Product Added to Cart');
//                         window.location.href='chackout.php';
//                     </script>";
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
// } optionally



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

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyadtcart'])) {
//     $productname = $_POST['productname'];

//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }

//     $names = array_column($_SESSION['cart'], 'productname');
//     $isNew = !in_array($productname, $names);

//     if ($isNew) {
//         // Add to cart
//         $_SESSION['cart'][] = [
//             'product_id' => intval($_POST['product_id']),
//             'productname' => $productname,
//             'price' => floatval($_POST['price']),
//             'productimg' => $_POST['productimg'],
//             'quantity' => 1
//         ];
//     }

//     $showAlert = true; // Always show alert and badge
// } optionally------------------------


// --------------------------




// ------------review code--------------
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $name = htmlspecialchars($_POST['name'] ?? '');
//     $email = htmlspecialchars($_POST['email'] ?? '');
//     $review = htmlspecialchars($_POST['review'] ?? '');
//     $stars = (int)($_POST['stars'] ?? 0);

//     if ($name && $email && $review && $stars > 0) {
//         $testimonial = [
//             'name' => $name,
//             'email' => $email,
//             'review' => $review,
//             'stars' => $stars
//         ];

//         $file = 'testimonials.json';
//         $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
//         $data[] = $testimonial;
//         file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

//         echo "<script>alert('✅ Testimonial submitted successfully'); window.location.href='shop-detail.php';</script>";
//         exit;
//     } else {
//         echo "<script>alert('❌ Please fill all fields and select stars');</script>";
//     }
// }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'testimonials.json';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id'];  // NEW!

    $newTestimonial = [
        'name' => $name,
        'email' => $email,
        'review' => $review,
        'rating' => (int)$rating,
        'product_id' => $product_id,   // save this!
        'date' => date('Y-m-d')
    ];

    $data = [];
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
    }

    $data[] = $newTestimonial;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo "success";
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
    <!-- show alert badge -->
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
    <!-- show alert badge -->
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
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <a href="shop-detail.php" class="nav-item nav-link active">Shop Detail</a>
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
                            <?php
                            $count = 0;
                            if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                            } ?>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $count; ?></span>
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
                                <div id='userCard' class='card position-absolute end-0' style='margin-top: 15px; width: 15rem; display: none; z-index: 1000; background: #81c408; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);'>
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
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <form action="?" method="POST">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <img src="img/<?php echo $rw['product_img']; ?>" class="img-fluid rounded" alt="Image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?php echo $rw['product_name']; ?></h4>
                                <p class="mb-3">Category: <?php echo $rw['category'] ?></p>
                                <h5 class="fw-bold mb-3"><?php echo $rw['price']; ?> Rs</h5>
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="mb-5 w-75 "><?php echo $rw['discription'] ?></p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- 
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <button type="button" class="btn btn-sm btn-minus">–</button>
                                    <input type="text" class="form-control form-control-sm text-center qty-input" value="1" min="1">
                                    <button type="button" class="btn btn-sm btn-plus">+</button>
                                </div> -->



                                <!-- <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button> -->


                                <a href="chackout.php?id=<?php echo $rw['id']; ?>" type="submit" name="buyadtcart" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-cart me-2 text-primary"></i> Buy</a>
                                <button type="submit" name="adtcart" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            </div>
                            <!-- Add to Cart input fields to store data in session -->
                            <input type="hidden" name="product_id" value="<?php echo $rw['id']; ?>">
                            <input type="hidden" name="productimg" value="<?php echo $rw['product_img']; ?>">
                            <input type="hidden" name="productname" value="<?php echo $rw['product_name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $rw['price']; ?>">
                            <input type="hidden" name="quantity" value="1"> <!-- ← ensures default qty is 1 -->

                            <!-- ------------------------- -->
                    </form>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p><?php echo $rw['discription'] ?> </p>
                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">1 kg</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Agro Farm</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Quality</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Organic</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Сheck</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Healthy</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">250 Kg</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">


                                <?php
                                $product_id = $_GET['id']; // assuming product ID comes from URL
                                $testimonialsFile = 'testimonials.json';

                                if (file_exists($testimonialsFile)) {
                                    $testimonials = json_decode(file_get_contents($testimonialsFile), true);

                                    foreach ($testimonials as $t) {
                                        if ($t['product_id'] == $product_id) {
                                            $name = htmlspecialchars($t['name']);
                                            $review = htmlspecialchars($t['review']);
                                            $rating = (int)$t['review'];
                                            $date = date("F d, Y", strtotime($t['date'] ?? 'now'));

                                            echo '<div class="d-flex mb-4">';
                                            echo '    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="User">';
                                            echo '    <div>';
                                            echo "        <p class=\"mb-2\" style=\"font-size: 14px;\">$date</p>";
                                            echo '        <div class="d-flex justify-content-between">';
                                            echo "            <h5>$name</h5>";
                                            echo '            <div class="d-flex mb-3">';
                                            for ($i = 1; $i <= 5; $i++) {
                                                $class = $i <= $rating ? 'text-secondary' : '';
                                                echo "<i class=\"fa fa-star $class\"></i>";
                                            }
                                            echo '            </div>';
                                            echo '        </div>';
                                            echo "        <p>$review</p>";
                                            echo '    </div>';
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo "<p>No reviews for this product yet.</p>";
                                }
                                ?>





                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>




                    <form id="testimonialForm" method="POST">
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="text" name="name" class="form-control border-0 me-4" id="name" placeholder="Your Name *" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="email" name="email" class="form-control border-0" id="email" placeholder="Your Email *" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea id="review" name="review" class="form-control border-0" cols="30" rows="5" placeholder="Your Review *" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between py-3 mb-5">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Please rate:</p>
                                        <div id="starRating" class="d-flex align-items-center" style="font-size: 20px; cursor: pointer;">
                                            <i class="fa fa-star" data-value="1"></i>
                                            <i class="fa fa-star" data-value="2"></i>
                                            <i class="fa fa-star" data-value="3"></i>
                                            <i class="fa fa-star" data-value="4"></i>
                                            <i class="fa fa-star" data-value="5"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="stars" id="starsInput" value="">
                                    <input type="hidden" id="productId" value="<?php echo $product_id; ?>"> <!-- from your PHP page -->
                                    <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="input-group w-100 mx-auto d-flex mb-4">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="mb-4">
                            <h4>Categories</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                        <span>(2)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                        <span>(8)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-4">Featured products</h4>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded" style="width: 100px; height: 100px;">
                                <img src="img/featur-1.jpg" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded" style="width: 100px; height: 100px;">
                                <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded" style="width: 100px; height: 100px;">
                                <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/vegetable-item-4.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/vegetable-item-5.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/vegetable-item-6.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">Big Banana</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="fw-bold mb-5">Related products</h1>
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
                                <img src="img/<?php echo $carosal['product_img']; ?>" class="img-fluid rounded-top" alt="<?php echo $carosal['product_name']; ?>">
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
    <!-- Single Product End -->


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
    <script>
        const stars = document.querySelectorAll('#starRating i');
        const starsInput = document.getElementById('starsInput');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                starsInput.value = index + 1;

                stars.forEach((s, i) => {
                    s.style.color = i <= index ? 'orange' : 'gray';
                });
            });
        });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


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

</body>

</html>