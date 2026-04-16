<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    shapehugs_json(['success' => false, 'message' => 'Method not allowed'], 405);
}

$payload = shapehugs_request_json();
$email = trim((string) ($payload['email'] ?? ''));

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    shapehugs_json(['success' => false, 'message' => 'A valid email address is required'], 422);
}

if (!shapehugs_table_exists('tb_newsletter_subscribers')) {
    shapehugs_json(['success' => true, 'message' => 'Thanks for joining the list!'], 201);
}

global $con;
$existing = mysqli_prepare($con, 'SELECT id FROM tb_newsletter_subscribers WHERE email = ? LIMIT 1');
if (!$existing) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare newsletter lookup'], 500);
}

mysqli_stmt_bind_param($existing, 's', $email);
mysqli_stmt_execute($existing);
$result = mysqli_stmt_get_result($existing);
if ($result && mysqli_fetch_assoc($result)) {
    shapehugs_json(['success' => true, 'message' => 'You are already subscribed'], 200);
}

$stmt = mysqli_prepare($con, 'INSERT INTO tb_newsletter_subscribers (email, created_at) VALUES (?, ?)');
if (!$stmt) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare newsletter insert'], 500);
}

$createdAt = date('Y-m-d H:i:s');
mysqli_stmt_bind_param($stmt, 'ss', $email, $createdAt);

if (!mysqli_stmt_execute($stmt)) {
    shapehugs_json(['success' => false, 'message' => 'Could not save subscription'], 500);
}

shapehugs_json(['success' => true, 'message' => 'Thanks for joining the list!'], 201);
