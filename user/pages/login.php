<?php
include('../../db_config.php');
session_start();
if (!isset($_SESSION['Registor_Account'])) {
} else {
    echo $_SESSION['Registor_Account'];
    unset($_SESSION['Registor_Account']);
}

if (isset($_POST['Welcome'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $rem = $_POST['remember'];
    $select = "SELECT * FROM tb_users where `Email` = '$email' AND `Password` = '$pass'";
    $sltActive = "SELECT `activity` FROM `tb_users` Where `Email` = '$email'";
    $resActive = mysqli_query($con, $sltActive);
    $dataActive = mysqli_fetch_assoc($resActive);
    $res = mysqli_query($con, $select);
    if ($row = mysqli_num_rows($res) > 0) {
        if ($dataActive['activity'] == 1) {
            header("location: ../../index.php");
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
        } else {
            echo "<script>alert('Account is blocked')</script>";
            header('location: login.php');
        }
    }
} else {
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Shapehugs</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            background: var(--primary-bg);
        }

        .auth-card {
            background: #fff;
            width: 100%;
            max-width: 550px;
            padding: 50px 40px;
            border-radius: 8px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--border-color);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: var(--muted-text);
            font-size: 14px;
        }

        .auth-btn {
            width: 100%;
            padding: 15px;
            background: var(--text-color);
            color: #fff;
            border: none;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: var(--transition);
            margin-top: 10px;
        }

        .auth-btn:hover {
            background: var(--accent-color);
        }

        .auth-links {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: var(--muted-text);
        }

        .auth-links a {
            color: var(--text-color);
            font-weight: 600;
            text-decoration: underline;
        }

        .auth-links a:hover {
            color: var(--accent-color);
        }

        .auth-extra {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .auth-extra a {
            color: var(--muted-text);
            text-decoration: underline;
        }

        .auth-extra a:hover {
            color: var(--text-color);
        }

        .form-group input.invalid {
            border-color: #d9534f !important;
        }

        /* Notification Styles */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notification {
            background: #fff;
            border-left: 4px solid #d9534f;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 15px 20px;
            min-width: 250px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 4px;
            transform: translateX(120%);
            transition: transform 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            border-left-color: #28a745;
        }

        .notification i {
            color: #d9534f;
            font-size: 16px;
        }

        .notification.success i {
            color: #28a745;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 40px 20px;
                border: none;
                box-shadow: none;
            }

            .auth-page {
                padding: 20px 0;
            }
        }
    </style>
</head>

<body>
    <main class="auth-page">
        <div class="auth-card">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 class="serif" style="font-size: 24px; letter-spacing: 4px;">
                    <a href="../../index.php" style="text-decoration: none; color: inherit;">Shapehugs</a>
                </h1>
            </div>
            <div class="auth-header">
                <h2 class="serif">Welcome Back</h2>
                <p>Sign in to access your account</p>
            </div>
            <form id="loginForm" method="post">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="email" placeholder="Enter your email" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" placeholder="Enter your password" name="pass">
                </div>
                <div class="auth-extra">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin: 0; font-weight: 400; text-transform: none; font-size: 12px; color: var(--text-color);">
                        <input type="checkbox" style="width: auto; padding: 0;" name="remember"> Remember me
                    </label>
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                <button type="submit" class="auth-btn" name="Welcome">Sign In</button>
            </form>
            <div class="auth-links">
                Don't have an account? <a href="register.php">Create Account</a>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            // Create notification container
            const notifContainer = document.createElement('div');
            notifContainer.className = 'notification-container';
            document.body.appendChild(notifContainer);

            function showNotification(message, type = 'error') {
                const notif = document.createElement('div');
                notif.className = `notification ${type}`;
                const icon = type === 'error' ? '<i class="fa-solid fa-circle-exclamation"></i>' : '<i class="fa-solid fa-circle-check"></i>';
                notif.innerHTML = `
                    ${icon}
                    <span style="font-size: 13px; font-weight: 500; color: var(--text-color);">${message}</span>
                `;
                notifContainer.appendChild(notif);
                void notif.offsetWidth;
                notif.classList.add('show');
                setTimeout(() => {
                    notif.classList.remove('show');
                    setTimeout(() => notif.remove(), 300);
                }, 3000);
            }

            function validateField(input, validator) {
                const error = validator();
                if (error) {
                    input.classList.add('invalid');
                } else {
                    input.classList.remove('invalid');
                }
                return error;
            }

            const validateEmail = () => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailInput.value.trim() === '') return 'Email is required.';
                if (!emailRegex.test(emailInput.value.trim())) return 'Please enter a valid email address.';
                return '';
            };

            const validatePassword = () => {
                if (passwordInput.value === '') return 'Password is required.';
                return '';
            };

            form.addEventListener("submit", function(e) {
                const errors = [
                    validateField(emailInput, validateEmail),
                    validateField(passwordInput, validatePassword)
                ].filter(Boolean); // Filter out empty strings

                if (errors.length > 0) {
                    e.preventDefault();
                    errors.forEach(error => showNotification(error));
                }
            });
        });
    </script>
</body>

</html>