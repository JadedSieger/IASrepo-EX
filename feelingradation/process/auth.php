<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../sakura-mirage/index.php');
    exit;
}
?>