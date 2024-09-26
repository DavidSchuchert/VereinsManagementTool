<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Überprüfe, ob die neue Menge über das Textfeld eingetragen wurde
    if (isset($_POST['update_menge']) && isset($_POST['new_menge'])) {
        $id = $_POST['id'];
        $new_menge = (int)$_POST['new_menge'];

        // Überprüfen, dass die neue Menge eine gültige Zahl ist
        if ($new_menge >= 0) {
            $sql = "UPDATE inventory SET menge = ? WHERE id = ?";

            // Sicherstellen, dass die $id und $new_menge Variablen gesetzt sind
            if (isset($id) && !empty($id)) {
                if ($stmt = $mysqli->prepare($sql)) {
                    // Binde die neue Menge und die ID
                    $stmt->bind_param("ii", $new_menge, $id);
                    if ($stmt->execute()) {
                        echo "<p>Menge erfolgreich aktualisiert!</p>";
                        // Nach der erfolgreichen Ausführung die Seite neu laden
                        header("Location: " . $_SERVER['PHP_SELF'] . "?page=inventory");
                        exit();
                    } else {
                        echo "<p>Fehler beim Ausführen der Abfrage: " . $stmt->error . "</p>";
                    }
                } else {
                    echo "<p>Fehler bei der Vorbereitung der Abfrage: " . $mysqli->error . "</p>";
                }
            } else {
                echo "<p>Fehler: Ungültige Artikel-ID.</p>";
            }
        } else {
            echo "<p>Fehler: Ungültige Menge eingegeben.</p>";
        }
    }
}
