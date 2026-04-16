<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

$categories = shapehugs_catalog_categories();
$products = shapehugs_catalog_products();
$counts = [];

foreach ($products as $product) {
    $slug = strtolower((string) ($product['categorySlug'] ?? ''));
    if ($slug === '') {
        continue;
    }

    if (!isset($counts[$slug])) {
        $counts[$slug] = 0;
    }

    $counts[$slug]++;
}

$payload = array_map(static function (array $category) use ($counts): array {
    $slug = strtolower((string) ($category['slug'] ?? ''));

    return [
        'id' => (int) ($category['id'] ?? 0),
        'name' => $category['name'] ?? '',
        'slug' => $slug,
        'description' => $category['description'] ?? '',
        'image' => $category['image'] ?? 'assets/images/hero.png',
        'icon' => $category['icon'] ?? 'fa-gem',
        'status' => $category['status'] ?? 'active',
        'productCount' => $counts[$slug] ?? 0,
    ];
}, $categories);

shapehugs_json([
    'success' => true,
    'data' => $payload,
    'meta' => [
        'count' => count($payload),
        'source' => shapehugs_table_exists('tb_categories') ? 'database' : 'seed',
    ],
]);
