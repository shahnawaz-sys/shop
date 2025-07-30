<?php
include('../admin/conn.php');
session_start();


// ---------- selection form store
$query = "SELECT * FROM store ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
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
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!-- bootsrap files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <!-- <script src="https://unpkg.com/lucide@latest"></script> -->


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

    </div>
    <!-- Hero End -->


    <!-- ---------------------------------------------------------------------------------------- -->
    <!-- Background circles for aesthetic -->

    <!-- Main container updated for full width and min-height -->
    <div class="bg-white rounded-3xl shadow-2xl flex flex-col lg:flex-row w-full min-h-[calc(100vh-2rem)] overflow-hidden z-10">
        <!-- Left Sidebar Navigation -->
        <nav class="w-full lg:w-64 bg-white p-8 border-r border-gray-100 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Settings</h2>
                <ul id="sidebar-nav" class="space-y-4">
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 bg-pink-100 text-pink-700" data-tab="Account">
                            Account
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="OrderHistory">
                            Order History
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="PaymentMethods">
                            Payment Methods
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="ShippingAddresses">
                            Shipping Addresses
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="Wishlist">
                            Wishlist
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="Notifications">
                            Notifications
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="Privacy">
                            Privacy
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="Languages">
                            Languages
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left py-3 px-4 rounded-xl font-semibold transition duration-200 text-gray-600 hover:bg-gray-50" data-tab="Help">
                            Help
                        </button>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 p-8 lg:p-12 bg-gray-50"> <!-- Removed overflow-y-auto -->
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-3xl font-extrabold text-gray-800">Account Settings</h1>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-pink-600 font-medium transition duration-200 flex items-center">
                        <i data-lucide="home" class="mr-1" style="width: 18px; height: 18px;"></i> Home
                    </a>
                    <a href="#" class="text-gray-600 hover:text-pink-600 font-medium transition duration-200 flex items-center">
                        <i data-lucide="compass" class="mr-1" style="width: 18px; height: 18px;"></i> Explore
                    </a>
                    <a href="#" class="text-gray-600 hover:text-pink-600 font-medium transition duration-200 flex items-center">
                        <i data-lucide="dollar-sign" class="mr-1" style="width: 18px; height: 18px;"></i> Pricing
                    </a>
                    <a href="#" class="text-gray-600 hover:text-pink-600 font-medium transition duration-200 flex items-center">
                        <i data-lucide="info" class="mr-1" style="width: 18px; height: 18px;"></i> About
                    </a>
                    <div class="relative">
                        <img
                            src="https://placehold.co/40x40/FFC0CB/FFFFFF?text=JD"
                            alt="User Avatar"
                            class="w-10 h-10 rounded-full border-2 border-pink-300 shadow-md" />
                        <!-- Online indicator -->
                        <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-white"></span>
                    </div>
                </div>
            </div>

            <!-- Content based on activeTab -->
            <div id="content-area">
                <!-- Account Tab Content -->
                <div id="Account-content" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Basic info</h3>

                        <!-- Profile Picture -->
                        <div class="flex items-center mb-6">
                            <div class="relative">
                                <img
                                    id="profile-picture"
                                    src="https://placehold.co/40x40/FFC0CB/FFFFFF?text=WA"
                                    alt="Profile"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-pink-200" />
                                <button
                                    id="upload-profile-picture"
                                    class="absolute bottom-0 right-0 bg-pink-500 text-white rounded-full p-1 border-2 border-white hover:bg-pink-600 transition duration-200"
                                    aria-label="Upload new picture">
                                    <i data-lucide="upload" style="width: 16px; height: 16px;"></i>
                                </button>
                                <button
                                    id="remove-profile-picture"
                                    class="absolute top-0 right-0 bg-gray-700 text-white rounded-full p-0.5 border-2 border-white hover:bg-gray-800 transition duration-200 hidden"
                                    aria-label="Remove picture">
                                    <i data-lucide="x" style="width: 12px; height: 12px;"></i>
                                </button>
                            </div>
                            <div class="ml-4">
                                <button id="upload-text-button" class="text-pink-600 hover:underline text-sm font-medium">
                                    Upload new picture
                                </button>
                                <p class="text-gray-500 text-xs mt-1">
                                    <button id="remove-text-button" class="hover:underline">Remove</button>
                                </p>
                            </div>
                        </div>

                        <!-- Basic Info Items -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Edit Name')">
                                <span class="text-gray-700 font-medium">Name</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-name">Wade Armstrong</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Edit Date of Birth')">
                                <span class="text-gray-700 font-medium">Date of Birth</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-dob">December 24, 1998</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Edit Gender')">
                                <span class="text-gray-700 font-medium">Gender</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-gender">Male</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Edit Email')">
                                <span class="text-gray-700 font-medium">Email</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-email">wade.armstrong@email.com</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mt-10 mb-6">Account info</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Edit Username')">
                                <span class="text-gray-700 font-medium">Username</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-username">wadearmstrong08</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 rounded-lg hover:bg-pink-50 transition duration-200 cursor-pointer" onclick="alert('Change Password')">
                                <span class="text-gray-700 font-medium">Password</span>
                                <div class="flex items-center">
                                    <span class="text-gray-500 mr-2" id="profile-password">••••••••••</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px;" class="text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Card: Guide to setup your account -->
                    <div class="lg:col-span-1 bg-pink-50 p-6 rounded-xl shadow-sm border border-pink-100 flex flex-col items-center justify-center text-center">
                        <div class="text-pink-400 mb-4">
                            <i data-lucide="help-circle" style="width: 48px; height: 48px;"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-pink-700 mb-2">Guide to setup your account</h4>
                        <p class="text-pink-600 text-sm">
                            Complete your profile for a better experience.
                        </p>
                        <button class="mt-4 px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200 text-sm font-medium">
                            Get Started
                        </button>
                    </div>
                </div>

                <!-- Order History Tab Content -->
                <div id="OrderHistory-content" class="py-6 hidden">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center lg:text-left">Your Order History</h3>
                    <p class="text-gray-600 mb-8 text-center lg:text-left">View details of your past purchases here.</p>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Dummy Order 1 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#10012345</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full object-cover mr-4" src="https://placehold.co/40x40/FFC0CB/FFFFFF?text=P1" alt="Product 1">
                                            <span class="text-sm text-gray-900">Stylish Headphones</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-10</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$120.50</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="alert('View details for order #10012345')" class="text-pink-600 hover:text-pink-900 flex items-center">
                                            View Details <i data-lucide="external-link" class="ml-1" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Dummy Order 2 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#10012346</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full object-cover mr-4" src="https://placehold.co/40x40/A78BFA/FFFFFF?text=P2" alt="Product 2">
                                            <span class="text-sm text-gray-900">Smartwatch Pro</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-12</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$75.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="alert('View details for order #10012346')" class="text-pink-600 hover:text-pink-900 flex items-center">
                                            View Details <i data-lucide="external-link" class="ml-1" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Dummy Order 3 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#10012347</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full object-cover mr-4" src="https://placehold.co/40x40/81C784/FFFFFF?text=P3" alt="Product 3">
                                            <span class="text-sm text-gray-900">Ergonomic Mouse</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$210.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Shipped
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="alert('View details for order #10012347')" class="text-pink-600 hover:text-pink-900 flex items-center">
                                            View Details <i data-lucide="external-link" class="ml-1" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Dummy Order 4 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#10012348</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full object-cover mr-4" src="https://placehold.co/40x40/FFD54F/FFFFFF?text=P4" alt="Product 4">
                                            <span class="text-sm text-gray-900">Wireless Keyboard</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-08</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$99.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="alert('View details for order #10012348')" class="text-pink-600 hover:text-pink-900 flex items-center">
                                            View Details <i data-lucide="external-link" class="ml-1" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8 p-4 bg-white rounded-xl shadow-sm border border-gray-100 text-center">
                        <p class="text-gray-700 mb-4">Looking for something specific?</p>
                        <button class="px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200 text-sm font-medium">
                            Search Orders
                        </button>
                    </div>
                </div>

                <!-- Payment Methods Tab Content -->
                <div id="PaymentMethods-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Your Payment Methods</p>
                    <p class="mt-2">Manage your saved credit cards and payment options.</p>
                    <div class="mt-8 p-4 bg-white rounded-xl shadow-sm border border-gray-100 max-w-md mx-auto">
                        <p class="text-gray-700">No payment methods saved.</p>
                        <button class="mt-4 px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200 text-sm font-medium">
                            Add New Payment Method
                        </button>
                    </div>
                </div>

                <!-- Shipping Addresses Tab Content -->
                <div id="ShippingAddresses-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Your Shipping Addresses</p>
                    <p class="mt-2">Add, edit, or remove your delivery addresses.</p>
                    <div class="mt-8 p-4 bg-white rounded-xl shadow-sm border border-gray-100 max-w-md mx-auto">
                        <p class="text-gray-700">No shipping addresses saved.</p>
                        <button class="mt-4 px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200 text-sm font-medium">
                            Add New Address
                        </button>
                    </div>
                </div>

                <!-- Wishlist Tab Content -->
                <div id="Wishlist-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Your Wishlist</p>
                    <p class="mt-2">Save your favorite products for later.</p>
                    <div class="mt-8 p-4 bg-white rounded-xl shadow-sm border border-gray-100 max-w-md mx-auto">
                        <p class="text-gray-700">Your wishlist is empty.</p>
                        <button class="mt-4 px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200 text-sm font-medium">
                            Discover Products
                        </button>
                    </div>
                </div>

                <!-- Placeholder for other tabs -->
                <div id="Notifications-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Content for Notifications will go here.</p>
                    <p class="mt-2">Manage your notification preferences.</p>
                </div>
                <div id="Privacy-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Content for Privacy will go here.</p>
                    <p class="mt-2">Adjust your privacy settings and data sharing.</p>
                </div>
                <div id="Languages-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Content for Languages will go here.</p>
                    <p class="mt-2">Select your preferred language.</p>
                </div>
                <div id="Help-content" class="text-center text-gray-600 py-20 hidden">
                    <p class="text-xl font-semibold">Content for Help will go here.</p>
                    <p class="mt-2">Find answers to common questions and contact support.</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Data for the profile, similar to React state
        let profileData = {
            name: 'Wade Armstrong',
            dateOfBirth: 'December 24, 1998',
            gender: 'Male',
            email: 'wade.armstrong@email.com',
            username: 'wadearmstrong08',
            password: '••••••••••',
            profilePicture: 'https://placehold.co/40x40/FFC0CB/FFFFFF?text=WA'
        };

        // Function to update the profile picture display
        function updateProfilePicture() {
            const imgElement = document.getElementById('profile-picture');
            const removeButton = document.getElementById('remove-profile-picture');
            imgElement.src = profileData.profilePicture;
            if (profileData.profilePicture !== 'https://placehold.co/40x40/FFC0CB/FFFFFF?text=WA') {
                removeButton.classList.remove('hidden');
            } else {
                removeButton.classList.add('hidden');
            }
        }

        // Handle profile picture upload (dummy)
        document.getElementById('upload-profile-picture').addEventListener('click', function() {
            alert('Upload new picture functionality would go here!');
            // Simulate a new picture being uploaded
            profileData.profilePicture = 'https://placehold.co/64x64/A78BFA/FFFFFF?text=New';
            updateProfilePicture();
        });

        document.getElementById('upload-text-button').addEventListener('click', function() {
            alert('Upload new picture functionality would go here!');
            // Simulate a new picture being uploaded
            profileData.profilePicture = 'https://placehold.co/64x64/A78BFA/FFFFFF?text=New';
            updateProfilePicture();
        });

        // Handle profile picture removal
        document.getElementById('remove-profile-picture').addEventListener('click', function() {
            profileData.profilePicture = 'https://placehold.co/40x40/FFC0CB/FFFFFF?text=WA';
            updateProfilePicture();
            alert('Profile picture removed!');
        });

        document.getElementById('remove-text-button').addEventListener('click', function() {
            profileData.profilePicture = 'https://placehold.co/40x40/FFC0CB/FFFFFF?text=WA';
            updateProfilePicture();
            alert('Profile picture removed!');
        });

        // Function to switch tabs
        function switchTab(tabName) {
            // Hide all content divs
            document.querySelectorAll('#content-area > div').forEach(div => {
                div.classList.add('hidden');
            });

            // Show the selected tab's content
            const selectedContent = document.getElementById(`${tabName}-content`);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Update active state for sidebar buttons
            document.querySelectorAll('#sidebar-nav button').forEach(button => {
                if (button.dataset.tab === tabName) {
                    button.classList.add('bg-pink-100', 'text-pink-700');
                    button.classList.remove('text-gray-600', 'hover:bg-gray-50');
                } else {
                    button.classList.remove('bg-pink-100', 'text-pink-700');
                    button.classList.add('text-gray-600', 'hover:bg-gray-50');
                }
            });
            // Re-render Lucide icons after content changes (important for dynamically shown content)
            lucide.createIcons();
        }

        // Add event listeners to sidebar navigation buttons
        document.querySelectorAll('#sidebar-nav button').forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                switchTab(tabName);
            });
        });

        // Initial render: Ensure Lucide icons are created on page load
        window.onload = function() {
            lucide.createIcons();
            updateProfilePicture(); // Ensure initial profile picture state is correct
            switchTab('Account'); // Ensure Account tab is active on load
        };
    </script>
    <!-- ---------------------------------------------------------------------------------------- -->








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


    <!-- ----badge for add to cart end -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>



    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/lightbox/js/lightbox.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

</body>

</html>