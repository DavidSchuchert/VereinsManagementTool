<?php
// Tabellen erstellen
$tablesSql = "
CREATE TABLE IF NOT EXISTS Mitglieder (
    db_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ID INT(11) UNSIGNED NOT NULL,
    Vorname VARCHAR(100) NOT NULL,
    Nachname VARCHAR(100) NOT NULL,
    Geburtstag DATE NOT NULL,
    PLZ VARCHAR(100) NOT NULL,
    TEL VARCHAR(50),
    Mail VARCHAR(100),
    Rang ENUM('Gruendungsmitglied','Supportmitglied','Ordentlichesmitglied','sonstiges') NOT NULL,
    Beitritt VARCHAR(100),
    Austritt VARCHAR(100),
    Strasse VARCHAR(255),
    HausNr VARCHAR(100),
    file_path VARCHAR(100)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS zahlungen (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    betrag DECIMAL(10, 2) NOT NULL,
    datum VARCHAR(100) NOT NULL,
    zahlungsart ENUM('PayPal', 'Banküberweisung', 'Kreditkarte', 'Andere') NOT NULL,
    typ ENUM('Einnahme', 'Ausgabe') NOT NULL,
    beschreibung TEXT,
    rechnungsnr VARCHAR(50),
    erstellt_am TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    aktualisiert_am TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    file_path VARCHAR(255)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS users (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS config (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    config_key VARCHAR(100) NOT NULL,
    config_value TEXT NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` varchar(255) NOT NULL,
  `ean` varchar(255) NOT NULL,
  `menge` int(11) NOT NULL DEFAULT 0,
  `bemerkungen` text NOT NULL,
  `lagerstandort` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
";

if ($mysqli->multi_query($tablesSql) === FALSE) {
    die("Fehler beim Erstellen der Tabellen: " . $mysqli->error);
}

// Warten auf alle Ergebnisse von multi_query
while ($mysqli->more_results() && $mysqli->next_result()) {;
}
