<?php
// merchands/admin/export.php

require_once '../includes/db.php';
require_once '../includes/auth-guard.php';

$pdo = getDbConnection();

// Build WHERE clause (same as index.php)
$where = ['1=1'];
$params = [];

if (!empty($_GET['search'])) {
    $where[] = '(name LIKE ? OR email LIKE ? OR company LIKE ? OR ref_id LIKE ?)';
    $s = '%' . $_GET['search'] . '%';
    $params = array_merge($params, [$s, $s, $s, $s]);
}
if (!empty($_GET['status']) && $_GET['status'] !== 'all') {
    $where[] = 'status = ?';
    $params[] = $_GET['status'];
}
if (!empty($_GET['shipment_type']) && $_GET['shipment_type'] !== 'all') {
    $where[] = 'shipment_type = ?';
    $params[] = $_GET['shipment_type'];
}
if (!empty($_GET['date_from'])) {
    $where[] = 'DATE(created_at) >= ?';
    $params[] = $_GET['date_from'];
}
if (!empty($_GET['date_to'])) {
    $where[] = 'DATE(created_at) <= ?';
    $params[] = $_GET['date_to'];
}

$whereSQL = implode(' AND ', $where);

$stmt = $pdo->prepare("SELECT ref_id, created_at, name, company, phone, email, shipment_type, origin, destination, message, utm_source, utm_campaign, ip_address, status, notes FROM leads WHERE $whereSQL ORDER BY created_at DESC");
$stmt->execute($params);
$leads = $stmt->fetchAll(PDO::FETCH_NUM);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="merchands_leads_' . date('Y-m-d') . '.csv"');

$output = fopen('php://output', 'w');

// BOM for Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

fputcsv($output, ['Ref', 'Date', 'Name', 'Company', 'Phone', 'Email', 'Shipment Type', 'Origin', 'Destination', 'Message', 'UTM Source', 'UTM Campaign', 'IP Address', 'Status', 'Notes']);

foreach ($leads as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit;
