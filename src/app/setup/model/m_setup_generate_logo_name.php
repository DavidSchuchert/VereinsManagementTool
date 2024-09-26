<?php 
// Logo speichern
if ($vereinLogo && $vereinLogo['tmp_name']) {
    $logoPath = '../public/images/' . basename($vereinLogo['name']);
    if (!move_uploaded_file($vereinLogo['tmp_name'], $logoPath)) {
        die("Fehler beim Hochladen des Logos");
    }
    
} else {
    $logoPath = ''; // Falls kein Logo hochgeladen wurde
}

// Konfiguration in die Datenbank speichern
$insertConfigSql = "
        INSERT INTO config (config_key, config_value) VALUES ('verein_name', ?)
        ON DUPLICATE KEY UPDATE config_value = VALUES(config_value);
    ";
$stmt = $mysqli->prepare($insertConfigSql);
$stmt->bind_param('s', $vereinName);

if ($stmt->execute() === FALSE) {
    die("Fehler beim Speichern der Vereinskonfiguration: " . $stmt->error);
}

$insertConfigSql = "
        INSERT INTO config (config_key, config_value) VALUES ('logo_path', ?)
        ON DUPLICATE KEY UPDATE config_value = VALUES(config_value);
    ";

$stmt = $mysqli->prepare($insertConfigSql);
$stmt->bind_param('s', $logoPath);

if ($stmt->execute() === FALSE) {
    die("Fehler beim Speichern des Logos: " . $stmt->error);
}