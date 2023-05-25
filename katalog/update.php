<?php
include 'conn.php';

if (isset($_POST['update'])) {
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    $cover = uploadCover();

    if ($cover !== false) {
        if (updateDataBuku($kode, $judul, $pengarang, $penerbit, $tahun, $cover)) {
            echo "<p>Data Buku berhasil diupdate.</p>";
        } else {
            echo "<p>Gagal mengupdate data buku.</p>";
        }
    } else {
        echo "<p>Gagal mengupload cover buku.</p>";
    }
    
}

// Fungsi untuk upload cover buku
function uploadCover()
{
    $fileName = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];

    if ($error === 4) {
        return false;
    }

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg'];
    $ekstensiGambar = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        return false;
    }

    $maxSize = 2 * 1024 * 1024;
    if ($ukuranFile > $maxSize) {
        return false;
    }

    $fileNameBaru = uniqid() . '.' . $ekstensiGambar;

    move_uploaded_file($tmpName, 'bookCover/' . $fileNameBaru);

    return $fileNameBaru;
}

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $buku = getDataBukuByCode($kode);

    if ($buku === null) {
        echo "<p>Buku tidak ditemukan.</p>";
        exit();
    }
} else {
    //echo "<p>Parameter kode tidak ditemukan.</p>";
    exit();
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
    <title>Update Data Buku</title>
</head>
<body>
    <h2>Update Buku</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update" value="1">
        <input type="hidden" name="kode" value="<?php echo isset($buku['kode']) ? $buku['kode'] : ''; ?>">
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" value="<?php echo isset($buku['judul']) ? $buku['judul'] : ''; ?>" required><br>
        <label for="pengarang">Pengarang:</label>
        <input type="text" id="pengarang" name="pengarang" value="<?php echo isset($buku['pengarang']) ? $buku['pengarang'] : ''; ?>" required><br>
        <label for="penerbit">Penerbit:</label>
        <input type="text" id="penerbit" name="penerbit" value="<?php echo isset($buku['penerbit']) ? $buku['penerbit'] : ''; ?>" required><br>
        <label for="tahun">Tahun Terbit:</label>
        <input type="number" id="tahun" name="tahun" value="<?php echo isset($buku['tahun']) ? $buku['tahun'] : ''; ?>" required><br>
        <label for="cover">Cover Buku:</label>
        <input type="file" id="cover" name="cover" accept="image/png, image/jpeg, image/jpg"><br>
        <?php if (isset($buku['cover'])): ?>
            <img src="bookCover/<?php echo $buku['cover']; ?>" alt="Cover Buku"><br>
        <?php endif; ?>
        <input type="submit" value="Update Buku" class="button">
    </form>
</body>
</html>