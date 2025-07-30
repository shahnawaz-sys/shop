<?php
include('..\conn.php');

// this query is for all orders-------------------------
$sql = "SELECT  uo.order_id, uo.firstname, uo.lastname, uo.mobileno, uo.address, uo.status, uo.date,              -- ✅ Add this if you want to show status in 
oi.product_id, oi.qty, oi.t_price, p.product_name, p.product_img, p.category
FROM user_order uo
JOIN order_items oi ON uo.order_id = oi.order_id
JOIN product p ON oi.product_id = p.id
ORDER BY uo.order_id DESC";

$result = mysqli_query($conn, $sql);
// -------------------------------------------------------


// -----this is query is for pending orders--------------------------------------------------
$qury = "SELECT  uo.order_id, uo.firstname, uo.lastname, uo.mobileno, uo.address, uo.status, uo.date, 
oi.product_id, oi.qty, oi.t_price, p.product_name, p.product_img, p.category
FROM user_order uo
JOIN order_items oi ON uo.order_id = oi.order_id
JOIN product p ON oi.product_id = p.id
WHERE uo.status = 'Pending'
ORDER BY uo.order_id DESC";

$result2 = mysqli_query($conn, $qury);
// -------------------------------------------------------

// -----this is query is for pending orders--------------------------------------------------
$qury = "SELECT  uo.order_id, uo.firstname, uo.lastname, uo.mobileno, uo.address, uo.status, uo.date, 
oi.product_id, oi.qty, oi.t_price, p.product_name, p.product_img, p.category
FROM user_order uo
JOIN order_items oi ON uo.order_id = oi.order_id
JOIN product p ON oi.product_id = p.id
WHERE uo.status = 'shipped'
ORDER BY uo.order_id DESC";

$result3 = mysqli_query($conn, $qury);
// -------------------------------------------------------


