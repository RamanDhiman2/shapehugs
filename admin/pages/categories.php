<?php
session_start();
include('../../db_config.php');
$sel = "SELECT * FROM `tb_categories`";
$res = mysqli_query($con, $sel);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Shapehugs Admin</title>
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

        .cat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .cat-card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .cat-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .cat-info {
            padding: 20px;
        }

        .cat-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            display: none;
        }

        .cat-card:hover .cat-actions {
            display: block;
        }

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



        .cat-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        .cat-table th,
        .cat-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .cat-table th {
            background: #f5f5f5;
            font-weight: 600;
            font-size: 14px;
        }

        .cat-table tr:hover {
            background: #fafafa;
        }

        .table-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
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
                <h1 class="serif" style="font-size: 28px; margin: 0;">Categories</h1>
            </div>
            <a href="add-category.php" class="btn-primary" style="padding: 12px 25px;">+ New Category</a>
        </div>
        <div class="cat-grid">
            <?php
            if ($res && mysqli_num_rows($res) > 0) {
            ?>
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?>
                            </td>

                                <td>
                                    <img src="../../uploads/<?php echo $row['image']; ?>" class="table-img">
                                </td>

                                <td><?php echo $row['name']; ?></td>

                                <td><?php echo $row['description']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<h3>No Data Found</h3>";
            }
            ?>
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