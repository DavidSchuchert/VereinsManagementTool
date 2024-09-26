<?php 

    // Config-Datei erstellen
    $configContent = "<?php\n";
    $configContent .= "mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);\n";
    $configContent .= "\$mysqli = new mysqli('$host', '$username', '$password', '$dbname');\n";
    $configContent .= "\$mysqli->set_charset('utf8mb4');\n";
    $configContent .= "if (\$mysqli->connect_errno) {\n";
    $configContent .= "    throw new RuntimeException('mysqli-Verbindungsfehler: ' . \$mysqli->connect_error);\n";
    $configContent .= "}\n\n";

    $configContent .= "// Vereinskonfiguration abrufen und in Variablen speichern\n";
    $configContent .= "\$config = [];\n";
    $configContent .= "\$query = \"SELECT config_key, config_value FROM config\";\n";
    $configContent .= "\$result = \$mysqli->query(\$query);\n\n";

    $configContent .= "if (\$result) {\n";
    $configContent .= "    while (\$row = \$result->fetch_assoc()) {\n";
    $configContent .= "        \$config[\$row['config_key']] = \$row['config_value'];\n";
    $configContent .= "    }\n";
    $configContent .= "}\n\n";

    $configContent .= "// Globale Variablen definieren\n";
    $configContent .= "\$vereinName = isset(\$config['verein_name']) ? \$config['verein_name'] : '';\n";
    $configContent .= "\$logoPath = isset(\$config['logo_path']) ? \$config['logo_path'] : '';\n";
    $configContent .= "?>";

    if (!file_put_contents('../src/config/config.db.php', $configContent)) {
        die("Fehler beim Erstellen der Konfigurationsdatei.");
    }
    // Erfolgsnachricht
    echo "<p>Setup erfolgreich abgeschlossen!</p>";
    echo "<p>Datenbank wurde erstellt und die Konfiguration gespeichert.</p>";
    echo "<a href='index.php'>Zur Startseite</a>";
    // Lock-Datei erstellen
    $lockFile = '../src/config/setup.lock';
    file_put_contents($lockFile, 'Setup abgeschlossen.');
    exit();