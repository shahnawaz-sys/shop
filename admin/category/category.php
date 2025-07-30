<?php
include('..\conn.php');

// ---------query for selection-----
$sql = "SELECT * FROM product";
$showdata = mysqli_query($conn, $sql);

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
        .categorydiv {
            border-radius: 10px;
            background-color: #edf2f4;
            display: flex;
            gap: 20px;
            padding: 5px;
        }

        p {
            margin-top: 5px;
        }

        .categorydiv img {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            padding: 2px;
            margin: 3px;
            border: 1px solid #c2c5aa;
        }

        .productimg {
            border: 1px solid #c2c5aa;
            /* background-color: #f5ebe0; */
            text-align: center;
            border-radius: 10px;
            margin: 5px;
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

                <div class="d-flex justify-content-between align-items-center">
                    <form class="d-flex" role="search" method="get" action="category.php">
                        <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="search" />
                        <input class="btn btn-outline-success" type="submit" name="search">
                    </form>

                    <?php
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
                        $showdata = mysqli_query($conn, $sql);
                    } else {
                        $sql = "SELECT * FROM product";
                        $showdata = mysqli_query($conn, $sql);
                    }
                    ?>
                </div>

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

                <div class="app-content-header__container d-flex flex-column flex-sm-row align-items-center justify-content-between">
                    <h5 class="mb-3">Category Management</h5>
                    <button
                        type="button"
                        class="btn bg-primary text-white m-2"
                        data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal">
                        Add Category
                    </button>
                </div>


                <!-- -------------from for add category ------->
                <div
                    class="modal fade"
                    id="addCategoryModal"
                    tabindex="-1"
                    aria-labelledby="addCategoryModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="?" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Category Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="categoryName"
                                            name="category_name"
                                            placeholder="Enter category"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="add_category" class="btn btn-primary">
                                        Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['category_name']))) {
                    $name = trim($_POST['category_name']);
                    // Save to database...
                    // Example using mysqli:

                    $stmt = ("INSERT INTO categorys (categoryname) VALUES ('$name') ");
                    $concategroy = mysqli_query($conn, $stmt);
                    if ($concategroy) {
                        echo "<script> alert('Category added successfully'); </script>";
                    } else {
                        echo "<script> alert('Category not added. Please try again.'); </script>";
                    };
                }
                ?>


                <script>
                    document.querySelector('#addCategoryModal form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const form = this;
                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form)
                            })
                            .then(res => res.text())
                            .then(html => {
                                const modalEl = document.getElementById('addCategoryModal');
                                const modal = bootstrap.Modal.getInstance(modalEl);
                                modal.hide();
                                alert('✅ Category added!');
                                // TODO: Optionally append the new category to the DOM
                                form.reset();
                            })
                            .catch(err => alert('❌ Error: ' + err));
                    });

                    // Close the modal after saving
                    const modalEl = document.getElementById('addCategoryModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();
                </script>


                <!-- -------------from for add category ------->


                <h3 class="mb-1">Friuts</h3>

                <div class="categorydiv">
                    <?php
                    $sql = "SELECT * FROM product where category='Fruits'";
                    $showdata = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($showdata)) {
                    ?>
                        <div class="d-flex">
                            <div class="card productimg">
                                <img src="../../img/<?php echo $row['product_img']; ?>" alt="">
                                <p><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>

                    <?php } ?>

                </div>

                <h3 class="mb-1 mt-3">Vegetable</h3>
                <div class="categorydiv">
                    <?php
                    $sql = "SELECT * FROM product where category='Vegetable'";
                    $showdata = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($showdata)) {
                    ?>
                        <div class="d-flex">
                            <div class="card productimg">
                                <img src="../../img/<?php echo $row['product_img']; ?>" alt="">
                                <p><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>

                    <?php } ?>
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