<?php
session_start();
$_SESSION['form_submitted'] = true;
require_once '../includes/db.php';

$ref_id = $_GET['ref'] ?? '';
if (empty($ref_id)) {
    header('Location: /');
    exit;
}

try {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare('SELECT * FROM leads WHERE ref_id = ?');
    $stmt->execute([$ref_id]);
    $row = $stmt->fetch();

    if (!$row) {
        header('Location: /');
        exit;
    }

    $firstName = explode(' ', $row['name'])[0];
} catch (Exception $e) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | Merchands.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0A2240;
            --accent-blue: #1E6FBB;
            --cta-orange: #E8620A;
            --slate: #F4F6F9;
            --white: #FFFFFF;
            --text-muted: #666666;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--slate);
            color: #1A1A1A;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            width: 100%;
            padding: 20px 0;
            background: var(--white);
            border-bottom: 1px solid #eee;
        }

        .container {
            max-width: 640px;
            width: 90%;
            margin: 40px auto;
            text-align: center;
        }

        .check-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #1D9E75;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #1D9E75;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #1D9E75;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke { 100% { stroke-dashoffset: 0; } }
        @keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1, 1.1, 1); } }
        @keyframes fill { 100% { box-shadow: inset 0px 0px 0px 30px transparent; } }

        h1 { color: var(--navy); margin-bottom: 10px; }
        .sub { color: var(--text-muted); font-size: 1.1rem; margin-bottom: 20px; }
        
        .ref-pill {
            display: inline-block;
            background: #eef2f7;
            color: var(--navy);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .summary-card {
            background: var(--white);
            border-radius: 8px;
            padding: 30px;
            text-align: left;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .summary-card h3 { margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }

        .row { display: flex; justify-content: space-between; margin-bottom: 12px; }
        .label { color: var(--text-muted); font-size: 0.875rem; }
        .value { color: var(--navy); font-weight: 600; }

        .steps { text-align: left; margin-bottom: 30px; }
        .step { display: flex; gap: 15px; margin-bottom: 20px; }
        .step-num {
            width: 24px;
            height: 24px;
            background: var(--navy);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            flex-shrink: 0;
            margin-top: 3px;
        }
        .step-title { font-weight: 700; display: block; }
        .step-text { color: var(--text-muted); font-size: 0.875rem; }

        .btn-wa {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background-color: #25D366;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 4px;
            font-weight: 600;
            width: 100%;
            transition: 0.2s;
        }

        .btn-wa:hover { filter: brightness(1.05); }

        .links { margin-top: 30px; display: flex; gap: 20px; justify-content: center; }
        .links a { color: var(--accent-blue); text-decoration: none; font-size: 0.875rem; }
    </style>
</head>
<body>

    <header>
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="/" style="font-size: 1.5rem; font-weight: 700; color: var(--navy); text-decoration: none;">Merchands.com</a>
            <a href="tel:[PHONE_NUMBER]" style="color: var(--navy); text-decoration: none; font-weight: 600;">[PHONE_NUMBER]</a>
        </div>
    </header>

    <div class="container">
        <div class="check-container">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>

        <h1>Thank you, <?= htmlspecialchars($firstName) ?>!</h1>
        <p class="sub">Your freight enquiry has been received. Our team will be in touch within 4 hours.</p>
        <div class="ref-pill">Reference: <?= htmlspecialchars($row['ref_id']) ?></div>

        <div class="summary-card">
            <h3>Your enquiry details</h3>
            <div class="row"><span class="label">Name</span><span class="value"><?= htmlspecialchars($row['name']) ?></span></div>
            <div class="row"><span class="label">Company</span><span class="value"><?= htmlspecialchars($row['company']) ?></span></div>
            <div class="row"><span class="label">Shipment</span><span class="value"><?= ucfirst($row['shipment_type']) ?> freight</span></div>
            <div class="row"><span class="label">Route</span><span class="value"><?= htmlspecialchars($row['origin']) ?> &rarr; <?= htmlspecialchars($row['destination']) ?></span></div>
            <div class="row"><span class="label">Phone</span><span class="value"><?= htmlspecialchars($row['phone']) ?></span></div>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <div><span class="step-title">Our team reviews your enquiry</span><span class="step-text">Typically within 1 hour during business hours</span></div>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div><span class="step-title">A logistics expert contacts you</span><span class="step-text">To understand your cargo requirements in detail</span></div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div><span class="step-title">You receive a detailed quote</span><span class="step-text">Competitive rates within 4 working hours</span></div>
            </div>
        </div>

        <a href="https://wa.me/[WHATSAPP_NUMBER]?text=Hi%2C+I+just+submitted+a+freight+enquiry+%28Ref%3A+<?= urlencode($row['ref_id']) ?>%29.+Can+you+help+me%3F" class="btn-wa">
            Message us on WhatsApp &rarr;
        </a>

        <div class="links">
            <a href="/">&larr; Back to Merchands.com</a>
            <a href="/#quote-form">Submit another enquiry &rarr;</a>
        </div>
    </div>

</body>
</html>