// ---------------ready to ship------------------------------
if (isset($_POST['readytoship'])) {
    $order_id = $_POST['order_id'];
    $new_status = 'Shipped';

    $updated_status = mysqli_query($conn, "UPDATE user_order SET status='$new_status' WHERE order_id='$order_id'");
    // -------------------------------------------------
} else {
    error_reporting(0);
}
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
    <link rel="stylesheet" href="..\css\form.css" />
    <!--end::Required Plugin(AdminLTE)-->


    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
    <!-- Font Awesome Kit -->

    <!-- table style -->
    <style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .order-status {
            font-weight: 500;
            color: #0d6efd;
        }

        .btn-track {
            background-color: #f57224;
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
                <a href="../index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                        src="..\images\fruitable.jpg" style="border-radius: 20px; opacity: 1"
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
                            <a href="../index.php" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="../store.php" class="nav-link">
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
                                    <a href="../product\add.php" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="..\product\ManageProduct.php" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Manage Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <!-- order management -->
                        <li class="nav-item">
                            <a href="../orderm_customer\order.php" class="nav-link">
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
                                    <a href="../category\category.php" class="nav-link">
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


            <!-- <?php
                    if ($updated_status) {
                    ?>

                <div class="alert alert-warning w-25" role="alert" style="z-index: 1000; position: fixed; top: 10%; right: 5%;;">
                    A simple warning alert with
                    <a href="#" class="alert-link">an example link</a>. Give it a click if you
                    like.
                </div>
            <?php
                    }
            ?> -->

            <?php if ($updated_status): ?>
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
            <?php endif; ?>

            <!--begin::App Content Header-->
            <div class="app-content-header">

                <!-- ----------------------------- -->


                <div class="container p-4 rounded">
                    <h4 class="mb-4">Order Management</h4>

                    <!-- Tab Navigation -->
                    <ul class="nav mb-3 gap-5" id="orderTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button style="color: black;" class="nav-link active" data-bs-toggle="tab" data-bs-target="#allOrders" type="button" role="tab">All Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button style="color: black;" class="nav-link" data-bs-toggle="tab" data-bs-target="#pendingOrders" type="button" role="tab">Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button style="color: black;" class="nav-link" data-bs-toggle="tab" data-bs-target="#shippedOrders" type="button" role="tab">Shipped</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button style="color: black;" class="nav-link" data-bs-toggle="tab" data-bs-target="#deliveredOrders" type="button" role="tab">Delivered</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button style="color: black;" class="nav-link" data-bs-toggle="tab" data-bs-target="#cancelledOrders" type="button" role="tab">Cancelled</button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="orderTabContent">

                        <!-- All Orders Tab -->
                        <div class="tab-pane fade show active" id="allOrders" role="tabpanel">
                            <h6>All Orders</h6>
                            <!-- -------------------------- -->
                            <div class="card">
                                <div class="d-flex">
                                    <!-- Main Content -->
                                    <div class="flex-grow-1 p-3">

                                        <div class="table-responsive mt-4 rounded">
                                            <table class="table table-bordered table-hover align-middle bg-white">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                        <tr>
                                                            <form action="?" method="POST">
                                                                <td>#ORD<?php echo str_pad($row['order_id'], 5, '0', STR_PAD_LEFT); ?></td>
                                                                <td>
                                                                    <b><?php echo $row['firstname'] . " " . $row['lastname']; ?></b><br>
                                                                    Cont No: <?php echo $row['mobileno']; ?><br>
                                                                    Address: <?php echo $row['address']; ?><br>
                                                                    Date/Time: <?php echo $row['date']; ?>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="../../img/<?php echo $row['product_img']; ?>" class="product-img me-2" alt="" style="width:60px;">
                                                                        <div>
                                                                            <strong><?php echo $row['product_name']; ?></strong><br>
                                                                            <small class="text-muted">
                                                                                Category: <?php echo $row['category']; ?><br>
                                                                                Seller: Fruitables
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $row['qty']; ?></td>
                                                                <td>Rs<?php echo $row['t_price']; ?></td>
                                                                <?php if ($row['status'] == 'Pending') {
                                                                ?>
                                                                    <td><span class="badge text-bg-warning"><?php echo $row['status']; ?></span></td>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <td><span class="badge bg-info text-dark"><?php echo $row['status']; ?></span></td>
                                                                <?php
                                                                } ?>

                                                                <td>
                                                                    <button class="btn btn-sm btn-primary" name="readytoship">Ready to ship</button>
                                                                    <button class="btn btn-sm btn-danger">Cancel</button>
                                                                </td>
                                                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                                            </form>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------------- -->
                        </div>

                        <!-- Pending Tab -->
                        <div class="tab-pane fade" id="pendingOrders" role="tabpanel">
                            <h6>Pending Orders</h6>
                            <!-- -------------------------- -->
                            <div class="card">
                                <div class="d-flex">
                                    <!-- Main Content -->
                                    <div class="flex-grow-1 p-3">

                                        <div class="table-responsive mt-4 rounded">
                                            <table class="table table-bordered table-hover align-middle bg-white">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                                                        <tr>
                                                            <td>#ORD<?php echo str_pad($row['order_id'], 5, '0', STR_PAD_LEFT); ?></td>
                                                            <td>
                                                                <b><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></b><br>
                                                                Cont No: <?php echo $row['mobileno']; ?><br>
                                                                Address: <?php echo $row['address']; ?><br>
                                                                Date/Time: <?php echo $row['date']; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="../../img/<?php echo $row['product_img']; ?>" class="product-img me-2" style="width: 60px;" alt="">
                                                                    <div>
                                                                        <strong><?php echo $row['product_name']; ?></strong><br>
                                                                        <small class="text-muted">Category: <?php echo $row['category']; ?><br>Seller: Fruitables</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $row['qty']; ?></td>
                                                            <td>Rs<?php echo $row['t_price']; ?></td>
                                                            <td><span class="badge text-bg-warning"><?php echo $row['status']; ?></span></td>
                                                        </tr>
                                                    <?php } ?>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------------- -->
                        </div>

                        <!-- Shipped Tab -->
                        <div class="tab-pane fade" id="shippedOrders" role="tabpanel">
                            <h6>Shipped Orders</h6>
                            <!-- -------------------------- -->
                            <div class="card">
                                <div class="d-flex">
                                    <!-- Main Content -->
                                    <div class="flex-grow-1 p-3">

                                        <div class="table-responsive mt-4 rounded">
                                            <table class="table table-bordered table-hover align-middle bg-white">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- Order Row -->
                                                    <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                                                        <tr>
                                                            <td>#ORD<?php echo str_pad($row['order_id'], 5, '0', STR_PAD_LEFT); ?></td>
                                                            <td>
                                                                <b><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></b><br>
                                                                Cont No: <?php echo $row['mobileno']; ?><br>
                                                                Address: <?php echo $row['address']; ?><br>
                                                                Date/Time: <?php echo $row['date']; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="../../img/<?php echo $row['product_img']; ?>" class="product-img me-2" style="width: 60px;" alt="">
                                                                    <div>
                                                                        <strong><?php echo $row['product_name']; ?></strong><br>
                                                                        <small class="text-muted">Category: <?php echo $row['category']; ?><br>Seller: Fruitables</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $row['qty']; ?></td>
                                                            <td>Rs<?php echo $row['t_price']; ?></td>
                                                            <td><span class="badge bg-info text-dark"><?php echo $row['status']; ?></span></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <!-- Another Order -->
                                                    <!-- <tr>
                                                        <td>#ORD00124</td>
                                                        <td> <b>Ali Raza</b> <br> Cont No: 03412345678 <br> Address: 123, Main Street, Lahore</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="..\images\piynaple.png" class="product-img me-2" alt="">
                                                                <div>
                                                                    <strong>Bluetooth Headphones</strong><br>
                                                                    <small class="text-muted">Category: Fruits<br>Seller: Fruitables</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>2</td>
                                                        <td>$150.00</td>
                                                        <td><span class="badge text-bg-warning">Shipped</span></td>

                                                    </tr> -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------------- -->
                        </div>

                        <!-- Delivered Tab -->
                        <div class="tab-pane fade" id="deliveredOrders" role="tabpanel">
                            <h6>Delivered Orders</h6>
                            <!-- -------------------------- -->
                            <div class="card">
                                <div class="d-flex">
                                    <!-- Main Content -->
                                    <div class="flex-grow-1 p-3">

                                        <div class="table-responsive mt-4 rounded">
                                            <table class="table table-bordered table-hover align-middle bg-white">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- Order Row -->
                                                    <tr>
                                                        <td>#ORD00123</td>
                                                        <td> <b>Ali Raza</b> <br> Cont No: 03412345678 <br> Address: 123, Main Street, Lahore</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="..\images\orange.png" class="product-img me-2" alt="">
                                                                <div>
                                                                    <strong>Smart Watch Series 8</strong><br>
                                                                    <small class="text-muted">Category: Fruits<br>Seller: Fruitables</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>1</td>
                                                        <td>$75.00</td>
                                                        <td> <span class="badge text-bg-success">Delivered</span> </td>
                                                    </tr>

                                                    <!-- Another Order -->
                                                    <tr>
                                                        <td>#ORD00124</td>
                                                        <td> <b>Ali Raza</b> <br> Cont No: 03412345678 <br> Address: 123, Main Street, Lahore</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="..\images\piynaple.png" class="product-img me-2" alt="">
                                                                <div>
                                                                    <strong>Bluetooth Headphones</strong><br>
                                                                    <small class="text-muted">Category: Fruits<br>Seller: Fruitables</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>2</td>
                                                        <td>$150.00</td>
                                                        <td> <span class="badge bg-success">Delivered</span> </td>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------------- -->
                        </div>

                        <!-- Cancelled Tab -->
                        <div class="tab-pane fade" id="cancelledOrders" role="tabpanel">
                            <h6>Cancelled Orders</h6>
                            <!-- -------------------------- -->
                            <div class="card">
                                <div class="d-flex">
                                    <!-- Main Content -->
                                    <div class="flex-grow-1 p-3">

                                        <div class="table-responsive mt-4 rounded">
                                            <table class="table table-bordered table-hover align-middle bg-white">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- Order Row -->
                                                    <tr>
                                                        <td>#ORD00123</td>
                                                        <td> <b>Ali Raza</b> <br> Cont No: 03412345678 <br> Address: 123, Main Street, Lahore</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="..\images\orange.png" class="product-img me-2" alt="">
                                                                <div>
                                                                    <strong>Smart Watch Series 8</strong><br>
                                                                    <small class="text-muted">Category: Fruits<br>Seller: Fruitables</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>1</td>
                                                        <td>$75.00</td>
                                                        <td> <span class="badge text-bg-danger">Cancelled</span> </td>

                                                    </tr>

                                                    <!-- Another Order -->
                                                    <tr>
                                                        <td>#ORD00124</td>
                                                        <td> <b>Ali Raza</b> <br> Cont No: 03412345678 <br> Address: 123, Main Street, Lahore</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="..\images\piynaple.png" class="product-img me-2" alt="">
                                                                <div>
                                                                    <strong>Bluetooth Headphones</strong><br>
                                                                    <small class="text-muted">Category: Fruits<br>Seller: Fruitables</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>2</td>
                                                        <td>$150.00</td>
                                                        <td> <span class="badge text-bg-danger">Cancelled</span> </td>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------------- -->
                        </div>
                    </div>
                </div>

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
    <script src="../js/all.js"></script>
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



    <!-- for pop up form javascript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Create a modal overlay element
            const modalOverlay = document.createElement("div");
            modalOverlay.id = "modalOverlay";
            Object.assign(modalOverlay.style, {
                position: "fixed",
                top: "0",
                left: "0",
                width: "100%",
                height: "100%",
                backgroundColor: "rgba(0, 0, 0, 0.5)",
                display: "none",
                justifyContent: "center",
                alignItems: "center",
                zIndex: "9999",
            });

            // Locate your form (with class "form") and move it into the modal overlay
            const formElement = document.querySelector("form.form");
            if (formElement) {
                modalOverlay.appendChild(formElement);
            }

            // Append the modal overlay to the document body
            document.body.appendChild(modalOverlay);

            // Function to open the popup modal
            function openModal() {
                modalOverlay.style.display = "flex";
            }

            // Function to close the modal when clicking outside the form area
            modalOverlay.addEventListener("click", function(e) {
                if (e.target === modalOverlay) {
                    modalOverlay.style.display = "none";
                }
            });

            // Expose the openModal function as a global function for triggering the popup
            window.openPopup = openModal;
        });
    </script>
</body>
<!--end::Body-->

</html>