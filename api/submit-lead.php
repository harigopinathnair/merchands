<?php
// merchands/api/submit-lead.php

require_once '../includes/db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . (isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] : '*'));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$errors = [];

$name = trim($input['name'] ?? '');
$phone = trim($input['phone'] ?? '');
$email = trim($input['email'] ?? '');
$company = trim($input['company'] ?? '');
$service_category = trim($input['service_category'] ?? 'logistics');
$shipment_type = $input['shipment_type'] ?? ($service_category === 'logistics' ? 'other' : null);
$origin = trim($input['origin'] ?? '');
$destination = trim($input['destination'] ?? '');
$message = trim($input['message'] ?? '');
$utm_source = trim($input['utm_source'] ?? '');
$utm_campaign = trim($input['utm_campaign'] ?? '');

// Validation
if (empty($name)) $errors['name'] = 'Full name is required';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid business email is required';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    $pdo = getDbConnection();
    $ref_id = 'MRC-' . strtoupper(substr(uniqid(), -6));
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

    $stmt = $pdo->prepare("INSERT INTO leads (ref_id, service_category, name, phone, email, company, shipment_type, origin, destination, message, utm_source, utm_campaign, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $ref_id, $service_category, $name, $phone, $email, $company, $shipment_type, $origin, $destination, $message, $utm_source, $utm_campaign, $ip_address
    ]);

    // Trigger notification
    require_once 'send-notification.php';
    sendLeadNotifications([
        'ref_id' => $ref_id,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'company' => $company,
        'shipment_type' => $shipment_type,
        'origin' => $origin,
        'destination' => $destination,
        'message' => $message,
        'utm_source' => $utm_source,
        'utm_campaign' => $utm_campaign
    ]);

    echo json_encode(['success' => true, 'ref' => $ref_id]);

} catch (PDOException $e) {
    error_log('Lead submission failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Could not save lead']);
}
