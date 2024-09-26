<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_inventory'])) {
    $data = $_POST;
    unset($data['add_inventory']);

    $sql = "INSERT INTO inventory (artikel, ean, menge, bemerkungen, lagerstandort) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssiss", $data['artikel'], $data['ean'], $data['menge'], $data['bemerkungen'], $data['lagerstandort']);
        if ($stmt->execute()) {
            echo "<p>Artikel erfolgreich hinzugefügt!</p>";
        } else {
            throw new Exception("Fehler beim Hinzufügen des Artikels: " . $stmt->error);
        }
    }
}
?>
