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
$firstName = trim((string) ($payload['firstName'] ?? $payload['fs'] ?? ''));
$lastName = trim((string) ($payload['lastName'] ?? $payload['ls'] ?? ''));
$email = trim((string) ($payload['email'] ?? ''));
$phone = trim((string) ($payload['phone'] ?? ''));
$password = (string) ($payload['password'] ?? $payload['ps'] ?? '');
$confirmPassword = (string) ($payload['confirmPassword'] ?? $payload['cps'] ?? '');
$address = trim((string) ($payload['address'] ?? ''));
$gender = trim((string) ($payload['gender'] ?? $payload['gen'] ?? ''));

if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $password === '' || $confirmPassword === '') {
    shapehugs_json(['success' => false, 'message' => 'All account fields are required'], 422);
}

if ($password !== $confirmPassword) {
    shapehugs_json(['success' => false, 'message' => 'Passwords do not match'], 422);
}

$duplicate = mysqli_prepare($con, 'SELECT id FROM tb_users WHERE Email = ? OR phone = ? LIMIT 1');
if (!$duplicate) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare duplicate check'], 500);
}

mysqli_stmt_bind_param($duplicate, 'ss', $email, $phone);
mysqli_stmt_execute($duplicate);
$duplicateResult = mysqli_stmt_get_result($duplicate);

if ($duplicateResult && mysqli_fetch_assoc($duplicateResult)) {
    shapehugs_json(['success' => false, 'message' => 'Email or phone number already exists'], 409);
}

$now = date('Y-m-d H:i:s');
$hashedPassword = md5($password);
$insert = mysqli_prepare($con, 'INSERT INTO tb_users (firstName, lastName, Email, Password, confirmPassword, phone, address, Gender, CreateTime, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)');
if (!$insert) {
    shapehugs_json(['success' => false, 'message' => 'Could not prepare registration query'], 500);
}

mysqli_stmt_bind_param($insert, 'sssssssss', $firstName, $lastName, $email, $hashedPassword, $hashedPassword, $phone, $address, $gender, $now);

if (!mysqli_stmt_execute($insert)) {
    shapehugs_json(['success' => false, 'message' => 'Registration failed'], 500);
}

$userId = mysqli_insert_id($con);
$_SESSION['user_id'] = $userId;
$_SESSION['user_email'] = $email;
$_SESSION['user_name'] = trim($firstName . ' ' . $lastName);

shapehugs_json([
    'success' => true,
    'message' => 'Account created successfully',
    'data' => [
        'id' => $userId,
        'name' => $_SESSION['user_name'],
        'email' => $email,
    ],
], 201);
