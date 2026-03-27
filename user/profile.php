<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Shapehugs European Boutique Fashion</title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <!-- Announcement Bar -->
    <div class="announcement-bar">
        FREE SHIPPING ON ORDERS OVER $99 | NEW SPRING ARRIVALS
    </div>

    <!-- Navigation -->
    <header class="main-nav">
        <div class="container">
            <div class="nav-top">
                <div class="nav-col-left">
                    <div class="mobile-toggle d-lg-none" id="mobile-toggle">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="nav-search-trigger d-none d-lg-flex" id="search-trigger">
                        <i class="fa-solid fa-search"></i>
                        <span class="small fw-medium text-uppercase letter-spacing-1">Search</span>
                    </div>
                    <a href="../index.php" class="nav-back d-none d-sm-flex"><i class="fa-solid fa-arrow-left me-2"></i> Back to Shop</a>
                </div>
                <div class="nav-logo"><a href="../index.php" style="color: inherit; text-decoration: none;">Shapehugs</a></div>
                <div class="nav-icons-right">
                    <div class="search-trigger-mobile d-lg-none" id="search-trigger-mobile">
                        <i class="fa-solid fa-search"></i>
                    </div>
                    <a href="profile.php"><i class="fa-solid fa-user"></i></a>
                    <a href="wishlist.php"><i class="fa-regular fa-heart"></i></a>
                    <div class="cart-trigger" id="cart-trigger">
                        <i class="fa-solid fa-shopping-bag"></i>
                        <span class="cart-badge" id="cart-badge">0</span>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav-menu">
            <div class="menu-mobile-header d-lg-none">
                <span class="serif">Shapehugs</span>
                <div id="close-menu"><i class="fa-solid fa-xmark"></i></div>
            </div>
            <div class="container">
                <ul>
                    <li class="has-submenu has-megamenu">
                        <a href="menus/new-in.php" class="nav-link">New In</a>
                        <div class="megamenu">
                            <div class="megamenu-content">
                                <div class="megamenu-col">
                                    <h4>Trends</h4>
                                    <ul>
                                        <li><a href="#">Spring/Summer 2026</a></li>
                                        <li><a href="#">The Romantic Edit</a></li>
                                        <li><a href="#">Minimalist Chic</a></li>
                                        <li><a href="#">Parisian Street Style</a></li>
                                    </ul>
                                </div>
                                <div class="megamenu-col">
                                    <h4>Collections</h4>
                                    <ul>
                                        <li><a href="#">Bridal Suite</a></li>
                                        <li><a href="#">Vacation Shop</a></li>
                                        <li><a href="menus/bestsellers.php">Bestsellers</a></li>
                                        <li><a href="menus/new-in.php">New Arrivals</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="menus/bestsellers.php" class="nav-link">Bestsellers</a></li>
                    <li class="has-submenu has-dropdown">
                        <a href="menus/dresses.php" class="nav-link">Dresses</a>
                        <div class="submenu">
                            <div class="submenu-container">
                                <div class="submenu-links">
                                    <ul>
                                        <li><a href="#">Midi Dresses</a></li>
                                        <li><a href="#">Maxi Dresses</a></li>
                                        <li><a href="#">Mini Dresses</a></li>
                                        <li><a href="#">Occasion Wear</a></li>
                                        <li><a href="#">Summer Sale</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="menus/tops.php" class="nav-link">Tops</a></li>
                    <li><a href="menus/bottoms.php" class="nav-link">Bottoms</a></li>
                    <li><a href="menus/accessories.php" class="nav-link">Accessories</a></li>
                    <li><a href="menus/sale.php" class="nav-link" style="color: #d10000;">Sale</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="account-page">
        <div class="container">
            <div class="account-layout">
                <!-- Sidebar -->
                <aside class="account-sidebar">
                    <h2 class="serif">Alexandra's Account</h2>
                    <nav class="account-nav-list">
                        <a href="profile.php" class="account-nav-item active">Personal Information</a>
                        <a href="orders.php" class="account-nav-item">Order History</a>
                        <a href="wishlist.php" class="account-nav-item">My Wishlist</a>
                        <a href="address.php" class="account-nav-item">Saved Addresses</a>
                        <a href="../index.php" class="account-nav-item" style="margin-top: 30px; color: #d10000;">Logout</a>
                    </nav>
                </aside>

                <!-- Content Area -->
                <div class="account-content">
                    <div class="account-card">
                        <div class="card-header mb-5" style="margin-bottom: 40px;">
                            <h3 class="serif" style="font-size: 28px;">My Profile</h3>
                            <p class="text-muted small">Manage your personal details and account settings.</p>
                        </div>
                        
                        <form id="profile-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" value="Alexandra">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" value="Romano">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" value="alexandra.r@example.com">
                                <p class="small text-muted mt-2">Verified account email</p>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="tel" value="+1 (555) 123-4567">
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" value="1995-05-12">
                                </div>
                            </div>

                            <div class="form-group mt-4" style="margin-top: 20px;">
                                <label class="d-flex align-items-center" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" checked style="width: auto;">
                                    <span style="font-size: 13px; text-transform: none; letter-spacing: 0;">Subscribe to Bandy newsletter for exclusive offers</span>
                                </label>
                            </div>

                            <div class="mt-5" style="margin-top: 40px;">
                                <button type="submit" class="btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Section -->
                    <div class="account-card mt-5" style="margin-top: 40px;">
                        <h3 class="serif mb-4" style="margin-bottom: 25px;">Security</h3>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p class="fw-bold mb-1">Password</p>
                                <p class="text-muted small">Last changed 3 months ago</p>
                            </div>
                            <button class="btn-outline" style="padding: 10px 20px; background: none; border: 1px solid var(--border-color); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; cursor: pointer;">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4 class="nav-logo" style="position: static; transform: none; font-size: 20px; margin-bottom: 20px;">
                        <a href="../index.php" style="color: inherit; text-decoration: none;">Shapehugs</a>
                    </h4>
                    <p>European boutique fashion for the modern woman. Effortless, romantic, and timeless.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="footer/about-us.php">About Us</a></li>
                        <li><a href="footer/our-story.php">Our Story</a></li>
                        <li><a href="footer/sustainability.php">Sustainability</a></li>
                        <li><a href="footer/press.php">Press</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Customer Care</h4>
                    <ul>
                        <li><a href="footer/contact-us.php">Contact Us</a></li>
                        <li><a href="footer/shipping-policy.php">Shipping Policy</a></li>
                        <li><a href="footer/returns-exchanges.php">Returns & Exchanges</a></li>
                        <li><a href="footer/faq.php">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="footer/terms-of-use.php">Terms of Use</a></li>
                        <li><a href="footer/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="footer/cookies.php">Cookies</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Join the list</h4>
                    <p>Subscribe for early access and styling tips.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address">
                        <button type="submit">Join</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Shapehugs. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Search Overlay -->
    <div class="search-overlay" id="search-overlay">
        <div class="search-close" id="search-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="search-container">
            <div class="search-input-wrapper">
                <input type="text" id="search-input" placeholder="Search for products, categories..."
                    autocomplete="off">
                <div class="search-line"></div>
            </div>
            <div class="search-results-container" id="search-results">
                <!-- Search results will appear here -->
            </div>
        </div>
    </div>

    <!-- GSAP for smooth reveal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <!-- Cart Drawer -->
    <div class="cart-drawer" id="cart-drawer">
        <div class="cart-header">
            <h2 class="serif">Your Bag</h2>
            <div class="cart-close" id="cart-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="cart-items-wrapper">
            <div class="cart-items" id="cart-items">
                <div class="empty-cart-message">
                    <p>Your bag is currently empty.</p>
                    <a href="menus/new-in.php" class="btn-underline">Shop New Arrivals</a>
                </div>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Subtotal</span>
                <span id="cart-total-amount">$0.00</span>
            </div>
            <a href="cart.php" class="checkout-btn" style="text-decoration: none; text-align: center; display: block;">Proceed to Checkout</a>
            <p class="cart-shipping-note">Free shipping & returns on all orders over $99.</p>
        </div>
    </div>
    <div class="drawer-overlay" id="drawer-overlay"></div>

    <!-- Quick View Modal -->
    <div class="quick-view-modal" id="quick-view-modal">
        <div class="modal-content">
            <div class="modal-close" id="modal-close"><i class="fa-solid fa-xmark"></i></div>
            <div class="modal-body" id="modal-body">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>
    <script>
        gsap.from(".account-sidebar, .account-card", {
            duration: 1,
            opacity: 0,
            y: 30,
            stagger: 0.15,
            ease: "power3.out"
        });
    </script>
</body>

</html>
