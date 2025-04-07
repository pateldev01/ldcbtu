<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'devpatelodmantis@gmail.com';
    $mail->Password = 'qdhf oujp grvt nqdm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('devpatelodmantis@gmail.com', 'LD Capital Bridge');
    $mail->addAddress('info@ldcbtusa.com');

    $mail->isHTML(true);
    $mail->Subject = 'New Brochure Request: ' . $data['brochure'];
    $mail->Body = "
        <h2>New Brochure Request</h2>
        <p><strong>Name:</strong> {$data['name']}</p>
        <p><strong>Email:</strong> {$data['email']}</p>
        <p><strong>Phone:</strong> {$data['phone']}</p>
        <p><strong>Interest:</strong> {$data['interest']}</p>
        <p><strong>Message:</strong> {$data['message']}</p>
        <p><strong>Requested Brochure:</strong> {$data['brochure']}</p>
    ";

    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $mail->ErrorInfo]);
}
?>