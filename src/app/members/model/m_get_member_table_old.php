<?php 

// Funktion zum Abrufen der Tabelle der Mitglieder
function getMembersTable($mysqli)
{
    $headers = getTableHeaders('Mitglieder', $mysqli);
    $tableHTML = "<table>";
    $tableHTML .= "<tr>";

    // Füge die Spaltenüberschriften hinzu
    foreach ($headers as $header) {
        if ($header !== 'file_path') {  // Vermeide leere Header-Zellen
            $tableHTML .= "<th>" . htmlspecialchars($header) . "</th>";
        }
    }

    // Füge die Spaltenüberschriften für Datei, Bearbeiten und Löschen hinzu
    $tableHTML .= "<th>Ort</th>"; // Neue Spalte für den Ort
    $tableHTML .= "<th>Datei</th>";
    $tableHTML .= "<th>Bearbeiten</th>";
    $tableHTML .= "<th>Löschen</th>";
    $tableHTML .= "</tr>";

    // SQL-Abfrage mit Join
    $sql = "SELECT Mitglieder.*, Orte.Ort
            FROM Mitglieder
            LEFT JOIN Orte ON Mitglieder.PLZ = Orte.PLZ"; // Verknüpfung der Tabellen

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $tableHTML .= "<tr>";
            foreach ($headers as $header) {
                if ($header !== 'file_path') {
                    $tableHTML .= "<td>" . htmlspecialchars($row[$header] ?? '') . "</td>";
                }
            }
            // Ort hinzufügen
            $tableHTML .= "<td>" . htmlspecialchars($row['Ort'] ?? 'Nicht verfügbar') . "</td>";

            // Datei-Link oder Upload-Formular
            if (!empty($row['file_path'])) {
                // Datei-Link anzeigen
                $tableHTML .= "<td><a href='../uploads/member/" . htmlspecialchars($row['file_path']) . "' target='_blank'>" . htmlspecialchars($row['file_path']) . "</a></td>";
            } else {
                // Upload-Formular anzeigen
                $tableHTML .= "<td>
                    <form class='file_upload' action='' method='post' enctype='multipart/form-data'>
                        <input type='file' name='fileToUpload' id='fileToUpload'>
                        <input type='submit' value='>' name='submitMemberFile" . htmlspecialchars($row['db_id']) . "'>
                    </form>
                </td>";
            }

            // Bearbeiten- und Löschen-Links
            $tableHTML .= "<td><a href='?page=members&id=" . htmlspecialchars($row['db_id']) . "'>Bearbeiten</a></td>";
            $tableHTML .= "<td><a href='?page=members&delete_id=" . htmlspecialchars($row['db_id']) . "' class='delete-btn' onclick='return confirmDelete();'>Löschen</a></td>";
            $tableHTML .= "</tr>";
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Abfrage der Mitglieder: " . $mysqli->error);
    }

    $tableHTML .= "</table>";
    $tableHTML .= "<p>Gesamtanzahl der Mitglieder: <b>" . getTableCount('Mitglieder', $mysqli) . "</b></p>";

    return $tableHTML;
}
