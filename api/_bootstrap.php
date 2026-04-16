<?php
declare(strict_types=1);

require_once __DIR__ . '/../db_config.php';

if (function_exists('mysqli_set_charset')) {
    @mysqli_set_charset($con, 'utf8mb4');
}

function shapehugs_json(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_SLASHES);
    exit;
}

function shapehugs_request_json(): array
{
    $rawBody = file_get_contents('php://input');
    if ($rawBody !== false && trim($rawBody) !== '') {
        $decoded = json_decode($rawBody, true);
        if (is_array($decoded)) {
            return $decoded;
        }
    }

    return $_POST;
}

function shapehugs_slugify(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? $value;
    return trim($value, '-');
}

function shapehugs_table_exists(string $tableName): bool
{
    global $con;

    $safeName = mysqli_real_escape_string($con, $tableName);
    $query = mysqli_query($con, "SHOW TABLES LIKE '{$safeName}'");

    return $query instanceof mysqli_result && mysqli_num_rows($query) > 0;
}

function shapehugs_seed_catalog(): array
{
    return [
        'categories' => [
            [
                'id' => 1,
                'name' => 'Dresses',
                'slug' => 'dresses',
                'description' => 'Romantic silhouettes for daytime and evening.',
                'image' => 'assets/images/cat_dresses.png',
                'icon' => 'fa-person-dress',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'Tops',
                'slug' => 'tops',
                'description' => 'Layerable pieces that stay in rotation.',
                'image' => 'assets/images/cat_tops.png',
                'icon' => 'fa-shirt',
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'Bottoms',
                'slug' => 'bottoms',
                'description' => 'Tailored skirts and trousers with clean lines.',
                'image' => 'assets/images/cat_bottoms.png',
                'icon' => 'fa-layer-group',
                'status' => 'active',
            ],
            [
                'id' => 4,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Finish the look with refined accents.',
                'image' => 'assets/images/cat_accessories.png',
                'icon' => 'fa-gem',
                'status' => 'active',
            ],
        ],
        'products' => [
            [
                'id' => 1,
                'name' => 'The Sage Silk Midi',
                'slug' => 'the-sage-silk-midi',
                'sku' => 'SH-1001',
                'category' => 'Dresses',
                'categorySlug' => 'dresses',
                'description' => 'A flowing midi dress cut from soft silk with a clean waist tie and elegant drape.',
                'price' => '68.00',
                'comparePrice' => '88.00',
                'badge' => 'New In',
                'featured' => 1,
                'isNew' => 1,
                'collections' => ['new-in', 'featured', 'bestsellers'],
                'image' => 'assets/images/p1.png',
                'secondaryImage' => 'assets/images/hero2.png',
                'rating' => 4.9,
                'reviews' => 48,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Sage', 'Ivory'],
                'stock' => 24,
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'White Lace Blouse',
                'slug' => 'white-lace-blouse',
                'sku' => 'SH-1002',
                'category' => 'Tops',
                'categorySlug' => 'tops',
                'description' => 'A modern blouse with delicate lace texture and a relaxed, feminine fit.',
                'price' => '45.00',
                'comparePrice' => '58.00',
                'badge' => 'Editor\'s Pick',
                'featured' => 1,
                'isNew' => 1,
                'collections' => ['new-in', 'featured'],
                'image' => 'assets/images/p2.png',
                'secondaryImage' => 'assets/images/cat_tops.png',
                'rating' => 4.7,
                'reviews' => 31,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'colors' => ['Ivory', 'Sand'],
                'stock' => 16,
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'Pleated High-Waist Skirt',
                'slug' => 'pleated-high-waist-skirt',
                'sku' => 'SH-1003',
                'category' => 'Bottoms',
                'categorySlug' => 'bottoms',
                'description' => 'A crisp pleated skirt designed to move easily from office hours to dinner.',
                'price' => '54.00',
                'comparePrice' => '72.00',
                'badge' => 'Best Seller',
                'featured' => 1,
                'isNew' => 0,
                'collections' => ['bestsellers', 'featured'],
                'image' => 'assets/images/p3.png',
                'secondaryImage' => 'assets/images/cat_bottoms.png',
                'rating' => 4.8,
                'reviews' => 65,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Pearl', 'Black'],
                'stock' => 12,
                'status' => 'active',
            ],
            [
                'id' => 4,
                'name' => 'Vintage Floral Dress',
                'slug' => 'vintage-floral-dress',
                'sku' => 'SH-1004',
                'category' => 'Dresses',
                'categorySlug' => 'dresses',
                'description' => 'A romantic floral dress with soft sleeves and a vintage-inspired shape.',
                'price' => '72.00',
                'comparePrice' => '92.00',
                'badge' => 'Limited',
                'featured' => 1,
                'isNew' => 0,
                'collections' => ['featured', 'sale'],
                'image' => 'assets/images/hero.png',
                'secondaryImage' => 'assets/images/hero3.png',
                'rating' => 4.6,
                'reviews' => 22,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Rose', 'Cream'],
                'stock' => 10,
                'status' => 'active',
            ],
            [
                'id' => 5,
                'name' => 'Linen Wrap Dress',
                'slug' => 'linen-wrap-dress',
                'sku' => 'SH-1005',
                'category' => 'Dresses',
                'categorySlug' => 'dresses',
                'description' => 'A breathable wrap dress in textured linen, made for warm days and easy layering.',
                'price' => '85.00',
                'comparePrice' => '110.00',
                'badge' => 'New In',
                'featured' => 1,
                'isNew' => 1,
                'collections' => ['new-in', 'featured'],
                'image' => 'assets/images/cat_dresses.png',
                'secondaryImage' => 'assets/images/hero2.png',
                'rating' => 4.8,
                'reviews' => 39,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Natural', 'Olive'],
                'stock' => 14,
                'status' => 'active',
            ],
            [
                'id' => 6,
                'name' => 'Tailored Linen Trousers',
                'slug' => 'tailored-linen-trousers',
                'sku' => 'SH-1006',
                'category' => 'Bottoms',
                'categorySlug' => 'bottoms',
                'description' => 'Relaxed tailored trousers with a polished silhouette and premium linen handfeel.',
                'price' => '78.00',
                'comparePrice' => '96.00',
                'badge' => 'Minimal',
                'featured' => 0,
                'isNew' => 1,
                'collections' => ['new-in'],
                'image' => 'assets/images/cat_bottoms.png',
                'secondaryImage' => 'assets/images/hero3.png',
                'rating' => 4.5,
                'reviews' => 18,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'colors' => ['Stone', 'Charcoal'],
                'stock' => 19,
                'status' => 'active',
            ],
            [
                'id' => 7,
                'name' => 'Silk Ribbon Blouse',
                'slug' => 'silk-ribbon-blouse',
                'sku' => 'SH-1007',
                'category' => 'Tops',
                'categorySlug' => 'tops',
                'description' => 'An airy blouse finished with soft ribbon details and a subtle sheen.',
                'price' => '55.00',
                'comparePrice' => '70.00',
                'badge' => 'New In',
                'featured' => 0,
                'isNew' => 1,
                'collections' => ['new-in'],
                'image' => 'assets/images/cat_tops.png',
                'secondaryImage' => 'assets/images/p2.png',
                'rating' => 4.7,
                'reviews' => 27,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Ivory', 'Sage'],
                'stock' => 13,
                'status' => 'active',
            ],
            [
                'id' => 8,
                'name' => 'Straw Handbag',
                'slug' => 'straw-handbag',
                'sku' => 'SH-1008',
                'category' => 'Accessories',
                'categorySlug' => 'accessories',
                'description' => 'A lightweight woven bag that pairs easily with resort and everyday looks.',
                'price' => '28.00',
                'comparePrice' => '38.00',
                'badge' => 'Sale',
                'featured' => 0,
                'isNew' => 0,
                'collections' => ['sale'],
                'image' => 'assets/images/cat_accessories.png',
                'secondaryImage' => 'assets/images/hero3.png',
                'rating' => 4.4,
                'reviews' => 15,
                'sizes' => ['One Size'],
                'colors' => ['Natural'],
                'stock' => 32,
                'status' => 'active',
            ],
            [
                'id' => 9,
                'name' => 'Evening Velvet Midi',
                'slug' => 'evening-velvet-midi',
                'sku' => 'SH-1009',
                'category' => 'Dresses',
                'categorySlug' => 'dresses',
                'description' => 'A dramatic velvet midi designed for after-dark occasions with an elegant drape.',
                'price' => '120.00',
                'comparePrice' => '145.00',
                'badge' => 'Exclusive',
                'featured' => 0,
                'isNew' => 0,
                'collections' => ['bestsellers', 'sale'],
                'image' => 'assets/images/hero2.png',
                'secondaryImage' => 'assets/images/hero.png',
                'rating' => 4.9,
                'reviews' => 19,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Black', 'Wine'],
                'stock' => 7,
                'status' => 'active',
            ],
            [
                'id' => 10,
                'name' => 'Soft Tailored Blazer',
                'slug' => 'soft-tailored-blazer',
                'sku' => 'SH-1010',
                'category' => 'Tops',
                'categorySlug' => 'tops',
                'description' => 'A lightweight blazer cut with soft shoulders for a cleaner daily uniform.',
                'price' => '94.00',
                'comparePrice' => '118.00',
                'badge' => 'Featured',
                'featured' => 1,
                'isNew' => 0,
                'collections' => ['featured', 'bestsellers'],
                'image' => 'assets/images/hero3.png',
                'secondaryImage' => 'assets/images/cat_tops.png',
                'rating' => 4.6,
                'reviews' => 11,
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Sand', 'Black'],
                'stock' => 9,
                'status' => 'active',
            ],
        ],
        'collections' => [
            [
                'slug' => 'new-in',
                'name' => 'New In',
                'description' => 'Fresh arrivals for the season',
            ],
            [
                'slug' => 'bestsellers',
                'name' => 'Bestsellers',
                'description' => 'Most loved pieces right now',
            ],
            [
                'slug' => 'sale',
                'name' => 'Sale',
                'description' => 'Marked-down pieces before they are gone',
            ],
        ],
        'heroSlides' => [
            [
                'label' => 'Seasonal Exclusive',
                'title' => 'The Romantic Edit',
                'description' => 'Effortless Parisienne style for the modern woman.',
                'image' => 'assets/images/hero.png',
                'href' => 'user/menus/new-in.php',
                'cta' => 'Shop Collection',
            ],
            [
                'label' => 'Fresh Arrivals',
                'title' => 'New Spring Arrivals',
                'description' => 'Discover the lightness of linen, lace and silk.',
                'image' => 'assets/images/hero2.png',
                'href' => 'user/menus/new-in.php',
                'cta' => 'Shop New In',
            ],
            [
                'label' => 'Timeless Quality',
                'title' => 'Minimalist Chic',
                'description' => 'Essential pieces designed for every wardrobe.',
                'image' => 'assets/images/hero3.png',
                'href' => 'user/menus/tops.php',
                'cta' => 'Explore Now',
            ],
        ],
        'benefits' => [
            [
                'icon' => 'fa-truck-fast',
                'title' => 'Free Shipping',
                'description' => 'On all orders over $99',
            ],
            [
                'icon' => 'fa-rotate',
                'title' => 'Easy Returns',
                'description' => '30-day return policy',
            ],
            [
                'icon' => 'fa-leaf',
                'title' => 'Sustainable',
                'description' => 'Eco-friendly packaging',
            ],
            [
                'icon' => 'fa-lock',
                'title' => 'Secure Payment',
                'description' => '100% secure checkout',
            ],
        ],
    ];
}

