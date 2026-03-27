<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft Products | Shapehugs Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* Reusing Admin Styles */
        :root { --sidebar-width: 260px; }
        body { background-color: #fbf9f7; display: flex; min-height: 100vh; overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); background: #fff; height: 100vh; position: fixed; left: 0; top: 0; border-right: 1px solid var(--border-color); padding: 30px; z-index: 100; display: flex; flex-direction: column; }
        .sidebar-logo { font-size: 24px; letter-spacing: 4px; font-weight: 700; margin-bottom: 50px; color: var(--text-color); display: block; text-align: center; }
        .nav-list { display: flex; flex-direction: column; gap: 10px; flex: 1; }
        .nav-item a { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: var(--muted-text); border-radius: 4px; font-size: 14px; font-weight: 500; transition: var(--transition); }
        .nav-item a:hover, .nav-item a.active { background: #fbf9f7; color: var(--accent-color); }
        .nav-item a i { width: 20px; text-align: center; }
        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 40px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .content-card { background: #fff; padding: 30px; border-radius: 8px; border: 1px solid var(--border-color); }
        .table-responsive { overflow-x: auto; }
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th { text-align: left; padding: 15px; border-bottom: 1px solid var(--border-color); font-size: 12px; text-transform: uppercase; color: var(--muted-text); font-weight: 600; }
        .admin-table td { padding: 15px; border-bottom: 1px solid var(--border-color); vertical-align: middle; font-size: 14px; }
        .product-thumb { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; margin-right: 15px; }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 11px; text-transform: uppercase; font-weight: 600; }
        .status-active { background: #e8f5e9; color: #2e7d32; }
        .status-draft { background: #eceff1; color: #546e7a; }
        /* Dropdown Styles */
        .dropdown-menu { display: none; flex-direction: column; gap: 2px; margin-top: 5px; padding-left: 0; }
        .dropdown-menu li a { padding: 8px 15px 8px 50px !important; font-size: 13px; font-weight: 400; background: transparent !important; }
        .dropdown-menu li a:hover { color: var(--accent-color) !important; transform: translateX(5px); }
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
                <h1 class="serif" style="font-size: 28px; margin: 0;">Draft Products</h1>
            </div>
            <a href="add-product.php" class="btn-primary" style="padding: 12px 25px;">+ Add Product</a>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <td style="display: flex; align-items: center;">
                                <a href="product-view.php"><img src="../../assets/images/p3.png" alt="Product" class="product-thumb"></a>
                                <div><a href="product-view.php" style="color: inherit; text-decoration: none;"><span style="font-weight: 500;">Pleated Skirt</span></a><br><span style="font-size: 12px; color: var(--muted-text);">ID: #8394</span></div>
                            </td>
                            <td>Bottoms</td>
                            <td>$54.00</td>
                            <td>0</td>
                            <td><span class="status-badge status-draft">Out of Stock</span></td>
                            <td style="text-align: right;"><a href="product-edit.php"><i class="fa-solid fa-pen-to-square" style="cursor: pointer; margin-right: 10px; color: var(--text-color);"></i></a> <i class="fa-solid fa-trash" style="cursor: pointer; color: #d10000;"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        // Auto-expand Products Dropdown
        const productsToggle = document.querySelector('a[href="products.php"].dropdown-toggle');
        if (productsToggle) {
            const menu = productsToggle.parentElement.querySelector('.dropdown-menu');
            const icon = productsToggle.querySelector('.fa-chevron-down');
            if (menu) {
                menu.style.display = 'flex';
                if (icon) gsap.set(icon, { rotation: 180 });
            }
        }

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

            const openMenu = () => { sidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; };
            const closeMenu = () => { sidebar.classList.remove('active'); overlay.classList.remove('active'); document.body.style.overflow = ''; };

            mobileBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);
        }
    </script>
</body>
</html>