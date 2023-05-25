<?php
include 'conn.php';

if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    $cover = uploadCover();

    if ($cover) {
        if (addDataBuku($kode, $judul, $pengarang, $penerbit, $tahun, $cover)) {
            echo "<p>Data Buku berhasil ditambahkan.</p>";
        } else {
            echo "<p>Gagal menambahkan data buku. Kode buku yang ditambahkan sudah ada.</p>";
        }
    } else {
        echo "<p>Gagal mengupload cover buku.</p>";
    }
}

// Fungsi upload cover buku
function uploadCover()
{
    $fileName = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];

    if ($error === 4) {
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ekstensiFile, $ekstensiValid)) {
        return false;
    }

    if ($ukuranFile > 5 * 1024 * 1024) {
        return false;
    }

    $fileNameBaru = uniqid() . '.' . $ekstensiFile;

    move_uploaded_file($tmpName, 'bookCover/' . $fileNameBaru);

    return $fileNameBaru;
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
    <title>Tambah Data Buku</title>
</head>
<body>
    <h2>Tambah Buku</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tambah" value="1">
        <label for="kode">Kode Buku:</label>
        <input type="text" id="kode" name="kode" required><br>
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" required><br>
        <label for="pengarang">Pengarang:</label>
        <input type="text" id="pengarang" name="pengarang" required><br>
        <label for="penerbit">Penerbit:</label>
        <input type="text" id="penerbit" name="penerbit" required><br>
        <label for="tahun">Tahun Terbit:</label>
        <input type="number" id="tahun" name="tahun" required><br>
        <label for="cover">Cover Buku:</label>
        <input type="file" id="cover" name="cover" accept="image/png, image/jpeg, image/jpg" required><br>
        <input type="submit" value="Tambah Buku" class="button">
    </form>
<a href="index.php" class="button"  style="margin: 20px 525px;">Back</a></body>
</html>