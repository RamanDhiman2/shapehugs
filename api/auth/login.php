<?php
declare(strict_types=1);

require_once __DIR__ . '/../_bootstrap.php';

session_start();

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    shapehugs_json(['success' => false, 'message' => 'Method not allowed'], 405);
}

if (!shapehugs_table_exists('tb_users')) {
    shapehugs_json(['success' => false, 'message' => 'User table is unavailable'], 503);
}

global $con;
$payload = shapehugs_request_json();
$email = trim((string) ($payload['email'] ?? ''));
$password = (string) ($payload['password'] ?? '');
$hashedPassword = md5($password);

if ($email === '' || $password === '') {
    shapehugs_json(['success' => false, 'message' => 'Email and password are required'], 422);
}

$stmt = mysqli_prepare($con, 'SELECT id, firstName, lastName, Email, phone, address, Gender, activity FROM tb_users WHERE Email = ? AND Password = ? LIMIT 1');
if (!$stmt) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare login query'], 500);
}

mysqli_stmt_bind_param($stmt, 'ss', $email, $hashedPassword);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = $result ? mysqli_fetch_assoc($result) : null;

if (!$user) {
    shapehugs_json(['success' => false, 'message' => 'Invalid credentials'], 401);
}

if ((int) ($user['activity'] ?? 0) !== 1) {
    shapehugs_json(['success' => false, 'message' => 'Account is blocked'], 403);
}

$_SESSION['user_id'] = (int) $user['id'];
$_SESSION['user_email'] = $user['Email'];
$_SESSION['user_name'] = trim(($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''));

shapehugs_json([
    'success' => true,
    'message' => 'Signed in successfully',
    'data' => [
        'id' => (int) $user['id'],
        'name' => $_SESSION['user_name'],
        'email' => $user['Email'],
    ],
]);
