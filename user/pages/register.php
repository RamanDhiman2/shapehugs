<?php
include('../../db_config.php');
session_start();
if (isset($_POST['submit'])) {
    $fs = $_POST['fs'];
    $ls = $_POST['ls'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ps = md5($_POST['ps']);
    $cps = md5($_POST['cps']);
    $gen = $_POST['gen'];
    // echo $gen;die;
    $address = $_POST['address'];
    $CTime = date('D/M/Y/T');
    $select = "SELECT * FROM `tb_users` where `Email` = '$email' OR `phone` = '$phone'";
    $res = mysqli_query($con, $select);
    $data = mysqli_fetch_assoc($res);
    if ($row = mysqli_num_rows($res) > 0) {
        if ($email == $data['Email']) {
            echo "<script>alert('Email already in Use')</script>";
        }
        if ($phone == $data['phone']) {
            echo "<script>alert('PhoneNumber already in Use')</script>";
        }
    } elseif (!$ps == $cps) {
        echo "<script>alert('Password don't Match)</script>";
    } else {
        $ins = "INSERT INTO `tb_users`(`firstName`, `lastName`, `Email`, `Password`, `confirmPassword`, `phone`, `address`, `Gender`, `CreateTime` , `activity`) VALUES('$fs','$ls','$email','$ps','$cps','$phone','$address','$gen' , '$CTime' , '1')";
        $res2 = mysqli_query($con, $ins);
        if ($res2) {
            $_SESSION['Registor_Account'] = "<script>alert('Account Created WOW! Now Login')</script>";
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
    <title>Create Account | Shapehugs</title>
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
            max-width: 650px;
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

        .form-group input.invalid,
        .form-group select.invalid,
        .form-group textarea.invalid {
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
                <h2 class="serif">Create Account</h2>
                <p>Join Shapehugs for an exclusive shopping experience</p>
            </div>
            <form method="POST" id="registerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="First name" name="fs" id="firstName">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last name" name="ls" id="lastName">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter your email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter your Phone Number" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Create a password" name="ps" id="password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" placeholder="Confirm the password" name="cps" id="confirmPassword">
                </div>
                <div class="form-group">
                    <label>Enter your Gender</label>
                    <select name="gen" id="gender">
                        <option disabled selected value="">Select the option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Enter your Address</label>
                    <textarea name="address" id="address" style="width: 100%; height: 70px; border:0.1px solid grey;"></textarea>
                </div>
                <button type="submit" class="auth-btn" name="submit">Create Account</button>
            </form>
            <div class="auth-links">
                Already have an account? <a href="login.php">Sign In</a>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const firstNameInput = document.getElementById('firstName');
            const lastNameInput = document.getElementById('lastName');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const genderSelect = document.getElementById('gender');

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

            const validateFirstName = () => {
                const nameRegex = /^[a-zA-Z\s'-]+$/;
                if (firstNameInput.value.trim() === '') return 'First name is required.';
                if (!nameRegex.test(firstNameInput.value.trim())) return 'First name is not valid.';
                return '';
            };

            const validateLastName = () => {
                const nameRegex = /^[a-zA-Z\s'-]+$/;
                if (lastNameInput.value.trim() === '') return 'Last name is required.';
                if (!nameRegex.test(lastNameInput.value.trim())) return 'Last name is not valid.';
                return '';
            };

            const validateEmail = () => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailInput.value.trim() === '') return 'Email is required.';
                if (!emailRegex.test(emailInput.value.trim())) return 'Please enter a valid email address.';
                return '';
            };

            const validatePhone = () => {
                const phoneRegex = /^\+?[\d\s-]{7,15}$/;
                if (phoneInput.value.trim() === '') return 'Phone number is required.';
                if (!phoneRegex.test(phoneInput.value.trim())) return 'Please enter a valid phone number.';
                return '';
            };

            const validatePassword = () => {
                if (passwordInput.value === '') return 'Password is required.';
                if (passwordInput.value.length < 8) return 'Password must be at least 8 characters long.';
                return '';
            };

            const validateConfirmPassword = () => {
                if (confirmPasswordInput.value === '') return 'Please confirm your password.';
                if (confirmPasswordInput.value !== passwordInput.value) return 'Passwords do not match.';
                return '';
            };

            const validateGender = () => {
                if (genderSelect.value === '') return 'Please select your gender.';
                return '';
            };

            form.addEventListener("submit", function(e) {
                const errors = [
                    validateField(firstNameInput, validateFirstName),
                    validateField(lastNameInput, validateLastName),
                    validateField(emailInput, validateEmail),
                    validateField(phoneInput, validatePhone),
                    validateField(passwordInput, validatePassword),
                    validateField(confirmPasswordInput, validateConfirmPassword),
                    validateField(genderSelect, validateGender)
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