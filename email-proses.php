<?php

use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'ovanyx@gmail.com';
$mail->Password   = 'dmtzuukliotfkrwp';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;

if (isset($_POST['kirim'])) {
    $mail->setFrom('ovanyx@gmail.com', 'Full CRUD PHP MySQL');
    $mail->addAddress($_POST['emailPenerima']);
    $mail->addReplyTo('ovanyx@gmail.com', 'Full CRUD PHP MySQL');

    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['pesan'];

    if ($mail->send()) {
        echo "<script>
                alert('Email Berhasil Dikirimkan');
                document.location.href = 'email.php';
            </script>";
    } else {
        echo "<script>
                alert('Email Gagal Dikirimkan');
                document.location.href = 'email.php';
            </script>";
    }
}
