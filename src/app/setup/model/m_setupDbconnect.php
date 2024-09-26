<?php
$host = trim($_POST['db_host']);
$username = trim($_POST['db_username']);
$password = trim($_POST['db_password']);
$dbname = trim($_POST['db_name']);
$vereinName = trim($_POST['verein_name']);
$vereinLogo = $_FILES['verein_logo'];
$adminUsername = trim($_POST['admin_username']);
$adminEmail = trim($_POST['admin_email']);
$adminPassword = trim($_POST['admin_password']);

// Verbindung zur Datenbank herstellen
$mysqli = new mysqli($host, $username, $password);
$mysqli->query("SET NAMES 'utf8mb4'");
$mysqli->query("SET CHARACTER SET 'utf8mb4'");
$mysqli->query("SET collation_connection = 'utf8mb4_general_ci'");

if ($mysqli->connect_errno) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $mysqli->connect_error);
}
?>