<?php
$delete_id = $_POST['id'];
try {
    if (deleteInventory($mysqli, $delete_id)) {
        echo "<div class='succ_msg'><p>Artikel erfolgreich gelöscht!</p></div>";
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=inventory");
        exit();
    } else {
        echo "<p>Fehler: Artikel konnte nicht gelöscht werden.</p>";
    }
} catch (Exception $e) {
    echo "<p>Fehler: " . $e->getMessage() . "</p>";
};

function deleteInventory($mysqli, $id)
{
    $sql = "DELETE FROM inventory WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Fehler beim Löschen des Artikels: " . $stmt->error);
        }
    } else {
        throw new Exception("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}
