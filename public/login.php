<?php
include '../functions/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (login($_POST['username'], $_POST['password'])) {
        header('Location: dashboard.php');
    } else {
        echo "Invalid login credentials";
    }
}
?>

<?php include_once '../includes/header.php'; ?>

<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Belum Punya Akun Dosen/Mahasiswa? Silahkan <a href="register.php">Register</a></p>
</div>

<?php include_once '../includes/footer.php'; ?>
