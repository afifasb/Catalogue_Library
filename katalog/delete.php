<?php
include 'conn.php';

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    if (deleteDataBuku($kode)) {
        echo "<p>Data Buku berhasil dihapus.</p>";
    } else {
        echo "<p>Gagal menghapus data buku. Kode buku tidak ditemukan.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Hapus Data</title>
</head>
<body>
    <a href="index.php" class="button"  style="margin: 20px 525px;">Back</a>
</body>
</html>
