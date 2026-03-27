<?php
include('..\db_config.php');
session_start();

if (isset($_POST['Crate'])) {
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $em = $_POST['em'];
    $ps = md5($_POST['ps']);
    $cps = md5($_POST['cps']);

    $check_em = "Select * from tb_admin where email = '$em'";
    $result_em = mysqli_query($con, $check_em);
    $insert = "INSERT into `tb_admin`( first_name , last_name , email , `password` , confirm_password , remember_me ) VALUES('$fn' , '$ln' , '$em' , '$ps' , '$cps' , '0')";
    if (mysqli_num_rows($result_em) > 0) {
        header("location: register.php");
        echo "<script>
        alert('Account Already Exists')
        </script>"; 
    } else {
        $result = mysqli_query($con, $insert);
        header("location: index.php");
        echo "<script>
            alert('Account Created');
        </script>";
        $_SESSION['name'] = $_POST['fn'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration | Shapehugs</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS (Reused) -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #fbf9f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 0;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--muted-text);
        }

        .auth-footer a {
            color: var(--text-color);
            font-weight: 600;
            text-decoration: underline;
            transition: var(--transition);
        }

        .auth-footer a:hover {
            color: var(--accent-color);
        }

        .error-message {
            color: #d9534f;
            font-size: 12px;
            display: none;
            margin-top: 5px;
        }

        .form-group input.invalid {
            border-color: #d9534f !important;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            padding-right: 40px;
        }

        .input-wrapper .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--muted-text);
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-header">
            <h1 class="serif">Create Admin Account</h1>
        </div>

        <div class="account-card">
            <form method="POST" id="frm" name="frm">
                <div class="form-row" style="margin-bottom: 0; gap: 20px;">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fn" placeholder="Jane">
                        <span class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="ln" placeholder="Doe">
                        <span class="error-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Work Email</label>
                    <input type="email" id="email" name="em" placeholder="name@shapehugs.com">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="ps" placeholder="Minimum 8 characters">
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="confirm_password" name="cps" placeholder="Retype Password">
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                    <span class="error-message"></span>
                </div>

                <button type="submit" class="btn-primary" name="Crate" id="submit" style="width: 100%;">Create Account</button>
            </form>
        </div>

        <div class="auth-footer">
            <p>Already have access? <a href="index.php">Login Here</a></p>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById("frm");
        const fname = document.getElementById("fname");
        const lname = document.getElementById("lname");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        const validateFname = () => {
            if (fname.value.trim() === '') {
                alert('First Name is required.');
                return false;
            }
            return true;
        };
        const validateLname = () => {
            if (lname.value.trim() === '') {
                alert('Last Name is required.');
                return false;
            }
            return true;
        };
        const validateEmail = () => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() === '') {
                alert('Email is required.');
                return false;
            } else if (!emailRegex.test(email.value.trim())) {
                alert('Please enter a valid email address.');
                return false;
            }
            return true;
        };
        const validatePassword = () => {
            if (password.value.length < 8) {
                alert('Password must be at least 8 characters long.');
                return false;
            }
            return true;
        };
        const validateConfirmPassword = () => {
            if (confirmPassword.value === '') {
                alert('Please confirm your password.');
                return false;
            } else if (password.value !== confirmPassword.value) {
                alert('Passwords do not match.');
                return false;
            }
            return true;
        };
        fname.addEventListener('input', validateFname);
        lname.addEventListener('input', validateLname);
        email.addEventListener('input', validateEmail);
        password.addEventListener('input', () => {
            validatePassword();
            if (confirmPassword.value.length > 0) validateConfirmPassword();
        });
        confirmPassword.addEventListener('input', validateConfirmPassword);

        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const isPassword = input.getAttribute('type') === 'password';

                input.setAttribute('type', isPassword ? 'text' : 'password');

                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        form.addEventListener("submit", function(e) {
            const isFnameValid = validateFname();
            const isLnameValid = validateLname();
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();

            if (!isFnameValid || !isLnameValid || !isEmailValid || !isPasswordValid || !isConfirmPasswordValid) {
                e.preventDefault();
            }
        });
    });
</script>

</html>