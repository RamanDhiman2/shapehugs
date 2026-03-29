<?php
include('../../db_config.php');

$current_page = basename($_SERVER['PHP_SELF']);
session_start();

if (isset($_POST['save'])) {
    $store = $_POST['storeName'];
    $email = $_POST['ContactEmail'];
    $opt = $_POST['cur'];
    $Ship = $_POST['freeShip'];
    $tax = $_POST['tax'];
    $update = "UPDATE `tb_settings` SET `storeName` = '$store' , `contactEmail` = '$email' , `currency` = '$opt' , `free_ship` = '$Ship' , `tax_rate` = '$tax' ";
    // echo "<pre>";print_r($update);die;
    $res1 = mysqli_query($con, $update);
    if ($res1) {
        echo "<script>
            alert('Updated Successfully');
        </script>";
    } else {
        echo "<script>
            alert('Not Updated');
        </script>";
    }
}else{
    session_destroy(); 
}

include("../../db_config.php");

$sel = "SELECT * FROM `tb_settings`";
$res = mysqli_query($con, $sel);

if ($res) {
    $data = mysqli_fetch_assoc($res);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Shapehugs Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        .content-card {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            max-width: 800px;
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
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-family: inherit;
        }

        .section-heading {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            font-size: 18px;
            font-weight: 600;
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
                <h1 class="serif" style="font-size: 28px; margin: 0;">Settings</h1>
            </div>
            <form method="POST"> 
            <button class="btn-primary" style="padding: 12px 25px;" name="save">Save Changes</button>
        </div>

        <div class="content-card">
                <h3 class="section-heading serif">General Information</h3>
                <div class="form-group">
                    <label>Store Name</label>
                    <input type="text" value="<?= $data['storeName'] ?>" name="storeName">
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="email" value="<?= $data['contactEmail'] ?>" name="ContactEmail">
                </div>
                <div class="form-group">
                    <label>Currency</label>
                    <select name="cur">
                        <option name="cur" value="USD" <?php if ($data['currency'] == "USD") {
                                                            echo "selected";
                                                        } ?>>USD ($)</option>
                        <option name="cur" value="EUR" <?php if ($data['currency'] == "EUR") {
                                                            echo "selected";
                                                        } ?>>EUR (€)</option>
                        <option name="cur" value="INR" <?php if ($data['currency'] == "INR") {
                                                            echo "selected";
                                                        } ?>>INR (₹)</option>
                    </select>
                </div>

                <h3 class="section-heading serif" style="margin-top: 40px;">Shipping & Payments</h3>
                <div class="form-group">
                    <label>Free Shipping Threshold</label>
                    <input type="number" name="freeShip" value="<?= $data['free_ship'] ?>">
                </div>
                <div class="form-group">
                    <label>Tax Rate (%)</label>
                    <input type="number" name="tax" value="<?= $data['tax_rate'] ?>">
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        // Dropdown Toggle Logic
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = toggle.parentElement;
                const menu = parent.querySelector('.dropdown-menu');
                const icon = toggle.querySelector('.fa-chevron-down');

                if (menu.style.display === 'flex') {
                    menu.style.display = 'none';
                    gsap.to(icon, {
                        rotation: 0,
                        duration: 0.3
                    });
                } else {
                    menu.style.display = 'flex';
                    gsap.from(menu.querySelectorAll('li'), {
                        y: -5,
                        opacity: 0,
                        duration: 0.3,
                        stagger: 0.05
                    });
                    gsap.to(icon, {
                        rotation: 180,
                        duration: 0.3
                    });
                }
            });
        });

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