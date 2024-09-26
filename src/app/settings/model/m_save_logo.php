<?php
if (isset($_FILES['verein_logo']) && $_FILES['verein_logo']['error'] == 0) {

    $logoDir = '../public/images/';

    if (!is_dir($logoDir)) {
        die("Fehler: Das Verzeichnis '$logoDir' existiert nicht.");
    }
    $logoFile = $logoDir . basename($_FILES['verein_logo']['name']);

    $imageFileType = strtolower(pathinfo($logoFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    $check = getimagesize($_FILES['verein_logo']['tmp_name']);
    if ($check !== false) {

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['verein_logo']['tmp_name'], $logoFile)) {
                echo "Logo erfolgreich hochgeladen: " . $logoFile;
                $newLogoPath = $logoFile;
                echo $newLogoPath;
                $stmt = $mysqli->prepare("UPDATE config SET config_value= ? WHERE config_key='logo_path'");

                $stmt->bind_param("s", $newLogoPath);

                if ($stmt->execute()) {
                    echo "Vereinslogo erfolgreich aktualisiert.";
                } else {
                    echo "Fehler beim Aktualisieren des Vereinslogos: " . $stmt->error;
                };
            } else {
                die("Fehler beim Hochladen des Logos.");
            }
        } else {
            echo "Nur JPG, JPEG, PNG und GIF-Dateien sind erlaubt.";
        }
    } else {
        echo "Die hochgeladene Datei ist kein gültiges Bild.";
    }
} else {
    echo "Keine Datei hochgeladen oder es gab einen Fehler.";
}
