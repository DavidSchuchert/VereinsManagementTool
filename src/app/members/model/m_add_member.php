<?php 

// Funktion zum Hinzufügen eines Mitglieds
function addMember($mysqli, $data)
{
    unset($data['db_id']);
    $sql = "INSERT INTO Mitglieder (";
    $sql .= implode(", ", array_keys($data));
    $sql .= ") VALUES (";
    $sql .= implode(", ", array_fill(0, count($data), '?'));
    $sql .= ")";
    if ($stmt = $mysqli->prepare($sql)) {
        $types = str_repeat('s', count($data));
        $values = array_values($data);
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new DDDatabaseException("Fehler beim Einfügen des Datensatzes: " . $stmt->error);
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}
