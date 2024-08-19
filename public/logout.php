<?php
include '../functions/auth.php';
logout();
header('Location: login.php');
exit;
?>
