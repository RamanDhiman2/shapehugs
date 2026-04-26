<?php
/**
 * Shapehugs - Shared HTML Head & Opening Body Tag
 *
 * Variables (set before including):
 *   $pageTitle  – browser tab title  (default: 'Shapehugs | Premium Fashion')
 *   $pageDesc   – meta description   (default: generic)
 *   $pageKeys   – meta keywords      (default: generic)
 *   $extraCSS   – array of additional CSS file paths (optional)
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config/config.php';
}

$pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'Shapehugs | Premium Fashion';
$pageDesc  = isset($pageDesc)  ? htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8')  : 'Discover premium fashion at Shapehugs. Shop the latest trends in dresses, tops, bottoms, and accessories.';
$pageKeys  = isset($pageKeys)  ? htmlspecialchars($pageKeys, ENT_QUOTES, 'UTF-8')  : 'fashion, dresses, tops, bottoms, accessories, premium clothing, shapehugs';
$extraCSS  = $extraCSS ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $pageDesc; ?>">
    <meta name="keywords" content="<?php echo $pageKeys; ?>">
    <title><?php echo $pageTitle; ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Site Stylesheets -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8'); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8'); ?>css/responsive.css">

    <?php foreach ($extraCSS as $css): ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endforeach; ?>
</head>
<body>
