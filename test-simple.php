<?php
// test-simple.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>POST Data:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    echo "<h2>FILES Data:</h2>";
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    
    if (isset($_FILES['foto_identitas'])) {
        $file = $_FILES['foto_identitas'];
        echo "<h3>File Details:</h3>";
        echo "Name: " . $file['name'] . "<br>";
        echo "Type: " . $file['type'] . "<br>";
        echo "Size: " . $file['size'] . " bytes<br>";
        echo "Temp: " . $file['tmp_name'] . "<br>";
        echo "Error: " . $file['error'] . "<br>";
        
        // Error code meanings
        $errorMessages = [
            0 => 'UPLOAD_ERR_OK - Tidak ada error',
            1 => 'UPLOAD_ERR_INI_SIZE - File terlalu besar untuk upload_max_filesize',
            2 => 'UPLOAD_ERR_FORM_SIZE - File terlalu besar untuk MAX_FILE_SIZE di form',
            3 => 'UPLOAD_ERR_PARTIAL - File hanya terupload sebagian',
            4 => 'UPLOAD_ERR_NO_FILE - Tidak ada file yang diupload',
            6 => 'UPLOAD_ERR_NO_TMP_DIR - Tidak ada folder temporary',
            7 => 'UPLOAD_ERR_CANT_WRITE - Gagal menulis file ke disk',
            8 => 'UPLOAD_ERR_EXTENSION - Upload dihentikan oleh extension PHP'
        ];
        
        echo "Error Message: " . ($errorMessages[$file['error']] ?? 'Unknown error') . "<br>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Test Simple Upload</title>
</head>

<body>
    <h1>Test Upload Form Sederhana</h1>
    <form method="POST" enctype="multipart/form-data">
        Nama: <input type="text" name="nama"><br><br>
        File: <input type="file" name="foto_identitas"><br><br>
        <button type="submit">Test Upload</button>
    </form>
</body>

</html>