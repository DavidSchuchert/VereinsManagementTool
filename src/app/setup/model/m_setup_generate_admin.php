<?php

$hashedPassword = password_hash($adminPassword, PASSWORD_BCRYPT);
$insertConfigSql = "
        INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE username = VALUES(username),
                                email = VALUES(email),
                                password_hash = VALUES(password_hash);
        ";

$stmt = $mysqli->prepare($insertConfigSql);
$stmt->bind_param('sss', $adminUsername, $adminEmail, $hashedPassword);

if ($stmt->execute() === FALSE) {
    die("Fehler beim Speichern des Admin-Kontos: " . $stmt->error);
}
