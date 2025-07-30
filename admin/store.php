<?php
include('conn.php');
session_start();


// -------------------------------------------------------------
if (isset($_POST['submit'])) {

    $storename = $_POST['storename'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $folder = "images/.$image";
    move_uploaded_file($temp, $folder);

    $query = "UPDATE store SET storename='$storename', email='$email', contactno='$contactno', address='$address', image='$folder' WHERE id = 1";



    $result = mysqli_query($conn,  $query);
    if ($result) {
        echo "<script>window.location.href='../admin/store.php'</script>";
    } else {
        echo "<script>alert('Your Details has not been updated')</script>";
    }
    echo "<script>alert('Your Details has not been updated')</script>";
}
// -------------------------------------------------------------

// --------called store details--------
$query = "SELECT * FROM store";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
// --------ended called store details--------

?>


<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fruity Shop</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Sidebar Mini" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css\form.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <link rel="stylesheet" href="university.css">


    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
    <!-- Font Awesome Kit -->

    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #333;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
            color: #00bfff;
        }

        .title::before {
            width: 18px;
            height: 18px;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .title::before,
        .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: #00bfff;
        }

        .message,
        .signin {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.7);
        }

        .signin {
            text-align: center;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .signin a {
            color: #00bfff;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }


        .form label {
            position: relative;
        }

        .form label .input {
            background-color: #333;
            color: #fff;
            width: 100%;
            padding: 20px 05px 05px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input+span {
            color: rgba(255, 255, 255, 0.5);
            position: absolute;
            left: 10px;
            top: 0px;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown+span {
            top: 12.5px;
            font-size: 0.9em;
        }

        .form label .input:focus+span,
        .form label .input:valid+span {
            color: #00bfff;
            top: 0px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .input {
            font-size: medium;
        }

        .submit {
            border: none;
            outline: none;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
            background-color: #00bfff;
        }

        .submit:hover {
            background-color: #00bfff96;
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }


        /* ------------------------------------------------------------------- */

        /* ------------------------------------------------------------------- */

        /* this is file upload style */

        .custum-file-upload {
            height: 100px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: space-between;
            gap: 20px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            border: 2px dashed rgba(105, 105, 105, 0.397);
            background-color: #333;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
        }

        .custum-file-upload .icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custum-file-upload .icon svg {
            height: 40px;
            fill: rgba(255, 255, 255, 0.5);
        }

        .custum-file-upload .text {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custum-file-upload .text span {
            font-weight: 200;
            color: rgba(255, 255, 255, 0.5);
        }

        .custum-file-upload input {
            display: none;
        }
    </style>
    <style>
        button {
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 10px 30px;
            transition: 0.5s;
            position: relative;
            font-size: 17px;
            background: #333;
            border: none;
            color: #fff;
        }

        button:hover {
            letter-spacing: 0.25em;
            background: #ff1867;
            color: #ff1867;
            box-shadow: 0 0 45px #ff1867;
        }

        button::before {
            content: '';
            position: absolute;
            inset: 2px;
            background: #222222;
        }

        button span {
            position: relative;
            z-index: 1;
        }

        button i {
            position: absolute;
            inset: 0;
            display: block;
        }

        button i::before {
            content: '';
            position: absolute;
            border: 2px solid #ff1867;
            width: 7px;
            height: 4px;
            top: -3.5px;
            left: 80%;
            background: #222222;
            transform: translateX(-50%);
            transition: 0.5s;
        }

        button:hover i::before {
            width: 20px;
            left: 20%;
        }

        button i::after {
            content: '';
            position: absolute;
            border: 2px solid #ff1867;
            width: 7px;
            height: 4px;
            bottom: -3.5px;
            left: 20%;
            background: #222222;
            transform: translateX(-50%);
            transition: 0.5s;
        }

        button:hover i::after {
            width: 20px;
            left: 80%;
        }


        /* --------------------------------------------------------------------------------- */
        /* --------------------------------------------------------------------------------- */

        /* this is for store details */

        .card {
            max-width: 80%;
            margin: 0 auto;
            border-radius: 1rem;
            background-color: rgba(31, 41, 55, 1);
            padding: 1rem;
        }

        .infos {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            grid-gap: 1rem;
            gap: 1rem;
        }

        .image {
            height: 9rem;
            width: 9rem;
            border-radius: 0.5rem;
            background-color: rgb(118, 36, 194);
            background: linear-gradient(to bottom right, rgb(118, 36, 194), rgb(185, 128, 240));
        }

        .info {
            height: 7rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .name {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 1);
        }

        .function {
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175, 1);
        }

        .stats {
            width: 100%;
            border-radius: 0.5rem;
            background-color: rgba(255, 255, 255, 1);
            padding: 0.5rem;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(0, 0, 0, 1);
        }

        .flex {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 4px;
        }


        .state-value {
            font-weight: 700;
            color: rgb(118, 36, 194);
        }

        .request {
            margin-top: 1.5rem;
            width: 100%;
            border: 1px solid transparent;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5rem;
            transition: all .3s ease;
        }

        .request:hover {
            background-color: rgb(118, 36, 194);
            color: #fff;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                        src="images\fruitable.jpg" style="border-radius: 20px; opacity: 1"
                        alt="picture"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">Fruitables</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul
                        class="nav sidebar-menu flex-column"
                        data-lte-toggle="treeview"
                        role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="store.php" class="nav-link">
                                <i class="nav-icon bi bi-palette"></i>
                                <p>Store Details</p>
                            </a>
                        </li>

                        <!-- Product management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-tree-fill"></i>
                                <p>
                                    Product Management
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="product\add.php" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="product\ManageProduct.php" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Manage Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <!-- order management -->
                        <li class="nav-item">
                            <a href="orderm_customer\order.php" class="nav-link">
                                <i class="nav-icon bi bi-tree-fill"></i>
                                <p>
                                    Order Management
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>
                        </li>


                        <!-- category -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Category
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="category\category.php" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Categorys</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">


                <div class="card">
                    <div class="infos">
                        <div class="image"><img style="width: 160px;" src="<?php echo $row['image'] ?>" alt=""></div>
                        <div class="info">
                            <div>
                                <h3 style="color: white;">
                                    <?php echo $row['storename']; ?>
                                </h3>
                                <p class="function">
                                    Store Detail
                                </p>
                            </div>
                            <div class="stats">
                                <p class="flex flex-col">
                                    <strong>Email</strong>
                                    <span class="state-value">
                                        <?php echo $row['email']; ?>
                                    </span>
                                </p>
                                <p class="flex">
                                    <strong>Contact No</strong>
                                    <span class="state-value">
                                        <?php echo $row['contactno']; ?>
                                    </span>
                                </p>
                                <p class="flex">
                                    <strong>Address</strong>
                                    <span class="state-value">
                                        <?php echo $row['address']; ?>
                                    </span>
                                </p>

                            </div>
                        </div>

                    </div>


                    <div class="d-flex">
                        <button class="request">
                            <a href="../index.php" class=" text text-decoration-none text-white" target="new"><span>See Website</span><i></i></a>
                        </button>

                        <!-- <button onclick="openPopup()" class="request w-50">
                            <span>Update Details</span><i></i>
                        </button> -->
                    </div>

                    <!-- ------------------ -->
                    <form class="form" action="?" method="POST" enctype="multipart/form-data">
                        <p class="title">Store Details </p>
                        <p class="message">Enter your store details. </p>

                        <label>
                            <input class="input" type="text" name="storename" placeholder="" required>
                            <span>Store Name</span>
                        </label>

                        <label>
                            <input class="input" type="text" name="email" placeholder="" required="">
                            <span>Email</span>
                        </label>
                        <label>
                            <input class="input" type="text" name="contactno" placeholder="" required="">
                            <span>Contact No</span>
                        </label>
                        <label>
                            <input class="input" type="text" name="address" placeholder="" required="">
                            <span>Address</span>
                        </label>

                        <label class="custum-file-upload" for="file">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                    <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                    <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="text">
                                <span>Click to upload image</span>
                            </div>
                            <input type="file" id="file" name="image">
                        </label>

                        <input class="submit w-100" style="text-align: center; cursor: pointer;" value="UPDATE DETAILS" name="submit" type="submit" />

                        <p class="signin">SEE YOUR WEBSITE ? <a href="../index.html">FRUITABLES</a> </p>
                    </form>
                    <!-- ------------------ -->



                </div>



            </div>




            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/all.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->

</body>
<!--end::Body-->

</html>