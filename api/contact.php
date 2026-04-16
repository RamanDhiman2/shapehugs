<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    shapehugs_json(['success' => false, 'message' => 'Method not allowed'], 405);
}

$payload = shapehugs_request_json();
$name = trim((string) ($payload['name'] ?? ''));
$email = trim((string) ($payload['email'] ?? ''));
$subject = trim((string) ($payload['subject'] ?? 'General inquiry'));
$message = trim((string) ($payload['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    shapehugs_json(['success' => false, 'message' => 'Name, email and message are required'], 422);
}

if (!shapehugs_table_exists('tb_contact_messages')) {
    shapehugs_json(['success' => true, 'message' => 'Message received. We will reply soon.'], 201);
}

global $con;
$stmt = mysqli_prepare($con, 'INSERT INTO tb_contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, ?)');
if (!$stmt) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare contact insert'], 500);
}

$createdAt = date('Y-m-d H:i:s');
mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $subject, $message, $createdAt);

if (!mysqli_stmt_execute($stmt)) {
    shapehugs_json(['success' => false, 'message' => 'Could not save message'], 500);
}

shapehugs_json(['success' => true, 'message' => 'Message received. We will reply soon.'], 201);
