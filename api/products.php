<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$products = shapehugs_catalog_products();

if ($method === 'GET') {
    $productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    if ($productId > 0) {
        $product = shapehugs_find_product($productId);
        if (!$product) {
            shapehugs_json(['success' => false, 'message' => 'Product not found'], 404);
        }

        shapehugs_json(['success' => true, 'data' => $product]);
    }

    $filtered = shapehugs_filter_products($products, [
        'category' => $_GET['category'] ?? '',
        'collection' => $_GET['collection'] ?? '',
        'featured' => filter_var($_GET['featured'] ?? false, FILTER_VALIDATE_BOOLEAN),
        'sale' => filter_var($_GET['sale'] ?? false, FILTER_VALIDATE_BOOLEAN),
        'q' => $_GET['q'] ?? '',
        'sort' => $_GET['sort'] ?? 'featured',
        'limit' => $_GET['limit'] ?? 0,
    ]);

    shapehugs_json([
        'success' => true,
        'data' => $filtered,
        'meta' => [
            'count' => count($filtered),
            'source' => shapehugs_table_exists('tb_products') ? 'database' : 'seed',
        ],
    ]);
}

if ($method === 'POST') {
    $payload = shapehugs_request_json();
    $name = trim((string) ($payload['name'] ?? ''));
    $categoryId = (int) ($payload['category_id'] ?? 0);
    $price = (float) ($payload['price'] ?? 0);

    if ($name === '' || $categoryId <= 0 || $price <= 0) {
        shapehugs_json(['success' => false, 'message' => 'Name, category and price are required'], 422);
    }

    if (!shapehugs_table_exists('tb_products')) {
        shapehugs_json(['success' => true, 'message' => 'Catalog table is not installed yet', 'data' => $payload], 200);
    }

    global $con;
    $slug = shapehugs_slugify((string) ($payload['slug'] ?? $name));
    $sku = trim((string) ($payload['sku'] ?? ('SH-' . strtoupper(substr($slug, 0, 8)))));
    $description = trim((string) ($payload['description'] ?? ''));
    $comparePrice = (float) ($payload['compare_price'] ?? $price);
    $badge = trim((string) ($payload['badge'] ?? ''));
    $featured = !empty($payload['featured']) ? 1 : 0;
    $isNew = !empty($payload['is_new']) ? 1 : 0;
    $image = trim((string) ($payload['image'] ?? 'assets/images/hero.png'));
    $secondaryImage = trim((string) ($payload['secondary_image'] ?? $image));
    $rating = (float) ($payload['rating'] ?? 4.6);
    $reviews = (int) ($payload['reviews'] ?? 0);
    $sizes = trim((string) ($payload['sizes'] ?? 'S,M,L'));
    $colors = trim((string) ($payload['colors'] ?? 'Ivory,Sage'));
    $stock = (int) ($payload['stock'] ?? 0);
    $status = trim((string) ($payload['status'] ?? 'active'));

    $insert = mysqli_prepare($con, "INSERT INTO tb_products (name, slug, sku, category_id, description, price, compare_price, badge, featured, is_new, image, secondary_image, rating, reviews, sizes, colors, stock, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$insert) {
        shapehugs_json(['success' => false, 'message' => 'Could not prepare product insert'], 500);
    }

    mysqli_stmt_bind_param(
        $insert,
        'sssisddsiissdissis',
        $name,
        $slug,
        $sku,
        $categoryId,
        $description,
        $price,
        $comparePrice,
        $badge,
        $featured,
        $isNew,
        $image,
        $secondaryImage,
        $rating,
        $reviews,
        $sizes,
        $colors,
        $stock,
        $status
    );

    if (!mysqli_stmt_execute($insert)) {
        shapehugs_json(['success' => false, 'message' => 'Database insert failed'], 500);
    }

    $createdId = mysqli_insert_id($con);
    shapehugs_json([
        'success' => true,
        'message' => 'Product created successfully',
        'data' => shapehugs_find_product($createdId) ?? ['id' => $createdId],
    ], 201);
}

shapehugs_json(['success' => false, 'message' => 'Method not allowed'], 405);
