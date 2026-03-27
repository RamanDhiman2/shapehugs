<?php
$current_page = basename($_SERVER['PHP_SELF']);

   include("../../db_config.php");

   $sel = "SELECT * FROM `tb_settings`";
   $res = mysqli_query($con , $sel);

   if($res){
      $data = mysqli_fetch_assoc($res);

   }

?>
<aside class="sidebar">
    <a href="../index.php" class="sidebar-logo serif"><?= $data['storeName'] ?></a>
    <ul class="nav-list">
        <li class="nav-item"><a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
        <li class="nav-item">
            <a href="products.php" class="dropdown-toggle <?php echo in_array($current_page, ['products.php', 'draft-products.php', 'published-products.php', 'add-product.php', 'product-view.php', 'product-edit.php']) ? 'active' : ''; ?>" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 15px;"><i class="fa-solid fa-box-open"></i> Products</div>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="draft-products.php" <?php echo $current_page == 'draft-products.php' ? 'style="color: var(--accent-color);"' : ''; ?>>Draft Products</a></li>
                <li><a href="published-products.php" <?php echo $current_page == 'published-products.php' ? 'style="color: var(--accent-color);"' : ''; ?>>Published Products</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="dropdown-toggle <?php echo in_array($current_page, ['categories.php', 'add-category.php']) ? 'active' : ''; ?>" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </div>
                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="categories.php" class="<?php echo $current_page == 'categories.php' ? 'active' : ''; ?>">Manage Categories</a></li>
                <li><a href="products.php">Dresses</a></li>
                <li><a href="products.php">Tops</a></li>
                <li><a href="products.php">Bottoms</a></li>
                <li><a href="products.php">Accessories</a></li>
                <li><a href="products.php">New In</a></li>
                <li><a href="products.php">Sale</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="orders.php" class="<?php echo in_array($current_page, ['orders.php', 'order-view.php']) ? 'active' : ''; ?>"><i class="fa-solid fa-cart-shopping"></i> Orders</a></li>
        <li class="nav-item"><a href="customers.php" class="<?php echo $current_page == 'customers.php' ? 'active' : ''; ?>"><i class="fa-solid fa-users"></i> Customers</a></li>
        <li class="nav-item"><a href="inbox.php" class="<?php echo $current_page == 'inbox.php' ? 'active' : ''; ?>"><i class="fa-solid fa-envelope"></i> Inbox</a></li>
        <li class="nav-item"><a href="faqs.php" class="<?php echo in_array($current_page, ['faqs.php', 'add-faq.php', 'edit-faq.php']) ? 'active' : ''; ?>"><i class="fa-solid fa-circle-question"></i> FAQs</a></li>
        <li class="nav-item"><a href="content.php" class="<?php echo in_array($current_page, ['content.php', 'edit-content.php']) ? 'active' : ''; ?>"><i class="fa-solid fa-file-lines"></i> Content</a></li>
        <li class="nav-item"><a href="lookbook.php" class="<?php echo $current_page == 'lookbook.php' ? 'active' : ''; ?>"><i class="fa-regular fa-image"></i> Lookbook</a></li>
        <li class="nav-item"><a href="settings.php" class="<?php echo $current_page == 'settings.php' ? 'active' : ''; ?>"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
    <div style="margin-top: auto;">
        <a href="profile.php" class="<?php echo in_array($current_page, ['profile.php', 'profile-edit.php']) ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 12px; padding: 15px; text-decoration: none; border-top: 1px solid var(--border-color); margin-top: 10px; <?php echo in_array($current_page, ['profile.php', 'profile-edit.php']) ? 'background: #fbf9f7; color: var(--accent-color);' : ''; ?>">
            <div class="user-avatar" style="width: 32px; height: 32px; font-size: 12px; min-width: 32px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">JD</div>
            <div>
                <div style="font-weight: 600; font-size: 13px; color: var(--text-color);">Jane Doe</div>
                <div style="font-size: 11px; color: var(--muted-text);">Super Admin</div>
            </div>
        </a>
        <div class="nav-item">
            <a href="../index.php" style="color: #d10000; padding: 12px 15px; display: flex; align-items: center; gap: 15px; font-size: 14px; font-weight: 500; text-decoration: none;"><i class="fa-solid fa-arrow-right-from-bracket" style="width: 20px; text-align: center;"></i> Logout</a>
        </div>
    </div>
</aside>