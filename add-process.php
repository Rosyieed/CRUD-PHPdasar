<?php
include 'koneksi.php';

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Periksa apakah file diunggah
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $thumbnail = $_FILES['thumbnail'];

        $extension_allowed = array('png', 'jpg');
        $name = $thumbnail['name'];
        $x = explode('.', $name);
        $extension = strtolower(end($x));
        $size = $thumbnail['size'];
        $file_tmp = $thumbnail['tmp_name'];

        if (in_array($extension, $extension_allowed) === true) {
            if ($size < 1044070) {
                move_uploaded_file($file_tmp, 'images/' . $name);
                $query = mysqli_query($koneksi, "INSERT INTO articles VALUES(NULL, '$title', '$content', '$category', '$name')");
                if ($query) {
                    $message = "Data berhasil ditambahkan";
                    $message = urlencode($message);
                    header("Location: index.php?message={$message}");
                    exit();
                } else {
                    $message = "Data gagal ditambahkan";
                    $message = urlencode($message);
                    header("Location: add.php?message={$message}");
                    exit();
                }
            } else {
                $message = "Ukuran File Terlalu Besar";
                $message = urlencode($message);
                header("Location: add.php?message={$message}");
                exit();
            }
        } else {
            $message = "Extension tidak diperbolehkan";
            $message = urlencode($message);
            header("Location: add.php?message={$message}");
            exit();
        }
    } else {
        $message = "File thumbnail tidak ditemukan atau gagal diunggah";
        $message = urlencode($message);
        header("Location: add.php?message={$message}");
        exit();
    }
}
