<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">Secure File Upload</h1>
            <p class="text-muted">Upload file Anda, dan file akan dienkripsi menggunakan algoritma RSA.</p>
        </div>
        <div class="card shadow-sm mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Upload & Encrypt</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
