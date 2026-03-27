<?php
include('../../db_config.php');
session_start();
$f = false;
$select = "SELECT * FROM `tb_admin`";
$result = mysqli_query($con, $select);
if ($result) {
    $f = true;
    $fetch = mysqli_fetch_assoc($result);
    // print_r( $fetch);
} else {
    echo "<script>
            alert('Connection Lost');
        </script>";
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Shapehugs Admin</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        :root {
            --sidebar-width: 260px;
        }

        body {
            background-color: #fbf9f7;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid var(--border-color);
            padding: 30px;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            font-size: 24px;
            letter-spacing: 4px;
            font-weight: 700;
            margin-bottom: 50px;
            color: var(--text-color);
            display: block;
            text-align: center;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            color: var(--muted-text);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-item a:hover,
        .nav-item a.active {
            background: #fbf9f7;
            color: var(--accent-color);
        }

        .nav-item a i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 40px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .account-card {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 1px;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
        }

        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
            resize: vertical;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            display: none;
            flex-direction: column;
            gap: 2px;
            margin-top: 5px;
            padding-left: 0;
        }

        .dropdown-menu li a {
            padding: 8px 15px 8px 50px !important;
            font-size: 13px;
            font-weight: 400;
            background: transparent !important;
        }

        .dropdown-menu li a:hover {
            color: var(--accent-color) !important;
            transform: translateX(5px);
        }

        

    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <div style="display: flex; align-items: center; gap: 15px;">
                <i class="fa-solid fa-bars d-lg-none" id="mobile-menu-btn" style="font-size: 24px; cursor: pointer;"></i>
                <div>
                    <h1 class="serif" style="font-size: 28px; margin: 0;">My Profile</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1" style="margin: 0;">Manage your administrator profile</p>
                </div>
            </div>
            <a href="profile-edit.php?updateprofile=<?= $fetch['id']; ?>" class="btn-primary">Edit Profile</a>
        </div>

        <div class="account-card" style="max-width: 800px;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 40px;">
                <div class="user-avatar" style="width: 80px; height: 80px; font-size: 28px; background-color: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">JD</div>
                <div>
                    <h3 class="serif" style="font-size: 24px; margin-bottom: 5px;"><?= ucfirst($fetch['first_name']) ?></h3>
                    <p class="text-muted">Admin</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="text-muted">Full Name</label>
                    <p><?= ucfirst($fetch['first_name']) . " " . ucfirst($fetch['last_name']) ?></p>
                </div>
                <div class="form-group">
                    <label class="text-muted">Email Address</label>
                    <p><?= $fetch['email'] ?></p>
                </div>
            </div>

            <div class="form-group" style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <label class="text-muted">Last Login</label>
                <p class="small text-muted">
                    <?php
                    if ($_SESSION['last_login']) {
                        echo $_SESSION['last_login'];
                    }
                    ?>
                </p>
            </div>
        </div>
    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script>
        // Mobile Menu Logic
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar') || document.querySelector('.admin-sidebar');
        if (sidebar && mobileBtn) {
            const overlay = document.createElement('div');
            overlay.className = 'admin-sidebar-overlay';
            document.body.appendChild(overlay);

            const closeBtn = document.createElement('i');
            closeBtn.className = 'fa-solid fa-xmark d-lg-none';
            closeBtn.style.cssText = 'position: absolute; top: 30px; right: 30px; font-size: 24px; cursor: pointer; color: var(--text-color); transition: 0.3s;';
            sidebar.appendChild(closeBtn);

            const openMenu = () => {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            };
            const closeMenu = () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            mobileBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);
        }

        

    </script>
</body>

</html>