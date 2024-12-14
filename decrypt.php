<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decrypt File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">Decrypt File</h1>
            <p class="text-muted">Unggah file terenkripsi untuk mendekripsinya menggunakan kunci privat RSA.</p>
        </div>
        <div class="card shadow-sm mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="decrypt.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="encryptedFile" class="form-label">Pilih File Terenkripsi</label>
                        <input type="file" class="form-control" id="encryptedFile" name="encryptedFile" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Decrypt File</button>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['encryptedFile'])) {
            $file = $_FILES['encryptedFile'];

            // Path kunci privat
            $privateKey = file_get_contents('keys/private.pem');

            // Membaca konten file terenkripsi
            $encryptedData = file_get_contents($file['tmp_name']);

            // Dekripsi dengan RSA
            openssl_private_decrypt($encryptedData, $decryptedData, $privateKey);

            if ($decryptedData) {
                echo "
                <div class='mt-4 text-center'>
                    <h3>File Berhasil Didekripsi:</h3>
                    <textarea class='form-control' rows='5'>" . htmlspecialchars($decryptedData) . "</textarea>
                </div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Gagal mendekripsi file. Pastikan file valid.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
