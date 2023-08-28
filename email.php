<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Kirim Email";

include 'layout/header.php';

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
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');
}

// if (isset($_POST['kirim'])) {
//     if (create_barang($_POST) > 0) {
//         echo "<script>
//                 alert('Data Barang Berhasil Ditambahkan');
//                 document.location.href = 'index.php';
//                 </script>";
//     } else {
//         echo "<script>
//                 alert('Data Barang Gagal Ditambahkan');
//                 document.location.href = 'index.php';
//                 </script>";
//     }
// }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <i class="fas fa-envelope"></i>
        <h1>Kirim Email</h1>
        <hr>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email Penerima</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email Penerima..." required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="number" class="form-control" id="subject" name="subject" placeholder="Subject..." required>
            </div>
            <div class="mb-3">
                <label for="Pesan" class="form-label">Pesan</label>
                <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control" placeholder="Tuliskan pesan yang ingin dikirim..." required></textarea>
            </div>
            <button type="submit" name="kirim" class="btn btn-primary" style="float: right;">Kirim</button>
        </form>
    </div>
</div>
<?php include 'layout/footer.php'; ?>