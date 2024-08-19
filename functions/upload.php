<?php
function uploadDocument($user_id, $file) {
    global $conn;
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO uploads (user_id, filename) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $file["name"]);
        return $stmt->execute();
    }
    return false;
}
?>
