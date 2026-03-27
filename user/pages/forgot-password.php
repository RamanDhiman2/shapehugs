<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Shapehugs</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 60px 20px; background: var(--primary-bg); }
        .auth-card { background: #fff; width: 100%; max-width: 450px; padding: 50px 40px; border-radius: 8px; box-shadow: var(--shadow-soft); border: 1px solid var(--border-color); }
        .auth-header { text-align: center; margin-bottom: 30px; }
        .auth-header h2 { font-size: 28px; margin-bottom: 10px; }
        .auth-header p { color: var(--muted-text); font-size: 14px; }
        .auth-btn { width: 100%; padding: 15px; background: var(--text-color); color: #fff; border: none; font-size: 12px; text-transform: uppercase; font-weight: 700; letter-spacing: 2px; cursor: pointer; border-radius: 4px; transition: var(--transition); margin-top: 10px; }
        .auth-btn:hover { background: var(--accent-color); }
        .auth-links { margin-top: 25px; text-align: center; font-size: 13px; color: var(--muted-text); }
        .auth-links a { color: var(--text-color); font-weight: 600; text-decoration: underline; }
        .auth-links a:hover { color: var(--accent-color); }
        @media (max-width: 576px) {
            .auth-card { padding: 40px 20px; border: none; box-shadow: none; }
            .auth-page { padding: 20px 0; }
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
                <h2 class="serif">Reset Password</h2>
                <p>Enter your email and we'll send you a link to reset your password.</p>
            </div>
            <form>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter your account email" required>
                </div>
                
                <button type="submit" class="auth-btn">Send Reset Link</button>
            </form>
            <div class="auth-links">
                <a href="login.php" style="text-decoration: none;"><i class="fa-solid fa-arrow-left me-2"></i> Back to Login</a>
            </div>
        </div>
    </main>

</body>

</html>