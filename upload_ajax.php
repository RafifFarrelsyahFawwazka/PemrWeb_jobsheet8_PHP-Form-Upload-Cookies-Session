<?php
if (isset($_FILES['file'])) {
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp  = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    // Baris 9 (Baru): Simpan array hasil explode ke variabel $file_parts
    $file_parts = explode('.', $_FILES['file']['name']);

    // Baris 10 (Baru): Gunakan variabel nyata $file_parts di fungsi end()
    $file_ext = strtolower(end($file_parts));
    
    // --- KODE YANG DIUBAH MULAI DI SINI ---
    $extensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Ekstensi file yang diizinkan adalah JPG, JPEG, PNG, atau GIF."; // Pesan kesalahan juga diubah
    }
    // --- KODE YANG DIUBAH SELESAI DI SINI ---

    if ($file_size > 2097152) { // 2097152 bytes = 2MB
        $errors[] = 'Ukuran file tidak boleh lebih dari 2 MB';
    }

    if (empty($errors) === true) {
        // Asumsi folder 'documents/' masih digunakan, atau ganti ke 'images/' jika perlu
        move_uploaded_file($file_tmp, "documents/" . $file_name);
        echo "File berhasil diunggah.";
    } else {
        echo implode(" ", $errors);
    }
}
?>