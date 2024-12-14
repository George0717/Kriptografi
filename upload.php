<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Membaca file
    $fileData = file_get_contents($file['tmp_name']);

    // Generate kunci AES secara acak
    $aesKey = openssl_random_pseudo_bytes(32);

    // Enkripsi file menggunakan AES
    $encryptedData = openssl_encrypt($fileData, 'aes-256-cbc', $aesKey, 0, str_repeat("0", 16));

    // Enkripsi kunci AES menggunakan RSA
    $publicKey = file_get_contents('keys/public.pem');
    openssl_public_encrypt($aesKey, $encryptedKey, $publicKey);

    // Simpan file terenkripsi
    $encryptedFileName = 'uploads/' . basename($file['name']) . '.enc';
    file_put_contents($encryptedFileName, $encryptedData);

    // Simpan kunci AES terenkripsi
    $encryptedKeyFileName = 'aes_keys/' . basename($file['name']) . '.key';
    file_put_contents($encryptedKeyFileName, $encryptedKey);

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Upload Success</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <div class='alert alert-success'>
                File berhasil dienkripsi!
            </div>
            <a href='$encryptedFileName' download class='btn btn-primary'>Download Encrypted File</a>
            <a href='$encryptedKeyFileName' download class='btn btn-secondary'>Download Key File</a>
            <a href='index.php' class='btn btn-secondary'>Kembali</a>
        </div>
    </body>
    </html>";
}
?>
