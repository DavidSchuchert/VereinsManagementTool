<?php

// Exception-Klasse für Datenbankfehler
class DDDatabaseException extends Exception
{
}



// Funktion zum Abrufen der Tabellenköpfe (Spaltennamen) einer Tabelle
function getTableHeaders($tableName, $mysqli)
{
    $headers = [];
    $sql = "SHOW COLUMNS FROM " . $tableName;

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $headers[] = $row['Field'];
        }
    } else {
        throw new DDDatabaseException("Fehler: " . $mysqli->error);
    }

    return $headers;
}


// Hilfsfunktion zur Ermittlung der Mitgliederanzahl
function getTableCount($table, $mysqli)
{
    $sql = "SELECT COUNT(*) as member_count FROM $table";
    if ($result = $mysqli->query($sql)) {
        $row = $result->fetch_assoc();
        return $row['member_count'];
    } else {
        throw new DDDatabaseException("Fehler bei der Abfrage der Mitgliederanzahl: " . $mysqli->error);
    }
}


function uploadFile(
    $fileInputName, 
    $targetDirectory, 
    $maxFileSize, 
    $allowedFileTypes, 
    $id, 
    $mysqli, 
    $dbTable, 
    $dbColumn, 
    $primaryKey
)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES[$fileInputName])) {
        $targetDir = rtrim($targetDirectory, '/') . '/';  // Sicherstellen, dass das Verzeichnis korrekt endet
        $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
        $uploadOk = true;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Überprüfen, ob die Datei bereits existiert
        if (file_exists($targetFile)) {
            echo "Entschuldigung, die Datei existiert bereits.<br>";
            $uploadOk = false;
        }

        // Überprüfen der Dateigröße
        if ($_FILES[$fileInputName]["size"] > $maxFileSize) {
            echo "Entschuldigung, die Datei ist zu groß.<br>";
            $uploadOk = false;
        }

        // Überprüfen des Dateityps
        if (!in_array($fileType, $allowedFileTypes)) {
            echo "Entschuldigung, nur folgende Dateitypen sind erlaubt: " . implode(', ', $allowedFileTypes) . ".<br>";
            $uploadOk = false;
        }

        // Überprüfen, ob $uploadOk auf false gesetzt wurde (Fehler)
        if ($uploadOk === false) {
            echo "Entschuldigung, Ihre Datei wurde nicht hochgeladen.<br>";
        } else {
            // Versuchen, die Datei hochzuladen
            if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
                echo "<div class='succ_msg'>Die Datei " . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . " wurde erfolgreich hochgeladen.<br></div>";

                // Pfad zur Datei in der Datenbank speichern
                $filePath = basename($_FILES[$fileInputName]["name"]);
                $sql = "UPDATE $dbTable SET $dbColumn = ? WHERE $primaryKey = ?";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param('si', $filePath, $id);
                    if (!$stmt->execute()) {
                        echo "Fehler beim Speichern des Dateipfads: " . $stmt->error . "<br>";
                    }
                }
            } else {
                echo "Entschuldigung, es gab einen Fehler beim Hochladen Ihrer Datei.<br>";
            }
        }
    }
}
