<?php

// Prüfen, ob eine Transaktion gelöscht werden soll
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        // Transaktion löschen
        if (deleteTransaction($mysqli, $delete_id)) {
            echo "<div class='succ_msg'><p>Transaktion erfolgreich gelöscht!</p></div>";
            // Redirect, um die URL zu bereinigen und ein erneutes Löschen zu verhindern
            header("Location: " . $_SERVER['PHP_SELF'] . "?page=transactions");
            exit();
        } else {
            echo "<p>Fehler: Transaktion konnte nicht gelöscht werden.</p>";
        }
    } catch (DDDatabaseException $e) {
        echo "<p>Fehler: " . $e->getMessage() . "</p>";
    }
}

function deleteTransaction($mysqli, $id)
{
    $sql = "DELETE FROM zahlungen WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new DDDatabaseException("Fehler beim Löschen der Transaktion: " . $stmt->error);
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}