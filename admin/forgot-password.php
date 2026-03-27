<?php
include('..\db_config.php');
session_start();
$match = false;
if (isset($_POST['Check'])) {
    $email = $_POST['email'];
    $check_em = "Select id , email from tb_admin where `email` = '$email'";
    $result_em = mysqli_query($con, $check_em);
    if (mysqli_num_rows($result_em) > 0) {
        $match = true;
        $row = mysqli_fetch_assoc($result_em); 
        $_SESSION['email'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}

if (isset($_POST['Update'])) {
    $ps  = md5($_POST['ps']);
    $cps = md5($_POST['cps']);
    $id  = $_SESSION['admin_id'];
    $update_pass = "UPDATE tb_admin SET `password` = '$ps', `confirm_password` = '$cps' WHERE `id` = '$id'";
    $result_up = mysqli_query($con, $update_pass);

    if ($result_up) {


        session_destroy();
        header("location: ../admin/index.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Shapehugs</title>
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
            margin-bottom: 20px;
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
            <h1 class="serif">Reset Password</h1>
            <p class="text-muted small text-uppercase letter-spacing-1">Enter your email to receive instructions</p>
        </div>

        <div class="account-card">
            <form method="POST">
                <?php
                if ($match == false) {
                ?>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="em" name="email" placeholder="admin@shapehugs.com">
                        <span class="error-message"></span>
                    </div>

                    <button type="submit" class="btn-primary" name="Check" style="width: 100%;">Check Your Account</button>
                <?php } else { ?>
                    <p><b>Your Email : </b><?= $email_Sec = $_SESSION['email'] = $email; ?></p>
                    <br>
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

                        <button class="btn-primary" name="Update" style="width: 100%;">Update the Password</button>
                    <?php } ?>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="index.php" style="font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px; color: var(--muted-text); text-decoration: none;">Cancel</a>
                    </div>
            </form>
            <div class="auth-footer">
                <p>Remember your credentials? <a href="index.php">Back to Login</a></p>
            </div>
        </div>

    </div>

</body>
<Script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form'); // Select the form
        const emailInput = document.getElementById("em"); // Correct ID for email input
        const passwordInput = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");

        // Helper functions for showing/hiding errors
        const showError = (input, message) => {
            const formGroup = input.closest('.form-group');
            const error = formGroup.querySelector('.error-message');
            if (error) {
                error.style.display = 'block';
                error.innerText = message;
            }
            input.classList.add('invalid');
        };

        const hideError = (input) => {
            const formGroup = input.closest('.form-group');
            const error = formGroup.querySelector('.error-message');
            if (error) {
                error.style.display = 'none';
                error.innerText = '';
            }
            input.classList.remove('invalid');
        };

        const validateEmail = () => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput && emailInput.value.trim() === '') {
                showError(emailInput, 'Email is required.');
                return false;
            } else if (emailInput && !emailRegex.test(emailInput.value.trim())) {
                showError(emailInput, 'Please enter a valid email address.');
                return false;
            }
            if (emailInput) hideError(emailInput);
            return true;
        };
        const validatePassword = () => {
            if (passwordInput && passwordInput.value.length < 8) {
                showError(passwordInput, 'Password must be at least 8 characters long.');
                return false;
            }
            if (passwordInput) hideError(passwordInput);
            return true;
        };

        const validateConfirmPassword = () => {
            if (confirmPassword && confirmPassword.value === '') {
                showError(confirmPassword, 'Please confirm your password.');
                return false;
            } else if (passwordInput && confirmPassword && passwordInput.value !== confirmPassword.value) {
                showError(confirmPassword, 'Passwords do not match.');
                return false;
            }
            if (confirmPassword) hideError(confirmPassword);
            return true;
        };

        // Event listeners for live validation (only if elements exist)
        if (emailInput) emailInput.addEventListener('input', validateEmail);
        if (passwordInput) passwordInput.addEventListener('input', () => {
            validatePassword();
            if (confirmPassword.value.length > 0) validateConfirmPassword();
        });
        if (confirmPassword) confirmPassword.addEventListener('input', validateConfirmPassword);

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
            // Determine which form is being submitted based on the button name
            if (e.submitter && e.submitter.name === 'Check') {
                const isEmailValid = validateEmail();
                if (!isEmailValid) {
                    e.preventDefault();
                }
            } else if (e.submitter && e.submitter.name === 'Update') {
                const isPasswordValid = validatePassword();
                const isConfirmPasswordValid = validateConfirmPassword();
                if (!isPasswordValid || !isConfirmPasswordValid) {
                    e.preventDefault();
                }
            }
        });
    });
</Script>

</html>