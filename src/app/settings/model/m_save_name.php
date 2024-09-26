<?php
if (isset($_POST['vereinName'])) {
    $newName = $_POST['vereinName'];

    $stmt = $mysqli->prepare("UPDATE config SET config_value= ? WHERE config_key='verein_name'");

    $stmt->bind_param("s", $newName);

    if ($stmt->execute()) {
        echo "Vereinsname erfolgreich aktualisiert.";
    } else {
        echo "Fehler beim Aktualisieren des Vereinsnamens: " . $stmt->error;
    };
}
