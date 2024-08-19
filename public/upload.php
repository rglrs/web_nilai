<?php
include '../functions/auth.php';
include '../functions/upload.php';

if (!isLoggedIn() || getUserLevel() != 'Mahasiswa') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (uploadDocument($_SESSION['user']['id'], $_FILES['document'])) {
        echo "File uploaded successfully";
    } else {
        echo "Failed to upload file";
    }
}
?>

<?php include_once '../includes/header.php'; ?>

<div class="container">
    <h2>Upload Document</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="document" required>
        <button type="submit">Upload</button>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>
