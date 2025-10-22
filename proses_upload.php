<?php
// Lokasi penyimpanan file yang diunggah
$targetDirectory = "uploads/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Periksa apakah ada file yang diunggah
if (!empty($_FILES['images']['name'][0])) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = basename($_FILES['images']['name'][$i]);
        $targetFile = $targetDirectory . $fileName;

        // Ambil ekstensi file
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi tipe file
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFile)) {
                echo "Gambar <b>$fileName</b> berhasil diunggah.<br>";
            } else {
                echo "Gagal mengunggah gambar <b>$fileName</b>.<br>";
            }
        } else {
            echo "File <b>$fileName</b> ditolak (bukan gambar yang valid).<br>";
        }
    }
} else {
    echo "Tidak ada gambar yang diunggah.";
}
?>
