<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "intern_system";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System with Email Verification</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Toastr CSS for notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("https://images.unsplash.com/photo-1485470733090-0aae1788d5af?q=80&w=1517&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }
        .login-form, .registration-form {
            backdrop-filter: blur(100px);
            color: rgb(255, 255, 255);
            padding: 40px;
            width: 500px;
            border: 2px solid;
            border-radius: 10px;
        }
        .switch-form-link {
            text-decoration: underline;
            cursor: pointer;
            color: rgb(100, 100, 200);
        }
    </style>
</head>
<body>
    <div class="main">

        <!-- Login Area -->
        <div class="login-container">
            <h2 class="text-center" style="color: white;">Household Expenditure Power Analysis</h2>

            <div class="login-form" id="loginForm">
                <h2 class="text-center">Login Form</h2>
                <p class="text-center">Fill your login details.</p>
                <form action="./login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="What is your name?"required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Please enter your password" required>
                    </div>
                    <p>No Account? Register <span class="switch-form-link" onclick="showRegistrationForm()">Here.</span></p>
                    <button type="submit" class="btn btn-secondary login-btn form-control">Login</button>
                </form>
            </div>
        </div>

        <!-- Registration Area -->
        <div class="registration-form" id="registrationForm" style="display:none;">
            <h2 class="text-center">Registration Form</h2>
            <p class="text-center">Fill in your personal details.</p>
            <form id="registrationFormAction" action="./add-user.php" method="POST">

                <div class="form-group registration">
                    <label for="registerUsername">Username:</label>
                    <input type="text" class="form-control" id="registerUsername" name="username" placeholder="How do we call you?" required>
                </div>
                <div class="form-group registration">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email" required>
                </div>
                <div class="form-group registration">
                    <label for="registerPassword">Password:</label>
                    <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Please enter your password" required>
                </div>
                <div class="form-group registration">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <div><small>*Password must be at least 8 characters*</small></div>
                <div><small>*Password must contain at least one upper case letter*</small></div>
                <div><small>*Password must contain at least one lower case letter*</small></div>
                <div><small>*Password must contain at least one digit*</small></div><br>

                <p>Already have an account? Login <span class="switch-form-link" onclick="showLoginForm()">Here.</span></p>
                <button type="submit" class="btn btn-dark login-register form-control" name="register">Register</button>
            </form>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const registrationForm = document.getElementById('registrationForm');

        function showRegistrationForm() {
            registrationForm.style.display = "block";
            loginForm.style.display = "none";
        }

        function showLoginForm() {
            registrationForm.style.display = "none";
            loginForm.style.display = "block";
        }

        // Passwords matching validation
        const registerPassword = document.getElementById('registerPassword');
        const confirmPassword = document.getElementById('confirm_password');

        confirmPassword.oninput = function () {
            if (registerPassword.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
            } else {
                confirmPassword.setCustomValidity('');
            }
        };

        // Password validation and form submission for registration form
        document.addEventListener("DOMContentLoaded", function() {
            const registrationForm = document.getElementById('registrationFormAction');
            if (registrationForm) {
                registrationForm.addEventListener('submit', function(event) {
                    const password = document.getElementById('registerPassword').value;
                    const upperCase = /[A-Z]/;
                    const lowerCase = /[a-z]/;
                    const numbers = /[0-9]/;

                    if (password !== "") {
                        if (password.length < 8) {
                            event.preventDefault();
                            toastr.error("Password length must be longer than 8 characters");
                        } else if (!upperCase.test(password)) {
                            event.preventDefault();
                            toastr.error("Password must contain at least one upper case");
                        } else if (!lowerCase.test(password)) {
                            event.preventDefault();
                            toastr.error("Password must contain at least one lower case");
                        } else if (!numbers.test(password)) {
                            event.preventDefault();
                            toastr.error("Password must contain at least one digit");
                        }
                    } else {
                        event.preventDefault();
                        toastr.warning("Please insert required information");
                    }
                });
            } else {
                console.error("Form with ID 'registrationFormAction' not found.");
            }
        });
    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Toastr Js for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>
