<?php
/**
 * Shapehugs - Site Footer
 *
 * Variables (set before including):
 *   $extraJS – array of additional JS file paths (optional)
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config/config.php';
}

$siteUrl = htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8');
$extraJS = $extraJS ?? [];
$year    = date('Y');
?>

<!-- ========== Footer ========== -->
<footer style="background:#000;color:#fff;font-family:'Inter',sans-serif;padding:60px 24px 0;">
    <div style="max-width:1400px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:40px;">

        <!-- Column 1: Company -->
        <div>
            <h4 style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;">Company</h4>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;font-size:13px;">
                <li><a href="<?php echo $siteUrl; ?>user/footer/about-us.php"       style="color:#ccc;text-decoration:none;">About Us</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/our-story.php"       style="color:#ccc;text-decoration:none;">Our Story</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/sustainability.php"  style="color:#ccc;text-decoration:none;">Sustainability</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/press.php"           style="color:#ccc;text-decoration:none;">Press</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/about-us.php#careers" style="color:#ccc;text-decoration:none;">Careers</a></li>
            </ul>
        </div>

        <!-- Column 2: Customer Service -->
        <div>
            <h4 style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;">Customer Service</h4>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;font-size:13px;">
                <li><a href="<?php echo $siteUrl; ?>user/footer/contact-us.php"          style="color:#ccc;text-decoration:none;">Contact Us</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/shipping-policy.php"     style="color:#ccc;text-decoration:none;">Shipping</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/returns-exchanges.php"   style="color:#ccc;text-decoration:none;">Returns</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/faq.php"                 style="color:#ccc;text-decoration:none;">FAQ</a></li>
                <li><a href="<?php echo $siteUrl; ?>user/footer/faq.php#size-guide"      style="color:#ccc;text-decoration:none;">Size Guide</a></li>
            </ul>
        </div>

        <!-- Column 3: Follow Us -->
        <div>
            <h4 style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;">Follow Us</h4>
            <div style="display:flex;gap:16px;font-size:20px;">
                <a href="https://instagram.com"  target="_blank" rel="noopener noreferrer" aria-label="Instagram"  style="color:#ccc;text-decoration:none;"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com"   target="_blank" rel="noopener noreferrer" aria-label="Facebook"   style="color:#ccc;text-decoration:none;"><i class="fab fa-facebook-f"></i></a>
                <a href="https://pinterest.com"  target="_blank" rel="noopener noreferrer" aria-label="Pinterest"  style="color:#ccc;text-decoration:none;"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://tiktok.com"     target="_blank" rel="noopener noreferrer" aria-label="TikTok"     style="color:#ccc;text-decoration:none;"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <!-- Column 4: Newsletter -->
        <div>
            <h4 style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;">Newsletter</h4>
            <p style="font-size:13px;color:#ccc;margin-bottom:16px;line-height:1.6;">Subscribe for exclusive offers and new arrivals.</p>
            <form class="newsletter-form" method="POST" action="<?php echo $siteUrl; ?>user/footer/contact-us.php" style="display:flex;">
                <input type="email" name="newsletter_email" placeholder="Enter your email" required
                       style="flex:1;padding:10px 14px;border:1px solid #444;background:#1a1a1a;color:#fff;font-size:13px;font-family:'Inter',sans-serif;outline:none;">
                <button type="submit" name="subscribe"
                        style="padding:10px 20px;background:#fff;color:#000;border:none;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;cursor:pointer;font-family:'Inter',sans-serif;">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div style="max-width:1400px;margin:40px auto 0;border-top:1px solid #333;padding:24px 0;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;font-size:12px;color:#888;">
        <span>&copy; <?php echo $year; ?> Shapehugs. All rights reserved.</span>

        <!-- Payment Icons -->
        <div style="display:flex;gap:12px;align-items:center;">
            <i class="fab fa-cc-visa" style="font-size:24px;color:#888;" aria-label="Visa"></i>
            <i class="fab fa-cc-mastercard" style="font-size:24px;color:#888;" aria-label="Mastercard"></i>
            <i class="fab fa-cc-amex" style="font-size:24px;color:#888;" aria-label="Amex"></i>
            <i class="fab fa-cc-paypal" style="font-size:24px;color:#888;" aria-label="PayPal"></i>
            <i class="fab fa-cc-apple-pay" style="font-size:24px;color:#888;" aria-label="Apple Pay"></i>
        </div>

        <!-- Legal Links -->
        <div style="display:flex;gap:16px;">
            <a href="<?php echo $siteUrl; ?>user/footer/terms-of-use.php"    style="color:#888;text-decoration:none;">Terms &amp; Conditions</a>
            <a href="<?php echo $siteUrl; ?>user/footer/privacy-policy.php"  style="color:#888;text-decoration:none;">Privacy Policy</a>
            <a href="<?php echo $siteUrl; ?>user/footer/cookies.php"         style="color:#888;text-decoration:none;">Cookie Policy</a>
        </div>
    </div>
</footer>

<!-- Site Scripts -->
<script src="<?php echo $siteUrl; ?>js/main.js"></script>
<script src="<?php echo $siteUrl; ?>js/cart.js"></script>

<?php foreach ($extraJS as $js): ?>
<script src="<?php echo htmlspecialchars($js, ENT_QUOTES, 'UTF-8'); ?>"></script>
<?php endforeach; ?>

</body>
</html>
