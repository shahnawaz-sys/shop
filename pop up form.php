<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auth Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css " />
    <style>
        .auth-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
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

        .button-submit {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Trigger Icon -->
    <i class="fas fa-user-circle fa-2x" onclick="toggleAuthModal()" style="cursor: pointer;"></i>

    <!-- Auth Modal -->
    <div class="auth-modal" id="authModal">
        <div class="auth-content">
            <span class="close-btn" onclick="toggleAuthModal()">&times;</span>
            <div class="auth-tabs">
                <div class="auth-tab active" onclick="switchForm('login')">Login</div>
                <div class="auth-tab" onclick="switchForm('register')">Register</div>
            </div>
            <!-- Login Form -->
            <form class="auth-form active" id="loginForm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="input" placeholder="Enter your Email" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="input" placeholder="Enter your Password" />
                </div>
                <button type="submit" class="button-submit">Sign In</button>
            </form>
            <!-- Register Form -->
            <form class="auth-form" id="registerForm">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="input" placeholder="Enter your Name" />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="input" placeholder="Enter your Email" />
                </div>
                <button type="submit" class="button-submit">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
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
    </script>
</body>

</html>