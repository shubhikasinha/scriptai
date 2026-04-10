<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkRole($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        header("Location: /ucfp/login.php");
        exit;
    }
}
