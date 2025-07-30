<?php
include('conn.php');

error_reporting(0);

session_start();


// this query is for to register user 
if ($_POST['register']) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO adminuser(username , password) values ('$username','$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Data insert into database";
        header("location: admin\login.php");
    } else {
        echo "Data is not inserted into database";
    }
}
// register query is end


// now this query for sign in or to open admin page
if ($_POST['signin']) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * from adminuser where username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $_SESSION['username'] = $data['username'];
        header("location:..\admin\index.php");
    } else {
        echo "<script>alert('Invalid username or password')</script>";
    }
}
// admin query is end 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>

    <style>
        body {
            background: #e0e0e0;
        }

        .card {
            padding: 170px;
            border-radius: 30px;
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 15px 15px 30px #bebebe,
                -15px -15px 30px #ffffff;
        }

        /* ------card2------- */
        .card2 {
            padding: 170px;
            border-radius: 30px;
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 35%;
            transform: translate(-50%, -50%);
            box-shadow: 15px 15px 30px #bebebe,
                -15px -15px 30px #ffffff;
        }


        /* -------------- */
        .form-container {
            background-color: transparent;
            /* box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
            border-radius: 10px;
            box-sizing: border-box;
            padding: 20px 0;
            width: 250px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .title {
            text-align: center;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            margin: 10px 0 30px 0;
            font-size: 24px;
            font-weight: 800;
        }

        .form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 15px;
        }

        .input {
            border-radius: 20px;
            border: 1px solid #c0c0c0;
            outline: 0 !important;
            box-sizing: border-box;
            padding: 12px 15px;
        }

        .page-link {
            text-decoration: underline;
            margin: 0;
            text-align: end;
            color: #747474;
            text-decoration-color: #747474;
        }

        .page-link-label {
            cursor: pointer;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            font-size: 9px;
            font-weight: 700;
            margin-right: 30px;
        }

        .page-link-label:hover {
            color: #000;
            transition: 0.5s;
        }

        .form-btn {
            padding: 10px 15px;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            border-radius: 20px;
            border: 0 !important;
            outline: 0 !important;
            background: teal;
            color: white;
            cursor: pointer;
            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .form-btn:active {
            box-shadow: none;
        }

        .form-btn:hover {
            background-color: lightseagreen;
            transition: 0.5s;
        }

        .sign-up-label {
            margin: 0;
            font-size: 10px;
            color: #747474;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

        .sign-up-link {
            margin-left: 1px;
            font-size: 11px;
            text-decoration: underline;
            text-decoration-color: teal;
            color: teal;
            cursor: pointer;
            font-weight: 800;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

        .buttons-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            margin-top: 20px;
            gap: 15px;
        }

        .apple-login-button,
        .google-login-button {
            border-radius: 20px;
            box-sizing: border-box;
            padding: 10px 15px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px,
                rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            font-size: 11px;
            gap: 5px;
        }

        .apple-login-button {
            background-color: #000;
            color: #fff;
            border: 2px solid #000;
        }

        .google-login-button {
            border: 2px solid #747474;
        }

        .apple-icon,
        .google-icon {
            font-size: 18px;
            margin-bottom: 1px;
        }

        /* -------------- */
    </style>
    <!-- Register form style -->
    <style>
        /* Modal Styles */
        .container {
            height: fit-content;
            display: flex;
            box-shadow: 0px 187px 75px rgba(0, 0, 0, 0.01), 0px 105px 63px rgba(0, 0, 0, 0.05), 0px 47px 47px rgba(0, 0, 0, 0.09), 0px 12px 26px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
            border-radius: 9px;
        }

        .login-form {
            width: 350px;
            height: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
            border-radius: 9px 0 0 9px;
            background-color: #fff;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 15px 0;
        }

        .title {
            font-weight: 700;
            font-size: 15px;
            line-height: 21px;
            text-align: center;
            color: #2B2B2F;
            margin-bottom: 10px;
        }

        .description {
            max-width: 80%;
            margin: auto;
            font-weight: 600;
            font-size: 10px;
            line-height: 14px;
            text-align: center;
            color: #5F5D6B;
        }

        .input_container {
            width: 100%;
            height: fit-content;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .icon {
            width: 20px;
            position: absolute;
            z-index: 99;
            left: 12px;
            bottom: 9px;
        }

        .input_field {
            width: auto;
            height: 40px;
            padding: 0 0 0 40px;
            border-radius: 7px;
            outline: none;
            border: 1px solid #e5e5e5;
            filter: drop-shadow(0px 1px 0px #efefef) drop-shadow(0px 1px 0.5px rgba(239, 239, 239, 0.5));
            transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
        }

        .input_field:focus {
            border: 1px solid transparent;
            box-shadow: 0px 0px 0px 2px #115DFC;
            background-color: transparent;
        }

        .sign-in_btn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            height: 36px;
            background: linear-gradient(180deg, #4480FF 0%, #115DFC 50%, #0550ED 100%);
            box-shadow: 0px 0.5px 0.5px #EFEFEF, 0px 1px 0.5px rgba(239, 239, 239, 0.5);
            border-radius: 5px;
            border: 0;
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #ffffff;
            transition: all 0.6s cubic-bezier(0.15, 0.83, 0.66, 1);
        }

        .sign-in_btn:hover {
            transform: scale(1.01) translateY(-2px);
            box-shadow: 0 10px 20px 0#054eed6b;
        }

        .testimonial {
            width: 250px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            background: linear-gradient(358.31deg, #fff -24.13%, hsla(0, 0%, 100%, 0) 338.58%), linear-gradient(89.84deg, rgba(230, 36, 174, .15) .34%, rgba(94, 58, 255, .15) 16.96%, rgba(10, 136, 255, .15) 34.66%, rgba(75, 191, 80, .15) 50.12%, rgba(137, 206, 0, .15) 66.22%, rgba(239, 183, 0, .15) 82%, rgba(246, 73, 0, .15) 99.9%);
            border-radius: 0 9px 9px 0;
        }

        .testimonial p {
            color: #4d4c6d;
            font-size: 11px;
            text-align: center;
            font-weight: 600;
        }

        .user-profile-picture {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #00000011;
        }

        .user {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
        }

        .username {
            color: #4d4c6d;
            font-size: 11px;
            text-align: center;
            font-weight: 600;
        }

        .occupation {
            color: rgb(141, 140, 161);
            font-size: 10px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="card">
        <!-- -------- -->
        <div class="form-container">
            <p class="title">Welcome Admin</p>
            <form class="form" action="?" method="POST">
                <input type="text" class="input" placeholder="User name" name="username" required>
                <input type="password" class="input" placeholder="Password" name="password" required>
                <p class="page-link">
                    <span class="page-link-label" onclick="openModal()">Register User</span>
                    <span class="page-link-label">Forgot Password?</span>
                </p>
                <input class="form-btn" type="submit" value="Log in" name="signin"></input>
            </form>
        </div>
        <!-- -------- -->


    </div>

    <!-- ---------form for register user details---------- -->
    <!-- Modal Wrapper -->
    <form action="?" method="POST">
        <div class="container">
            <div class="login-form">
                <div class="header">
                    <label class="title">Create an Account</label>
                    <p class="description">Create your account here which as an access your admin work place to build your product.</p>
                </div>
                <div class="input_container">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z" stroke="#141B34" stroke-width="1.5" stroke-linejoin="round"></path>
                    </svg>
                    <input id="email_field" class="input_field" type="text" name="username" title="Inpit title" placeholder="User name@">
                </div>
                <div class="input_container">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z" fill="#141B34"></path>
                    </svg>
                    <input id="password_field" class="input_field" type="password" name="password" title="Inpit title" placeholder="Password">
                </div>
                <input class="sign-in_btn" type="submit" name="register" value="Sign In">
            </div>
            <div class="testimonial">
                <p>"Welcome' to our store to use freely and friendly to make best profit mergen.."</p>
                <div class="user-profile-picture">
                    <img style="width: 80px; border-radius: 50%; height: 80px" src="..\admin\images\man.jpg" alt="">
                </div>
                <div class="user">
                    <span class="username">Owner Shah Nawaz</span>
                    <span class="occupation">Create Account &amp; And Use it</span>
                </div>
            </div>
        </div>
    </form>










    <!-- javascript files -->
    <script>
        // Create a modal overlay element and style it via JS
        const modalOverlay = document.createElement('div');
        modalOverlay.id = 'modalOverlay';
        modalOverlay.style.position = 'fixed';
        modalOverlay.style.top = '0';
        modalOverlay.style.left = '0';
        modalOverlay.style.width = '100%';
        modalOverlay.style.height = '100%';
        modalOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
        modalOverlay.style.display = 'none'; // hidden by default
        modalOverlay.style.justifyContent = 'center';
        modalOverlay.style.alignItems = 'center';
        modalOverlay.style.zIndex = '9999';

        // Get your existing form container (keep your HTML unchanged)
        const formContainer = document.querySelector('.container');

        // Move the form container inside the modal overlay
        if (formContainer) {
            modalOverlay.appendChild(formContainer);
            document.body.appendChild(modalOverlay);
        }

        // Function to open (show) the modal
        function openModal() {
            modalOverlay.style.display = 'flex';
        }

        // Function to close (hide) the modal
        function closeModal() {
            modalOverlay.style.display = 'none';
        }

        // Close the modal if the user clicks outside the form
        modalOverlay.addEventListener('click', function(event) {
            if (event.target === modalOverlay) {
                closeModal();
            }
        });

        // Optional: If you want to trigger the modal opening, add an event listener
        // For example, if you have a button with ID "openModalButton" uncomment:
        // document.getElementById('openModalButton').addEventListener('click', openModal);

        // Example: You can also automatically open the modal when the page loads:
        // openModal();
    </script>

</body>

</html>