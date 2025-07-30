<?php
include('../conn.php');


//----------------query for selection---
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

//--------------------------------------


//----------------query for product updation ------
if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $updatename = $_POST['updatename'];
    $updatecategory = $_POST['updatecategory'];

    // Handle image upload if a new image is provided
    if (!empty($_FILES['updateimage']['name'])) {
        $updateimage = $_FILES['updateimage']['name'];
        $image_tmp = $_FILES['updateimage']['tmp_name'];
        $folder = "../../img/" . basename($updateimage);
        move_uploaded_file($image_tmp, $folder);
    } else {
        // If no new image is uploaded, retain the existing image path
        // You need to fetch the existing image path from the database
        $query = "SELECT product_img FROM product WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $folder = $row['product_img'];
    }

    $updateprice = $_POST['updateprice'];
    $updatespecialprice = $_POST['updatespecialprice'];
    $updatestock = $_POST['updatestock'];
    $updatedescription = $_POST['updatedescription'];
    $queryy = "UPDATE product SET 
                                product_name = '$updatename', 
                                category = '$updatecategory', 
                                product_img = '$updateimage', 
                                price = '$updateprice',
                                special_Price = '$updatespecialprice', 
                                stock = '$updatestock', 
                                discription = '$updatedescription' 
                                WHERE id = '$id'";
    $results = mysqli_query($conn, $queryy);
    if ($results) {
        header("Location:ManageProduct.php");
    } else {
        echo '<script>alert("update faild")</script>';
    }
}
//--------------------------------------

// ----------query for seraching----

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM product";
    $result = mysqli_query($conn, $query);
}
$count = mysqli_num_rows($result);

