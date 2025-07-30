<?php
include('..\conn.php');
session_start();


// ------------------------
if (isset($_POST['submit'])) {
    $productname = $_POST['productname'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $folder = "../../img/" . $image;
    move_uploaded_file($image_tmp, $folder);

    $price = $_POST['price'];
    $special_price = $_POST['special_price'];
    $stock = $_POST['stock'];
    $sku = $_POST['sku'];

    $discription = $_POST['discription'];


    $sql = "INSERT INTO product(product_name,category,product_img, price,special_Price,stock, sku, discription) 
    VALUES ('$productname','$category','$image','$price','$special_price', '$stock' , '$sku','$discription')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Product Added Successfully")</script>';
    } else {
        echo '<script>alert("Product Not Added")</script>';
    };
}
// ------------------------
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
        .uploadimg {
            display: flex;
            gap: 5px;
        }

        .uploadimg img {
            width: 100%;
            margin-top: 10px;
            border-radius: 10px;
        }
    </style>
    <style>
        .uploadimg {
            display: flex;
            gap: 10px;
            margin-right: 900px;
        }

        .uploadimg img {
            width: 250px;
            margin-top: 10px;
            border-radius: 10px;
        }
    </style>
    <style>
        .uploadproimgs {
            width: 100%;
            height: 150px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 20px;
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



                <form action="?" method="POST" enctype="multipart/form-data">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Add Product</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name *</label>
                                <input type="text" class="form-control" name="productname" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category *</label>
                                <select name="category" id="" class="form-control">
                                    <?php
                                    $catsql = "SELECT * FROM categorys";
                                    $catfatch = mysqli_query($conn, $catsql);
                                    while ($catnames = mysqli_fetch_assoc($catfatch)) {
                                        echo "<option value='" . $catnames['categoryname'] . "'>" . $catnames['categoryname'] . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>



                            <label class="form-label">Upload Product image *</label>
                            <div class="uploadproimgs d-flex gap-3">
                                <div class="input-group mb-3">
                                    <label for="file" class="custum-file-upload">
                                        <div class="icon">
                                            <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="text">
                                            <span>upload image</span>
                                        </div>
                                        <input id="file" type="file" name="image">
                                    </label>
                                </div>
                                <div class="uploadimg">
                                    <!-- <img src="..\images\apple.jpg" alt="" class="img-fluid">
                                    <img src="..\images\fruitable.jpg" alt="" class="img-fluid">
                                    <img src="..\images\fruits.jpg" alt="" class="img-fluid"> -->
                                </div>
                            </div>
                        </div>

                        <!--end::Form-->
                    </div>




                    <div class="card my-4">
                        <div class="card p-4">
                            <h5 class="mb-3">Price, Stocks</h5>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="bg-light">Price</th>
                                        <th scope="row" class="bg-light">Special Price <small>(Optional)</small> </th>
                                        <th scope="row" class="bg-light">Stock</th>
                                        <th scope="row" class="bg-light">SKU</th>
                                        <!-- <th scope="row" class="bg-light">Weight</th> -->
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="form-control" placeholder="Enter price" name="price"></td>
                                        <td><input type=" number" class="form-control" placeholder="Enter special price" name="special_price"></td>
                                        <td><input type=" number" class="form-control" placeholder="Enter stock quantity" name="stock"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter SKU" name="sku"></td>
                                        <!-- <td><input type="text" class="form-control" placeholder="Enter weight"></td> -->
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>




                    <div class="card my-4">
                        <div class="card p-4">
                            <h5 class="mb-3">Product Description</h5>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="8" placeholder="Enter detailed description..." name="discription" required></textarea>

                            </div>
                            <div class="text-end">
                                <input type="submit" class="btn btn-success" name="submit">
                            </div>

                        </div>
                    </div>
                </form>

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