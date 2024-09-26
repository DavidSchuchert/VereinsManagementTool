<?php 
// Funktion zum Aktualisieren eines Mitglieds
function updateMember($mysqli, $data)
{
    $id = $data['db_id'] ?? null; 
    if (!$id) {
        throw new Exception("Fehler: 'db_id' wurde nicht gefunden.");
    }

    // Bereinigen der Daten
    unset($data['submitMemberFile']);
    unset($data['saveMember']);
    unset($data['close']);
    unset($data['db_id']);  // Entferne die ID aus den Daten

    $sql = "UPDATE Mitglieder SET ";
    $fields = [];
    foreach ($data as $key => $value) {
        $fields[] = "$key = ?";
    }
    $sql .= implode(", ", $fields);
    $sql .= " WHERE db_id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $types = str_repeat('s', count($data)) . 'i';
        $values = array_values($data);
        $values[] = $id;
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new DDDatabaseException("Fehler beim Aktualisieren des Datensatzes: " . $stmt->error);
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}