<?php

// Orte SQL-Datei ausführen
$orteSql = file_get_contents('../src/config/orte.sql');
if ($mysqli->multi_query($orteSql) === FALSE) {
    die("Fehler beim Erstellen der Orte-Tabelle: " . $mysqli->error);
}

// Warten auf alle Ergebnisse von multi_query
while ($mysqli->more_results() && $mysqli->next_result()) {;
}
