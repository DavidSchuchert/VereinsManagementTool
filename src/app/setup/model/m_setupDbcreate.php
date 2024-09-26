<?php
    // Datenbank erstellen
    $createDbSql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if ($mysqli->query($createDbSql) === FALSE) {
        die("Fehler beim Erstellen der Datenbank: " . $mysqli->error);
    }