function shapehugs_catalog_products(): array
{
    global $con;

    if (!shapehugs_table_exists('tb_products')) {
        return shapehugs_seed_catalog()['products'];
    }

    $sql = "
        SELECT
            p.id,
            p.name,
            p.slug,
            p.sku,
            p.category_id,
            p.description,
            p.price,
            p.compare_price,
            p.badge,
            p.featured,
            p.is_new,
            p.image,
            p.secondary_image,
            p.rating,
            p.reviews,
            p.sizes,
            p.colors,
            p.stock,
            p.status,
            c.name AS category,
            c.slug AS categorySlug
        FROM tb_products p
        LEFT JOIN tb_categories c ON c.id = p.category_id
        ORDER BY p.id DESC
    ";

    $result = @mysqli_query($con, $sql);
    if (!$result) {
        return shapehugs_seed_catalog()['products'];
    }

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = [
            'id' => (int) $row['id'],
            'name' => $row['name'] ?? '',
            'slug' => $row['slug'] ?? shapehugs_slugify((string) ($row['name'] ?? 'product')),
            'sku' => $row['sku'] ?? '',
            'category' => $row['category'] ?? 'Shop',
            'categorySlug' => $row['categorySlug'] ?? 'shop',
            'description' => $row['description'] ?? '',
            'price' => number_format((float) ($row['price'] ?? 0), 2, '.', ''),
            'comparePrice' => number_format((float) ($row['compare_price'] ?? $row['price'] ?? 0), 2, '.', ''),
            'badge' => $row['badge'] ?? '',
            'featured' => (int) ($row['featured'] ?? 0),
            'isNew' => (int) ($row['is_new'] ?? 0),
            'collections' => [],
            'image' => $row['image'] ?? 'assets/images/hero.png',
            'secondaryImage' => $row['secondary_image'] ?? 'assets/images/hero2.png',
            'rating' => (float) ($row['rating'] ?? 4.6),
            'reviews' => (int) ($row['reviews'] ?? 0),
            'sizes' => array_filter(array_map('trim', explode(',', (string) ($row['sizes'] ?? 'S,M,L')))),
            'colors' => array_filter(array_map('trim', explode(',', (string) ($row['colors'] ?? 'Ivory,Sage')))),
            'stock' => (int) ($row['stock'] ?? 0),
            'status' => $row['status'] ?? 'active',
        ];
    }

    return $products ?: shapehugs_seed_catalog()['products'];
}

