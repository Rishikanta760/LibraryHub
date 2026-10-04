<?php
$sessionDir = __DIR__ . DIRECTORY_SEPARATOR . 'sessions';
if (!is_dir($sessionDir)) mkdir($sessionDir, 0775, true);
session_save_path($sessionDir);
if (session_status() === PHP_SESSION_NONE) session_start();
$conn = mysqli_connect("localhost","root","","library_management");

if(!$conn)
{
die("Database Connection Failed");
}

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function admin_only() { if (empty($_SESSION['admin'])) { header('Location: index.php'); exit; } }
function student_only() { if (empty($_SESSION['student'])) { header('Location: index.php'); exit; } }

?>
