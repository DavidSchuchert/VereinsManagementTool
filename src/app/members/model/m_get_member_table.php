<?php

// Funktion zum Abrufen der Tabelle der Mitglieder
function getMembersTable($mysqli)
{
    // SQL-Abfrage mit Join
    $sql = "SELECT Mitglieder.*, Orte.Ort
            FROM Mitglieder
            LEFT JOIN Orte ON Mitglieder.PLZ = Orte.PLZ"; // Verknüpfung der Tabellen


    echo "<section class='members_accordion'>";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            echo "<details><summary class='accordion_summary'>" . $row['Vorname'] . " " . $row["Nachname"] .  "</summary>";
            echo "<div class='accordion_data'>";
            echo "<p>" . "<b>ID:</b> " . $row["ID"] . "</p>";
            echo "<p>" . "<b>Geburtstag:</b> " . $row["Geburtstag"] . "</p>";
            echo "<p>" . "<b>Telefon:</b> " . $row["TEL"] . "</p>";
            echo "<p>" . "<b>E-Mail:</b> " . $row["Mail"] . "</p>";
            echo "<p>" . "<b>Rang:</b> " . $row["Rang"] . "</p>";
            echo "<p>" . "<b>Beitritt:</b> " . $row["Beitritt"] . "</p>";
            echo "<p>" . "<b>Austritt:</b> " . $row["Austritt"] . "</p>";
            echo "<p>" . "<b>PLZ:</b> " . $row["PLZ"] . "</p>";
            echo "<p>" . "<b>Ort:</b> " . $row["Ort"] . "</p>";
            echo "<p>" . "<b>Adresse:</b> " . $row["Strasse"] . " " . $row["HausNr"] . "</p>";

            if (empty($row['file_path'])) {
                echo "<p><b>Dateipfad:</b> <form class='file_upload' action='' method='post' enctype='multipart/form-data'>
                        <input type='file' name='fileToUpload' id='fileToUpload'>
                        <input type='submit' value='>' name='submitMemberFile" . htmlspecialchars($row['db_id']) . "'>
                      </form></p>";
            } else {
                echo "<p><b>Dateipfad:</b> <a class='accordion_href' href='../uploads/member/" . htmlspecialchars($row['file_path']) . "' target='_blank'>" . htmlspecialchars($row['file_path']) . "</a></p>";
            }

            echo "<p><b>Bearbeiten:</b> <a class='accordion_href' href='?page=members&id=" . htmlspecialchars($row['db_id']) . "'>Bearbeiten</a></p>";
            echo "</details></div>";
        }
        echo "</section>";
    } else {
        throw new DDDatabaseException("Fehler bei der Abfrage der Mitglieder: " . $mysqli->error);
    }
}
