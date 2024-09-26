<?php 

// Funktion zum Löschen eines Mitglieds
function deleteMember($mysqli, $id)
{
    $sql = "DELETE FROM Mitglieder WHERE db_id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new DDDatabaseException("Fehler beim Löschen des Datensatzes: " . $stmt->error);
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}



if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        if (deleteMember($mysqli, $delete_id)) {
            echo "<div class='succ_msg'><p>Mitglied erfolgreich gelöscht!</p></div>";
            header("Location: " . $_SERVER['PHP_SELF'] . "?page=members");
            exit();
        }
    } catch (DDDatabaseException $e) {
        echo "<p>Fehler: " . $e->getMessage() . "</p>";
    }
}