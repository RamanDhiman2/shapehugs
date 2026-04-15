<?php
/**
 * Shapehugs - Navigation Bar (Announcement + Sticky Header + Mobile Menu + Search + Cart Drawer)
 *
 * Requires config/config.php (loaded automatically if SITE_URL is not yet defined).
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config/config.php';
}

$siteUrl   = htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8');
$cartCount = isset($_SESSION['cart']) ? (int) array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
?>

<!-- ========== Announcement Bar ========== -->
<div class="announcement-bar" style="background:#000;color:#fff;text-align:center;padding:10px 0;font-family:'Inter',sans-serif;font-size:12px;letter-spacing:1px;">
    FREE SHIPPING ON ORDERS OVER $99 &nbsp;|&nbsp; NEW SPRING ARRIVALS
</div>

<!-- ========== Sticky Header ========== -->
<header class="site-header" style="position:sticky;top:0;z-index:1000;background:rgba(255,255,255,0.85);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border-bottom:1px solid #eee;">
    <div class="header-inner" style="max-width:1400px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:12px 24px;">

        <!-- Left: hamburger (mobile) + search (desktop) -->
        <div class="header-left" style="display:flex;align-items:center;gap:16px;flex:1;">
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu"
                    style="display:none;background:none;border:none;font-size:22px;cursor:pointer;">
                <i class="fas fa-bars"></i>
            </button>
            <button class="search-trigger" id="searchTrigger" aria-label="Search"
                    style="background:none;border:none;font-size:18px;cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Center: Logo -->
        <div class="header-center" style="flex:1;text-align:center;">
            <a href="<?php echo $siteUrl; ?>index.php"
               style="font-family:'Outfit',sans-serif;font-weight:700;font-size:26px;color:#000;text-decoration:none;letter-spacing:2px;text-transform:uppercase;">
                Shapehugs
            </a>
        </div>

        <!-- Right: user, wishlist, cart -->
        <div class="header-right" style="display:flex;align-items:center;gap:18px;flex:1;justify-content:flex-end;">
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo $siteUrl; ?>user/profile.php" aria-label="Account" style="color:#000;font-size:18px;"><i class="fas fa-user"></i></a>
            <?php else: ?>
                <a href="<?php echo $siteUrl; ?>user/pages/login.php" aria-label="Login" style="color:#000;font-size:18px;"><i class="far fa-user"></i></a>
            <?php endif; ?>

            <a href="<?php echo $siteUrl; ?>user/wishlist.php" aria-label="Wishlist" style="color:#000;font-size:18px;"><i class="far fa-heart"></i></a>

            <button class="cart-trigger" id="cartTrigger" aria-label="Cart" style="background:none;border:none;cursor:pointer;position:relative;font-size:18px;color:#000;">
                <i class="fas fa-bag-shopping"></i>
                <span class="cart-badge" id="cartBadge"
                      style="position:absolute;top:-6px;right:-8px;background:#000;color:#fff;font-size:10px;width:18px;height:18px;border-radius:50%;display:<?php echo $cartCount > 0 ? 'flex' : 'none'; ?>;align-items:center;justify-content:center;font-family:'Inter',sans-serif;">
                    <?php echo $cartCount; ?>
                </span>
            </button>
        </div>
    </div>

    <!-- ===== Desktop Navigation ===== -->
    <nav class="main-nav" style="max-width:1400px;margin:0 auto;padding:0 24px 10px;display:flex;justify-content:center;gap:28px;font-family:'Inter',sans-serif;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
        <a href="<?php echo $siteUrl; ?>user/menus/new-in.php" style="color:#000;text-decoration:none;">New In</a>
        <a href="<?php echo $siteUrl; ?>user/menus/bestsellers.php" style="color:#000;text-decoration:none;">Bestsellers</a>

        <!-- Dresses dropdown -->
        <div class="nav-dropdown" style="position:relative;">
            <a href="<?php echo $siteUrl; ?>user/menus/dresses.php" class="nav-dropdown-trigger" style="color:#000;text-decoration:none;cursor:pointer;">
                Dresses <i class="fas fa-chevron-down" style="font-size:9px;margin-left:3px;"></i>
            </a>
            <div class="nav-dropdown-menu" style="display:none;position:absolute;top:100%;left:0;background:#fff;border:1px solid #eee;min-width:160px;padding:12px 0;z-index:500;box-shadow:0 4px 16px rgba(0,0,0,0.08);">
                <a href="<?php echo $siteUrl; ?>user/menus/dresses.php?type=midi"     style="display:block;padding:8px 20px;color:#000;text-decoration:none;font-size:13px;">Midi</a>
                <a href="<?php echo $siteUrl; ?>user/menus/dresses.php?type=maxi"     style="display:block;padding:8px 20px;color:#000;text-decoration:none;font-size:13px;">Maxi</a>
                <a href="<?php echo $siteUrl; ?>user/menus/dresses.php?type=mini"     style="display:block;padding:8px 20px;color:#000;text-decoration:none;font-size:13px;">Mini</a>
                <a href="<?php echo $siteUrl; ?>user/menus/dresses.php?type=occasion" style="display:block;padding:8px 20px;color:#000;text-decoration:none;font-size:13px;">Occasion</a>
            </div>
        </div>

        <a href="<?php echo $siteUrl; ?>user/menus/tops.php"        style="color:#000;text-decoration:none;">Tops</a>
        <a href="<?php echo $siteUrl; ?>user/menus/bottoms.php"     style="color:#000;text-decoration:none;">Bottoms</a>
        <a href="<?php echo $siteUrl; ?>user/menus/accessories.php" style="color:#000;text-decoration:none;">Accessories</a>
        <a href="<?php echo $siteUrl; ?>user/menus/sale.php"        style="color:red;text-decoration:none;font-weight:600;">Sale</a>
    </nav>
</header>

<!-- ========== Mobile Slide-Out Menu ========== -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:2000;"></div>
<aside class="mobile-menu" id="mobileMenu" style="position:fixed;top:0;left:-300px;width:300px;height:100%;background:#fff;z-index:2001;transition:left 0.3s ease;overflow-y:auto;font-family:'Inter',sans-serif;">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid #eee;">
        <span style="font-family:'Outfit',sans-serif;font-weight:700;font-size:20px;letter-spacing:1px;text-transform:uppercase;">Shapehugs</span>
        <button id="closeMobileMenu" aria-label="Close menu" style="background:none;border:none;font-size:20px;cursor:pointer;"><i class="fas fa-times"></i></button>
    </div>
    <nav style="padding:16px 0;">
        <a href="<?php echo $siteUrl; ?>user/menus/new-in.php"      style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">New In</a>
        <a href="<?php echo $siteUrl; ?>user/menus/bestsellers.php" style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">Bestsellers</a>
        <a href="<?php echo $siteUrl; ?>user/menus/dresses.php"     style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">Dresses</a>
        <a href="<?php echo $siteUrl; ?>user/menus/tops.php"        style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">Tops</a>
        <a href="<?php echo $siteUrl; ?>user/menus/bottoms.php"     style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">Bottoms</a>
        <a href="<?php echo $siteUrl; ?>user/menus/accessories.php" style="display:block;padding:12px 24px;color:#000;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;">Accessories</a>
        <a href="<?php echo $siteUrl; ?>user/menus/sale.php"        style="display:block;padding:12px 24px;color:red;text-decoration:none;font-size:14px;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Sale</a>
    </nav>
    <div style="border-top:1px solid #eee;padding:16px 24px;">
        <?php if (isLoggedIn()): ?>
            <a href="<?php echo $siteUrl; ?>user/profile.php"  style="display:block;padding:10px 0;color:#000;text-decoration:none;font-size:14px;"><i class="fas fa-user" style="width:24px;"></i> My Account</a>
            <a href="<?php echo $siteUrl; ?>user/orders.php"   style="display:block;padding:10px 0;color:#000;text-decoration:none;font-size:14px;"><i class="fas fa-box" style="width:24px;"></i> My Orders</a>
            <a href="<?php echo $siteUrl; ?>user/wishlist.php" style="display:block;padding:10px 0;color:#000;text-decoration:none;font-size:14px;"><i class="fas fa-heart" style="width:24px;"></i> Wishlist</a>
        <?php else: ?>
            <a href="<?php echo $siteUrl; ?>user/pages/login.php"    style="display:block;padding:10px 0;color:#000;text-decoration:none;font-size:14px;"><i class="fas fa-sign-in-alt" style="width:24px;"></i> Login</a>
            <a href="<?php echo $siteUrl; ?>user/pages/register.php" style="display:block;padding:10px 0;color:#000;text-decoration:none;font-size:14px;"><i class="fas fa-user-plus" style="width:24px;"></i> Register</a>
        <?php endif; ?>
    </div>
</aside>

<!-- ========== Search Overlay ========== -->
<div class="search-overlay" id="searchOverlay" style="display:none;position:fixed;inset:0;background:rgba(255,255,255,0.97);z-index:3000;font-family:'Inter',sans-serif;">
    <div style="max-width:700px;margin:0 auto;padding:80px 24px 40px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;">
            <span style="font-size:20px;font-weight:600;text-transform:uppercase;letter-spacing:1px;">Search</span>
            <button id="closeSearch" aria-label="Close search" style="background:none;border:none;font-size:22px;cursor:pointer;"><i class="fas fa-times"></i></button>
        </div>
        <form action="<?php echo $siteUrl; ?>user/pages/product-view.php" method="GET" autocomplete="off">
            <div style="display:flex;border-bottom:2px solid #000;padding-bottom:8px;">
                <input type="text" name="search" placeholder="Search for products…"
                       style="flex:1;border:none;outline:none;font-size:18px;font-family:'Inter',sans-serif;background:transparent;">
                <button type="submit" aria-label="Submit search" style="background:none;border:none;font-size:20px;cursor:pointer;"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- ========== Cart Sidebar Drawer ========== -->
<div class="cart-overlay" id="cartOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:4000;"></div>
<aside class="cart-drawer" id="cartDrawer" style="position:fixed;top:0;right:-400px;width:400px;max-width:90vw;height:100%;background:#fff;z-index:4001;transition:right 0.3s ease;display:flex;flex-direction:column;font-family:'Inter',sans-serif;">
    <!-- Drawer Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #eee;">
        <span style="font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:1px;">Your Bag (<span id="cartDrawerCount"><?php echo $cartCount; ?></span>)</span>
        <button id="closeCart" aria-label="Close cart" style="background:none;border:none;font-size:20px;cursor:pointer;"><i class="fas fa-times"></i></button>
    </div>

    <!-- Drawer Items (populated via JS) -->
    <div class="cart-drawer-items" id="cartDrawerItems" style="flex:1;overflow-y:auto;padding:16px 24px;">
        <p class="cart-empty-msg" id="cartEmptyMsg" style="text-align:center;color:#888;padding:40px 0;<?php echo $cartCount > 0 ? 'display:none;' : ''; ?>">Your bag is empty.</p>
    </div>

    <!-- Drawer Footer -->
    <div style="border-top:1px solid #eee;padding:20px 24px;">
        <div style="display:flex;justify-content:space-between;font-size:16px;font-weight:600;margin-bottom:16px;">
            <span>Subtotal</span>
            <span id="cartDrawerTotal">$0.00</span>
        </div>
        <a href="<?php echo $siteUrl; ?>user/cart.php"
           style="display:block;text-align:center;padding:14px;background:#000;color:#fff;text-decoration:none;text-transform:uppercase;font-size:13px;letter-spacing:1px;margin-bottom:8px;">
            View Bag
        </a>
        <a href="<?php echo $siteUrl; ?>user/pages/checkout.php"
           style="display:block;text-align:center;padding:14px;background:#1a1a1a;color:#fff;text-decoration:none;text-transform:uppercase;font-size:13px;letter-spacing:1px;">
            Checkout
        </a>
    </div>
</aside>

<!-- ========== Navbar Inline Scripts (toggle helpers) ========== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Mobile Menu ---
    var hamburger   = document.getElementById('hamburgerBtn');
    var mobileMenu  = document.getElementById('mobileMenu');
    var mobileOv    = document.getElementById('mobileMenuOverlay');
    var closeMenu   = document.getElementById('closeMobileMenu');

    function openMobile()  { mobileMenu.style.left = '0'; mobileOv.style.display = 'block'; }
    function closeMobile() { mobileMenu.style.left = '-300px'; mobileOv.style.display = 'none'; }

    if (hamburger) hamburger.addEventListener('click', openMobile);
    if (closeMenu) closeMenu.addEventListener('click', closeMobile);
    if (mobileOv)  mobileOv.addEventListener('click', closeMobile);

    // --- Search Overlay ---
    var searchTrigger = document.getElementById('searchTrigger');
    var searchOverlay = document.getElementById('searchOverlay');
    var closeSearch   = document.getElementById('closeSearch');

    if (searchTrigger) searchTrigger.addEventListener('click', function () { searchOverlay.style.display = 'block'; });
    if (closeSearch)   closeSearch.addEventListener('click', function ()   { searchOverlay.style.display = 'none'; });

    // --- Cart Drawer ---
    var cartTrigger = document.getElementById('cartTrigger');
    var cartDrawer  = document.getElementById('cartDrawer');
    var cartOverlay = document.getElementById('cartOverlay');
    var closeCart   = document.getElementById('closeCart');

    function openCart()  { cartDrawer.style.right = '0'; cartOverlay.style.display = 'block'; }
    function closeCartFn() { cartDrawer.style.right = '-400px'; cartOverlay.style.display = 'none'; }

    if (cartTrigger) cartTrigger.addEventListener('click', openCart);
    if (closeCart)   closeCart.addEventListener('click', closeCartFn);
    if (cartOverlay) cartOverlay.addEventListener('click', closeCartFn);

    // --- Desktop Dropdown ---
    document.querySelectorAll('.nav-dropdown').forEach(function (dd) {
        dd.addEventListener('mouseenter', function () { dd.querySelector('.nav-dropdown-menu').style.display = 'block'; });
        dd.addEventListener('mouseleave', function () { dd.querySelector('.nav-dropdown-menu').style.display = 'none'; });
    });
});
</script>
