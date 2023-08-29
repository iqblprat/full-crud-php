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

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <i class="fas fa-envelope"></i>
        <h1>Kirim Email</h1>
        <hr>
        <form action="email-proses.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email Penerima</label>
                <input type="email" class="form-control" id="email" name="emailPenerima" placeholder="Email Penerima..." required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject..." required>
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