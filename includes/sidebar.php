<?php
/**
 * Shapehugs - Admin Sidebar
 *
 * Expects $currentPage (e.g. 'dashboard', 'products') to highlight the active menu item.
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config/config.php';
}

$siteUrl     = htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8');
$currentPage = isset($currentPage) ? $currentPage : '';

$menuItems = [
    ['slug' => 'dashboard',  'label' => 'Dashboard',   'icon' => 'fas fa-tachometer-alt', 'href' => $siteUrl . 'admin/pages/dashboard.php'],
    ['slug' => 'products',   'label' => 'Products',    'icon' => 'fas fa-box-open',       'href' => $siteUrl . 'admin/pages/products.php'],
    ['slug' => 'orders',     'label' => 'Orders',      'icon' => 'fas fa-shopping-bag',   'href' => $siteUrl . 'admin/pages/orders.php'],
    ['slug' => 'customers',  'label' => 'Customers',   'icon' => 'fas fa-users',          'href' => $siteUrl . 'admin/pages/customers.php'],
    ['slug' => 'categories', 'label' => 'Categories',  'icon' => 'fas fa-tags',           'href' => $siteUrl . 'admin/pages/categories.php'],
    ['slug' => 'inbox',      'label' => 'Messages',    'icon' => 'fas fa-envelope',       'href' => $siteUrl . 'admin/pages/inbox.php'],
    ['slug' => 'settings',   'label' => 'Settings',    'icon' => 'fas fa-cog',            'href' => $siteUrl . 'admin/pages/settings.php'],
];
?>

<!-- Mobile sidebar toggle -->
<button class="admin-sidebar-toggle" id="adminSidebarToggle" aria-label="Toggle sidebar"
        style="display:none;position:fixed;top:14px;left:14px;z-index:6000;background:#000;color:#fff;border:none;width:40px;height:40px;border-radius:8px;font-size:18px;cursor:pointer;">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay for mobile -->
<div class="admin-sidebar-overlay" id="adminSidebarOverlay"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:4999;"></div>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar"
       style="position:fixed;top:0;left:0;width:250px;height:100%;background:#000;color:#fff;display:flex;flex-direction:column;z-index:5000;font-family:'Inter',sans-serif;transition:left 0.3s ease;">

    <!-- Logo -->
    <div style="padding:28px 24px 20px;border-bottom:1px solid #222;">
        <a href="<?php echo $siteUrl; ?>admin/pages/dashboard.php"
           style="font-family:'Outfit',sans-serif;font-weight:700;font-size:20px;color:#fff;text-decoration:none;letter-spacing:1.5px;text-transform:uppercase;">
            Shapehugs <span style="font-size:11px;font-weight:400;opacity:0.6;display:block;margin-top:2px;letter-spacing:0.5px;">Admin Panel</span>
        </a>
    </div>

    <!-- Menu -->
    <nav style="flex:1;overflow-y:auto;padding:16px 0;">
        <?php foreach ($menuItems as $item): ?>
            <?php $isActive = ($currentPage === $item['slug']); ?>
            <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
               style="display:flex;align-items:center;gap:14px;padding:12px 24px;color:<?php echo $isActive ? '#fff' : '#aaa'; ?>;text-decoration:none;font-size:14px;background:<?php echo $isActive ? '#1a1a1a' : 'transparent'; ?>;border-left:<?php echo $isActive ? '3px solid #fff' : '3px solid transparent'; ?>;transition:all 0.2s ease;">
                <i class="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>" style="width:20px;text-align:center;font-size:15px;"></i>
                <span><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <!-- Logout -->
    <div style="border-top:1px solid #222;padding:16px 24px;">
        <a href="<?php echo $siteUrl; ?>user/pages/login.php?logout=1"
           style="display:flex;align-items:center;gap:14px;color:#aaa;text-decoration:none;font-size:14px;">
            <i class="fas fa-sign-out-alt" style="width:20px;text-align:center;font-size:15px;"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>

<!-- Sidebar toggle script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggle  = document.getElementById('adminSidebarToggle');
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('adminSidebarOverlay');

    function openSidebar()  { sidebar.style.left = '0'; overlay.style.display = 'block'; }
    function closeSidebar() { sidebar.style.left = '-250px'; overlay.style.display = 'none'; }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);
});
</script>