// ---------------------------------
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

    <style>
        .custum-file-upload {
            height: 130px;
            width: 150px;
            display: flex;
            flex-direction: column;
            align-items: space-between;
            gap: 20px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            border: 2px dashed #003049;
            background-color: #e8e8e8;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0px 48px 35px -48px #e8e8e8;
        }

        .custum-file-upload .icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custum-file-upload .icon svg {
            height: 40px;
            fill: black;
        }

        .custum-file-upload .text {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custum-file-upload .text span {
            font-weight: 400;
            color: black;
        }

        .custum-file-upload input {
            display: none;
        }
    </style>

    <style>
        .showmentproduct {
            height: 250px;
            border-radius: 20px;
            background-color: #001d3d;
            gap: 230px;
        }


        .detail {
            margin: 20px 20px;
            border-radius: 20px;
            padding: 8px;

            h1,
            h5 {
                color: white;
            }

            small {
                color: orange;
            }
        }

        .boyimg img {
            width: 130px;
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
            <!--begin::App Content Header-->
            <div class="app-content-header">



                <div class="container">

                    <div class="showmentproduct d-flex">
                        <div class="detail">
                            <h1>Friuts & Vegetables</h1>
                            <div class="mt-4">
                                <h5>Fresh Fruits &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <small>
                                        <?php
                                        $qry = "SELECT count(id) as total from product where category='Fruits'";
                                        $resultt = mysqli_query($conn, $qry);
                                        $roww = mysqli_fetch_array($resultt);
                                        $fruits = $roww['total'];
                                        echo  $fruits;
                                        ?>
                                    </small>

                                </h5>
                                <h5>Fresh Vegetables &nbsp; &nbsp; &nbsp;&nbsp;
                                    <small>
                                        <?php
                                        $qry = "SELECT count(id) as total from product where category='Vegetable'";
                                        $reslt = mysqli_query($conn, $qry);
                                        $rows = mysqli_fetch_array($reslt);
                                        $vegetable = $rows['total'];
                                        echo  $vegetable;
                                        ?>
                                    </small>
                                </h5>
                            </div>

                        </div>

                        <div class="boyimg">
                            <img src="..\images\boy.png" alt="">
                        </div>


                        <!-- carousel bootstrap -->
                        <div id="autoCarousel" class="carousel slide w-25 mt-4" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="..\images\cherrystubry.png" class="d-block w-100" alt="Slide 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="..\images\colorfulriuts.png" class="d-block w-100" alt="Slide 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="..\images\orange.png" class="d-block w-75" alt="Slide 3">
                                </div>
                                <div class="carousel-item">
                                    <img src="..\images\maltifriuts.png" class="d-block w-100" alt="Slide 3">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="container my-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Manage Products</h5>
                            <form class="d-flex" role="search" action="?" method="POST">
                                <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="search">
                                <input class="btn btn-outline-success" type="submit" value="Search" name="search">
                            </form>



                        </div>
                        <div class="table-responsive rounded-4 border">

                            <table class="table table-hover align-middle">
                                <thead class="table text-center">
                                    <tr>
                                        <th style="background-color: #003049; color:#e8e8e8; width: 700px">Products</th>
                                        <th style="background-color: #003049; color:#e8e8e8">Price</th>
                                        <th style="background-color: #003049; color:#e8e8e8">Stock</th>
                                        <th style="background-color: #003049; color:#e8e8e8">Category</th>
                                        <th style="background-color: #003049; color:#e8e8e8">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                        <tr class="text-center">
                                            <td class="text-start d-flex align-items-center gap-4">

                                                <img src="../../img/<?php echo $row['product_img']; ?>" alt="Product Image" width="100" height="80" class="rounded">
                                                <div>
                                                    <strong><?php echo $row['product_name']; ?></strong><br>
                                                    <small class="text-muted">Fresh - <?php echo $row['category']; ?></small> <br>
                                                    <small class="text"><?php echo $row['discription']; ?></small>
                                                </div>

                                            </td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['stock']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td>
                                                <!-- <a href="?" class="btn btn-sm btn-outline-primary me-1">Edit</a> -->
                                                <button type="button" onclick="populateEditForm(product)" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1" value="<?php echo $row['id']; ?>"> Edit</button>

                                                <!-- -------------pop up form------------------- -->
                                                <div class="modal fade" id="editProductModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form id="editProductForm" method="POST" enctype="multipart/form-data" action="?">
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="product_id" id="product_id">

                                                                    <div class="row g-3">
                                                                        <div class="col-md-4">
                                                                            <label for="product_name" class="form-label">Name</label>
                                                                            <input type="text" class="form-control" id="product_name" value="<?php echo $row['product_name']; ?>" name="updatename" required>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <label for="product_price" class="form-label">Price</label>
                                                                            <input type="number" step="0.01" class="form-control" id="product_price" value="<?php echo $row['price']; ?>" name="updateprice" required>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="product_category" class="form-label">Category</label>
                                                                            <select class="form-select" id="product_category" value="<?php echo $row['category']; ?>" name="updatecategory" required>
                                                                                <option value="Fruits">Fruits</option>
                                                                                <option value="Vegetable">Vegetable</option>
                                                                                <option value="Dry Fruits">Dry Fruits</option>

                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="product_stock" class="form-label">Stock</label>
                                                                            <input type="text" class="form-control" id="product_stock" value="<?php echo $row['stock']; ?>" name="updatestock" required>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="product_price" class="form-label">special Price <small>(Optional)</small></label>
                                                                            <input type="number" step="0.01" class="form-control" value="<?php echo $row['special_Price']; ?>" id="product_price" name="updatespecialprice">
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <label for="product_image" class="form-label">Image</label>
                                                                            <input type="file" class="form-control" id="product_image" value="<?php echo $row['product_img']; ?>" name="updateimage" required>

                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label for="product_description" class="form-label">Description</label>
                                                                            <textarea class="form-control" id="product_description" id="product_description" name="updatedescription" rows="4"><?php echo $row['discription']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <input type="submit" value="Save Changes" class="btn btn-primary" name="update">
                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ---------------end pop up form----------------- -->

                                                <a href="..\product\delete.php<?php echo "?id=" . $row['id']; ?>"><input type='submit' value='Delete' class="btn btn-sm btn-outline-danger"></a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                    <!-- Add more rows as needed -->

                                </tbody>
                            </table>
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