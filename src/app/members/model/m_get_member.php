<?php 
// Funktion zum Abrufen von Mitgliedern
function getMembers($mysqli)
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        return null;
    }
    $sql = "SELECT * FROM Mitglieder WHERE db_id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    return null;
}