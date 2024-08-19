<?php
session_start();
include '../db/config.php';

if (!function_exists('register')) {
    function register($username, $password, $level) {
        global $conn;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, level) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $level);
        return $stmt->execute();
    }
}

if (!function_exists('login')) {
    function login($username, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }
}

function getUploads() {
    global $conn;
    $stmt = $conn->prepare("SELECT uploads.id, users.username, uploads.filename, uploads.grade FROM uploads JOIN users ON uploads.user_id = users.id WHERE users.level = 'Mahasiswa'");
    $stmt->execute();
    return $stmt->get_result();
}

function updateGrade($uploadId, $grade) {
    global $conn;
    $stmt = $conn->prepare("UPDATE uploads SET grade = ? WHERE id = ?");
    $stmt->bind_param("ii", $grade, $uploadId);
    return $stmt->execute();
}


if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}

if (!function_exists('logout')) {
    function logout() {
        session_destroy();
        unset($_SESSION['user']);
    }
}

if (!function_exists('getUserLevel')) {
    function getUserLevel() {
        return $_SESSION['user']['level'];
    }
}
?>
