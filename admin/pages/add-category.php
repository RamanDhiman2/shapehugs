<?php
include('../../db_config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category | Shapehugs Admin</title>
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
            max-width: 800px;
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
                    <h1 class="serif" style="font-size: 28px; margin: 0;">Add New Category</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1" style="margin: 0;">Create a new product category</p>
                </div>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="categories.php" class="btn-primary" style="background: transparent; color: var(--text-color); border: 1px solid var(--border-color); padding: 12px 25px;">Cancel</a>
                <button type="submit" form="category-form" class="btn-primary" name="publish_category">Publish Category</button>
            </div>
        </div>

        <div class="account-card">
            <form id="category-form" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="parent-category">Parent Category (Optional)</label>
                    <select id="parent-category" name="parent_category">
                        <option value="">None (Top-Level Category)</option>
                        <!-- Static placeholder options for demonstration -->
                        <option value="1">Dresses</option>
                        <option value="2">Tops</option>
                        <option value="3">Bottoms</option>
                    </select>
                    <p class="small text-muted" style="margin-top: 5px;">Select an existing category to make this a sub-category.</p>
                </div>

            <form id="category-form" action="categories.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cat-name">Category Name</label>
                    <input type="text" id="cat-name" name="cat_name" value="" required placeholder="e.g. Dresses">
                </div>

                <div class="form-group">
                    <label for="cat-image">Category Image</label>
                    <input type="file" id="cat-image" name="cat_image" class="form-control" style="padding: 10px; background: #fbf9f7;">
                    <p class="small text-muted" style="margin-top: 5px;">Upload an image for the category thumbnail.</p>
                </div>

                <div class="form-group">
                    <label for="cat-status">Status</label>
                    <select id="cat-status" name="cat_status">
                        <option value="active" selected>Active</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Auto-expand Categories Dropdown
            const categoriesToggle = document.querySelector('.nav-item .dropdown-toggle.active');
            if (categoriesToggle) {
                const menu = categoriesToggle.parentElement.querySelector('.dropdown-menu');
                const icon = categoriesToggle.querySelector('.fa-chevron-down');
                if (menu) {
                    menu.style.display = 'flex';
                    if (icon) gsap.set(icon, { rotation: 180 });
                }
            }

            // Dropdown Toggle Logic
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const parent = toggle.parentElement;
                    const menu = parent.querySelector('.dropdown-menu');
                    const icon = toggle.querySelector('.fa-chevron-down');
                    if (menu.style.display === 'flex' && !toggle.classList.contains('active')) { // Only collapse if not the active one
                        menu.style.display = 'none';
                        gsap.to(icon, { rotation: 0, duration: 0.3 });
                    } else if (menu.style.display !== 'flex') { // Expand if not already expanded
                        menu.style.display = 'flex';
                        gsap.to(icon, { rotation: 180, duration: 0.3 });
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
        });
    </script>
</body>

</html>