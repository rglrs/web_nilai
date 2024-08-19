<?php
include '../functions/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (register($_POST['username'], $_POST['password'], $_POST['level'])) {
        header('Location: login.php');
    } else {
        echo "Failed to register";
    }
}
?>

<?php include_once '../includes/header.php'; ?>

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="level">
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>
        </select>
        <button type="submit">Register</button>
    </form>
    <p>Sudah Punya Akun Dosen/Mahasiswa? Silahkan <a href="login.php">Login</a></p>
</div>

<?php include_once '../includes/footer.php'; ?>
