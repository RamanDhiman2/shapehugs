<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ | Shapehugs Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
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
        .account-card { background: #fff; padding: 40px; border-radius: 8px; border: 1px solid var(--border-color); max-width: 800px; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-size: 12px; text-transform: uppercase; font-weight: 700; margin-bottom: 8px; letter-spacing: 1px; color: var(--text-color); }
        .form-group input, .form-group select { width: 100%; padding: 15px; border: 1px solid var(--border-color); border-radius: 4px; font-family: inherit; font-size: 14px; }
        .form-group textarea { width: 100%; padding: 15px; border: 1px solid var(--border-color); border-radius: 4px; font-family: inherit; font-size: 14px; resize: vertical; }

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
                <div>
                    <h1 class="serif" style="font-size: 28px; margin: 0;">Edit FAQ</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1" style="margin: 0;">Update frequently asked question</p>
                </div>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="faqs.php" class="btn-primary" style="background: transparent; color: var(--text-color); border: 1px solid var(--border-color); padding: 12px 25px;">Cancel</a>
                <button type="submit" form="faq-form" class="btn-primary" style="padding: 12px 25px;">Save Changes</button>
            </div>
        </div>

        <div class="account-card">
            <form id="faq-form" action="faqs.php">
                <div class="form-group">
                    <label for="f-question">Question</label>
                    <input type="text" id="f-question" value="How can I track my order?" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="f-category">Category</label>
                        <select id="f-category">
                            <option value="general">General</option>
                            <option value="shipping" selected>Shipping & Delivery</option>
                            <option value="returns">Returns & Exchanges</option>
                            <option value="products">Product & Sizing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="f-status">Status</label>
                        <select id="f-status">
                            <option value="active" selected>Active</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="f-answer">Answer</label>
                    <textarea id="f-answer" rows="6">Once your order is shipped, you will receive an email with a tracking number and a link to track your package's progress. You can also view your order status in your account dashboard.</textarea>
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
                    gsap.to(icon, { rotation: 0, duration: 0.3 });
                } else {
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

            const openMenu = () => { sidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; };
            const closeMenu = () => { sidebar.classList.remove('active'); overlay.classList.remove('active'); document.body.style.overflow = ''; };

            mobileBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);
        }
    </script>
</body>
</html>