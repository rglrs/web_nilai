<?php
include '../functions/auth.php';

if (!isLoggedIn() || getUserLevel() != 'Dosen') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['upload_id']) && isset($_POST['grade'])) {
        if (updateGrade($_POST['upload_id'], $_POST['grade'])) {
            echo "Grade assigned successfully";
        } else {
            echo "Failed to assign grade";
        }
    }
}

$uploads = getUploads();
?>

<?php include_once '../includes/header.php'; ?>

<div class="container">
    <h2>Grade Student Uploads</h2>
    <table>
        <tr>
            <th>Student</th>
            <th>File</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
        <?php while ($upload = $uploads->fetch_assoc()): ?>
        <tr>
            <td><?php echo $upload['username']; ?></td>
            <td><a href="../uploads/<?php echo $upload['filename']; ?>" target="_blank"><?php echo $upload['filename']; ?></a></td>
            <td><?php echo $upload['grade'] === null ? 'Not graded' : $upload['grade']; ?></td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="upload_id" value="<?php echo $upload['id']; ?>">
                    <input type="number" name="grade" placeholder="Grade" required>
                    <button type="submit">Assign Grade</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>
