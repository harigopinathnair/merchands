<?php
// merchands/api/send-notification.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// This file is typically included from submit-lead.php or called via a worker.
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// Load .env variables
if (class_exists('Dotenv\Dotenv') && file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

function sendLeadNotifications($leadData) {
    // Load config (mocking getenv for now, should come from .env)
    $smtpHost = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
    $smtpPort = $_ENV['SMTP_PORT'] ?? 587;
    $smtpUser = $_ENV['SMTP_USER'] ?? '';
    $smtpPass = $_ENV['SMTP_PASS'] ?? '';
    $smtpFrom = $_ENV['SMTP_FROM'] ?? 'noreply@merchands.com';
    $adminEmail = 'rankmonk@gmail.com';

    $refId = $leadData['ref_id'];
    $name = $leadData['name'];
    $firstName = explode(' ', $name)[0];

    try {
        if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            error_log("PHPMailer not found. Lead [{$refId}] data: " . json_encode($leadData));
            return;
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = ($smtpPort == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtpPort;

        // Admin Notification
        $mail->setFrom($smtpFrom, $_ENV['SMTP_FROM_NAME'] ?? 'Merchands.com');
        $mail->addAddress($adminEmail);
        $mail->isHTML(true);
        $mail->Subject = "New freight lead: {$name} — {$leadData['shipment_type']} — {$leadData['origin']} to {$leadData['destination']}";
        
        $mail->Body = "
            <h2 style='color:#0A2240;font-family:sans-serif;'>New lead — Merchands.com</h2>
            <table border='0' cellpadding='10' cellspacing='0' width='100%' style='border-collapse: collapse; font-family: sans-serif;'>
                <tr style='background-color: #f9f9f9;'><td><strong>Reference</strong></td><td>{$refId}</td></tr>
                <tr><td><strong>Name</strong></td><td>{$name}</td></tr>
                <tr style='background-color: #f9f9f9;'><td><strong>Company</strong></td><td>{$leadData['company']}</td></tr>
                <tr><td><strong>Phone</strong></td><td>{$leadData['phone']}</td></tr>
                <tr style='background-color: #f9f9f9;'><td><strong>Email</strong></td><td>{$leadData['email']}</td></tr>
                <tr><td><strong>Shipment Type</strong></td><td>" . ucfirst($leadData['shipment_type']) . "</td></tr>
                <tr style='background-color: #f9f9f9;'><td><strong>Route</strong></td><td>{$leadData['origin']} &rarr; {$leadData['destination']}</td></tr>
                <tr><td><strong>Message</strong></td><td>" . nl2br($leadData['message']) . "</td></tr>
                <tr style='background-color: #f9f9f9;'><td><strong>UTM Source</strong></td><td>{$leadData['utm_source']} / {$leadData['utm_campaign']}</td></tr>
            </table>
            <p><a href='https://merchands.com/admin/' style='display:inline-block; padding: 12px 24px; background-color: #E8620A; color: white; text-decoration: none; border-radius: 4px; margin-top: 20px;'>View in Dashboard &rarr;</a></p>
        ";
        $mail->send();

        // Lead Confirmation
        $mail->clearAddresses();
        $mail->addAddress($leadData['email']);
        $mail->Subject = "Your freight enquiry has been received — Merchands.com (Ref: {$refId})";
        $mail->Body = "
            <div style='max-width: 600px; margin: 0 auto; font-family: sans-serif; color: #333;'>
                <div style='text-align: center; padding: 20px;'>
                    <div style='color: #1D9E75; font-size: 48px;'>&check;</div>
                    <h1 style='color: #0A2240;'>Thank you, {$firstName}!</h1>
                    <p>Your enquiry has been received. Our team will be in touch within 4 hours.</p>
                    <div style='background: #f4f6f9; padding: 10px; display: inline-block; border-radius: 20px; color: #0A2240; font-weight: bold;'>Ref: {$refId}</div>
                </div>
                <div style='border: 1px solid #eee; border-radius: 8px; padding: 20px; margin-top: 20px;'>
                    <h3 style='margin-top: 0;'>Enquiry Details</h3>
                    <p><strong>Route:</strong> {$leadData['origin']} &rarr; {$leadData['destination']}</p>
                    <p><strong>Type:</strong> " . ucfirst($leadData['shipment_type']) . " freight</p>
                </div>
                <div style='margin-top: 30px;'>
                    <h3>What happens next?</h3>
                    <ol>
                        <li><strong>Team Review:</strong> We are reviewing your requirements.</li>
                        <li><strong>Expert Contact:</strong> A logistics specialist will call or email you.</li>
                        <li><strong>Quote Delivery:</strong> You'll receive competitive rates shortly.</li>
                    </ol>
                </div>
                <p style='text-align: center; margin-top: 30px;'>
                    <a href='https://wa.me/919944635089?text=Hi%2C+I+just+submitted+a+freight+enquiry+%28Ref%3A+{$refId}%29' style='background-color: #25D366; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;'>Message us on WhatsApp &rarr;</a>
                </p>
            </div>
        ";
        $mail->send();

    } catch (Exception $e) {
        error_log("Email notification failed: {$mail->ErrorInfo}");
    }
}
