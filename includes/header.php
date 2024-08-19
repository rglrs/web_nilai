<?php
include_once '../functions/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Learning App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php if (isLoggedIn()): ?>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <?php if (getUserLevel() == 'Mahasiswa'): ?>
            <a href="upload.php">Upload Document</a>
        <?php elseif (getUserLevel() == 'Dosen'): ?>
            <a href="grade.php">Grade Students</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </nav>
<?php endif; ?>
