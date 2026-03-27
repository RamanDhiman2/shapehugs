<?php
include('../db_config.php');

session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $remember = $_POST['reme'];

    $check = "Select * from tb_admin where email = '$email' and password = '$password'";
    $rememeber = "Select * from tb_admin where remember = '$remember'";
    $result = mysqli_query($con, $check);

    if ($row = mysqli_num_rows($result) > 0) {
        header("location: pages/dashboard.php");
        $row = mysqli_fetch_assoc($result);
        $rem = $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $id = $row['id'];
        $now = date('Y-m-d H:i:s');

        $update = "UPDATE tb_admin SET last_login = '$now' WHERE id = '$id'";
        mysqli_query($con, $update);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['last_login'] = $now;
    } elseif ($remember == '1') {
        $_SESSION['email'] = $email;
    } else {
        header("location: index.php");
        echo "<script>
            alert('Invalid Credentials');
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Shapehugs</title>
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
        }

        .auth-wrapper {
            width: 100%;
            max-width: 450px;
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

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-color);
            cursor: pointer;
        }

        .form-check input {
            width: auto;
            margin: 0;
            cursor: pointer;
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
            <h1 class="serif">Shapehugs Admin</h1>
            <p class="text-muted small text-uppercase letter-spacing-1">Secure Dashboard Access</p>
        </div>

        <div class="account-card">
            <form method="POST" name="frm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="admin@shapehugs.com">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••">
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                    <span class="error-message"></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <label class="form-check">
                        <input type="checkbox" name="reme"> Remember me
                    </label>
                    <a href="forgot-password.php" style="font-size: 12px; color: var(--muted-text);">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;" name="submit">Sign In</button>
            </form>
        </div>

        <div class="auth-footer">
            <p>New staff member? <a href="register.php">Request Access</a></p>
            <p style="margin-top: 20px;"><a href="../index.php" style="text-decoration: none; font-size: 12px;"><i class="fa-solid fa-arrow-left"></i> Return to Shop</a></p>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[name="frm"]');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

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
            if (emailInput.value.trim() === '') {
                showError(emailInput, 'Email is required.');
                return false;
            } else if (!emailRegex.test(emailInput.value.trim())) {
                showError(emailInput, 'Please enter a valid email address.');
                return false;
            }
            hideError(emailInput);
            return true;
        };

        const validatePassword = () => {
            if (passwordInput.value === '') {
                showError(passwordInput, 'Password is required.');
                return false;
            }
            hideError(passwordInput);
            return true;
        };

        // Live validation on input
        emailInput.addEventListener('input', () => {
            // Only show live error if it's invalid, otherwise hide if valid
            if (emailInput.value.trim() === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
                validateEmail(); // Re-validate to show/update error
            } else {
                hideError(emailInput);
            }
        });
        passwordInput.addEventListener('input', () => {
            if (passwordInput.value === '') {
                hideError(passwordInput); // Hide error if user starts typing after an empty field error
            } else {
                hideError(passwordInput);
            }
        });

        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Form submission validation
        form.addEventListener("submit", function(e) {
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            if (!isEmailValid || !isPasswordValid) {
                e.preventDefault();
            }
        });
    });
</script>

</html>