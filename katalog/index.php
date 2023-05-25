<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Katalog Perpustakaan</title>
</head>
<body>
<?php
    include 'conn.php';

    echo '<h3 align=center>KATALOG BUKU PERPUSTAKAAN</h3>';

    $bukuList = getListBuku();

    if (count($bukuList) > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Kode Buku</th>';
        echo '<th>Judul</th>';
        echo '<th>Pengarang</th>';
        echo '<th>Penerbit</th>';
        echo '<th>Tahun Terbit</th>';
        echo '<th>Cover Buku</th>';
        echo '<th>Operasi</th>';
        echo '</tr>';

        foreach ($bukuList as $buku) {
            echo '<tr>';
            echo '<td>' . $buku['kode'] . '</td>';
            echo '<td>' . $buku['judul'] . '</td>';
            echo '<td>' . $buku['pengarang'] . '</td>';
            echo '<td>' . $buku['penerbit'] . '</td>';
            echo '<td>' . $buku['tahun'] . '</td>';
            echo '<td><img src="bookCover/' . $buku['cover'] . '" alt="Cover Buku"></td>';
            echo '<td>';
            echo '<a href="update.php?kode=' . $buku['kode'] . '" class="button">Update</a> | ';
            echo '<a href="delete.php?kode=' . $buku['kode'] . '" class="button">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>Belum ada buku yang ditambahkan.</p>';
    }
    ?>

    <a href="create.php" class="button" style="margin: 20px 525px;">Tambah Buku</a>

</body>
</html>
