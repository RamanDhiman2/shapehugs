<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

session_start();

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    shapehugs_json(['success' => false, 'message' => 'Method not allowed'], 405);
}

$payload = shapehugs_request_json();
$customer = is_array($payload['customer'] ?? null) ? $payload['customer'] : [];
$items = is_array($payload['items'] ?? null) ? $payload['items'] : [];

if (!$customer || !$items) {
    shapehugs_json(['success' => false, 'message' => 'Customer and cart items are required'], 422);
}

$orderNumber = 'SH-' . date('Ymd') . '-' . random_int(1000, 9999);
$summary = [
    'subtotal' => (float) ($payload['totals']['subtotal'] ?? 0),
    'shipping' => (float) ($payload['totals']['shipping'] ?? 0),
    'tax' => (float) ($payload['totals']['tax'] ?? 0),
    'total' => (float) ($payload['totals']['total'] ?? 0),
];

if (!shapehugs_table_exists('tb_orders') || !shapehugs_table_exists('tb_order_items')) {
    shapehugs_json([
        'success' => true,
        'message' => 'Order received',
        'data' => [
            'orderNumber' => $orderNumber,
            'redirectUrl' => '../../user/pages/payment-success.php?order=' . urlencode($orderNumber),
            'summary' => $summary,
        ],
    ], 201);
}

global $con;
mysqli_begin_transaction($con);

try {
    $insertOrder = mysqli_prepare($con, 'INSERT INTO tb_orders (order_number, user_id, customer_name, email, phone, address, city, postal_code, country, payment_method, subtotal, shipping, tax, total, status, items_json, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    if (!$insertOrder) {
        throw new RuntimeException('Could not prepare order insert');
    }

    $userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    $customerName = trim((string) ($customer['name'] ?? ''));
    $email = trim((string) ($customer['email'] ?? ''));
    $phone = trim((string) ($customer['phone'] ?? ''));
    $address = trim((string) ($customer['address'] ?? ''));
    $city = trim((string) ($customer['city'] ?? ''));
    $postalCode = trim((string) ($customer['postalCode'] ?? ''));
    $country = trim((string) ($customer['country'] ?? ''));
    $paymentMethod = trim((string) ($payload['paymentMethod'] ?? 'Card'));
    $status = 'pending';
    $itemsJson = json_encode($items, JSON_UNESCAPED_SLASHES);
    $createdAt = date('Y-m-d H:i:s');

    mysqli_stmt_bind_param(
        $insertOrder,
        'sissssssssddddsss',
        $orderNumber,
        $userId,
        $customerName,
        $email,
        $phone,
        $address,
        $city,
        $postalCode,
        $country,
        $paymentMethod,
        $summary['subtotal'],
        $summary['shipping'],
        $summary['tax'],
        $summary['total'],
        $status,
        $itemsJson,
        $createdAt
    );

    if (!mysqli_stmt_execute($insertOrder)) {
        throw new RuntimeException('Could not save order');
    }

    $orderId = mysqli_insert_id($con);
    $insertItem = mysqli_prepare($con, 'INSERT INTO tb_order_items (order_id, product_id, product_name, image, size, color, price, quantity, line_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    if (!$insertItem) {
        throw new RuntimeException('Could not prepare order item insert');
    }

    foreach ($items as $item) {
        $productId = (int) ($item['id'] ?? 0);
        $productName = trim((string) ($item['name'] ?? ''));
        $image = trim((string) ($item['image'] ?? 'assets/images/hero.png'));
        $size = trim((string) ($item['size'] ?? 'One Size'));
        $color = trim((string) ($item['color'] ?? 'Default'));
        $price = (float) ($item['price'] ?? 0);
        $quantity = (int) ($item['quantity'] ?? 1);
        $lineTotal = $price * $quantity;

        mysqli_stmt_bind_param(
            $insertItem,
            'iissssdid',
            $orderId,
            $productId,
            $productName,
            $image,
            $size,
            $color,
            $price,
            $quantity,
            $lineTotal
        );

        if (!mysqli_stmt_execute($insertItem)) {
            throw new RuntimeException('Could not save order item');
        }
    }

    mysqli_commit($con);
} catch (Throwable $exception) {
    mysqli_rollback($con);
    shapehugs_json(['success' => false, 'message' => $exception->getMessage()], 500);
}

shapehugs_json([
    'success' => true,
    'message' => 'Order placed successfully',
    'data' => [
        'orderId' => $orderId,
        'orderNumber' => $orderNumber,
        'redirectUrl' => '../../user/pages/payment-success.php?order=' . urlencode($orderNumber),
    ],
], 201);