function shapehugs_catalog_categories(): array
{
    global $con;

    if (!shapehugs_table_exists('tb_categories')) {
        return shapehugs_seed_catalog()['categories'];
    }

    $sql = "
        SELECT
            id,
            name,
            slug,
            description,
            image,
            icon,
            status
        FROM tb_categories
        ORDER BY id ASC
    ";

    $result = @mysqli_query($con, $sql);
    if (!$result) {
        return shapehugs_seed_catalog()['categories'];
    }

    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = [
            'id' => (int) $row['id'],
            'name' => $row['name'] ?? '',
            'slug' => $row['slug'] ?? shapehugs_slugify((string) ($row['name'] ?? 'category')),
            'description' => $row['description'] ?? '',
            'image' => $row['image'] ?? 'assets/images/hero.png',
            'icon' => $row['icon'] ?? 'fa-gem',
            'status' => $row['status'] ?? 'active',
        ];
    }

    return $categories ?: shapehugs_seed_catalog()['categories'];
}

function shapehugs_find_product(int $productId): ?array
{
    foreach (shapehugs_catalog_products() as $product) {
        if ((int) $product['id'] === $productId) {
            return $product;
        }
    }

    return null;
}

function shapehugs_filter_products(array $products, array $filters = []): array
{
    $filtered = array_values(array_filter($products, static function (array $product) use ($filters): bool {
        if (($product['status'] ?? 'active') !== 'active') {
            return false;
        }

        if (!empty($filters['category']) && strtolower((string) $product['categorySlug']) !== strtolower((string) $filters['category'])) {
            return false;
        }

        if (!empty($filters['collection'])) {
            $collection = strtolower((string) $filters['collection']);
            $collections = array_map('strtolower', $product['collections'] ?? []);
            if (!in_array($collection, $collections, true)) {
                return false;
            }
        }

        if (!empty($filters['featured']) && empty($product['featured'])) {
            return false;
        }

        if (!empty($filters['sale']) && (float) $product['comparePrice'] <= (float) $product['price']) {
            return false;
        }

        if (!empty($filters['q'])) {
            $query = strtolower(trim((string) $filters['q']));
            $haystack = strtolower(implode(' ', [
                $product['name'] ?? '',
                $product['category'] ?? '',
                $product['description'] ?? '',
                $product['badge'] ?? '',
            ]));

            if (strpos($haystack, $query) === false) {
                return false;
            }
        }

        return true;
    }));

    $sort = strtolower((string) ($filters['sort'] ?? 'featured'));
    usort($filtered, static function (array $left, array $right) use ($sort): int {
        return match ($sort) {
            'price_asc' => (float) $left['price'] <=> (float) $right['price'],
            'price_desc' => (float) $right['price'] <=> (float) $left['price'],
            'newest' => (int) $right['id'] <=> (int) $left['id'],
            default => (int) ($right['featured'] ?? 0) <=> (int) ($left['featured'] ?? 0),
        };
    });

    $limit = isset($filters['limit']) ? max(1, (int) $filters['limit']) : 0;
    if ($limit > 0) {
        $filtered = array_slice($filtered, 0, $limit);
    }

    return $filtered;
}
