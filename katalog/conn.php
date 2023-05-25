<?php
$fileName = 'katalog.txt';

function getListBuku()
{
    global $fileName;

    $daftarBuku = array();

    if (file_exists($fileName)) {
        $data = file($fileName);

        foreach ($data as $item) {
            $itemArray = explode('|', $item);
            $buku = array(
                'kode' => $itemArray[0],
                'judul' => $itemArray[1],
                'pengarang' => $itemArray[2],
                'penerbit' => $itemArray[3],
                'tahun' => $itemArray[4],
                'cover' => trim($itemArray[5])
            );
            $daftarBuku[] = $buku;
        }
    }

    return $daftarBuku;
}

function addDataBuku($kode, $judul, $pengarang, $penerbit, $tahun, $cover)
{
    global $fileName;

    $bukuBaru = $kode . '|' . $judul . '|' . $pengarang . '|' . $penerbit . '|' . $tahun . '|' . $cover . "\n";

    $daftarBuku = getListBuku();
    foreach ($daftarBuku as $buku) {
        if ($buku['kode'] == $kode) {
            return false;
        }
    }

    file_put_contents($fileName, $bukuBaru, FILE_APPEND);

    return true;
}

function updateDataBuku($kode, $judul, $pengarang, $penerbit, $tahun, $cover)
{
    global $fileName;

    $daftarBuku = getListBuku();
    $dataFound = false;

    foreach ($daftarBuku as $key => $buku) {
        if ($buku['kode'] == $kode) {
            $daftarBuku[$key]['judul'] = $judul;
            $daftarBuku[$key]['pengarang'] = $pengarang;
            $daftarBuku[$key]['penerbit'] = $penerbit;
            $daftarBuku[$key]['tahun'] = $tahun;
            $daftarBuku[$key]['cover'] = $cover;
            $dataFound = true;
            break;
        }
    }

    if ($dataFound) {
        $dataBaru = '';
        foreach ($daftarBuku as $buku) {
            $dataBaru .= $buku['kode'] . '|' . $buku['judul'] . '|' . $buku['pengarang'] . '|' . $buku['penerbit'] . '|' . $buku['tahun'] . '|' . $buku['cover'] . "\n";
        }

        file_put_contents($fileName, $dataBaru);

        return true;
    }

    return false;
}

function deleteDataBuku($kode)
{
    global $fileName;

    $daftarBuku = getListBuku();
    $dataFound = false;

    foreach ($daftarBuku as $key => $buku) {
        if ($buku['kode'] == $kode) {
            unset($daftarBuku[$key]);
            $dataFound = true;
            break;
        }
    }

    if ($dataFound) {
        $dataBaru = '';
        foreach ($daftarBuku as $buku) {
            $dataBaru .= $buku['kode'] . '|' . $buku['judul'] . '|' . $buku['pengarang'] . '|' . $buku['penerbit'] . '|' . $buku['tahun'] . '|' . $buku['cover'] . "\n";
        }

        file_put_contents($fileName, $dataBaru);

        return true;
    }

    return false;
}

function getDataBukuByCode($kode)
{
    $file = 'katalog.txt';

    if (file_exists($file)) {
        $dataBuku = file($file);

        foreach ($dataBuku as $data) {
            $buku = explode("|", $data);

            if ($buku[0] === $kode) {
                return [
                    'kode' => $buku[0],
                    'judul' => $buku[1],
                    'pengarang' => $buku[2],
                    'penerbit' => $buku[3],
                    'tahun' => $buku[4],
                    'cover' => $buku[5]
                ];
            }
        }
    }

    return null;
}

?>
