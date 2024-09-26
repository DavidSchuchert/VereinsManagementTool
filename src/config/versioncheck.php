<?php
$currentVersion = '1.0.0';
$response = @file_get_contents('https://apps.david-schuchert.de/vereinstool/latest-release.json');

if (!empty($response)) {
    $updateInfo = json_decode($response, true);

    if ($updateInfo === null) {
        echo 'Fehler beim Dekodieren der JSON-Daten.';
    } else {
        if (version_compare($updateInfo['version'], $currentVersion, '>')) {
            echo '';
            echo '<p style="background-color: yellow">Ein Update ist verfügbar: Version ' . $updateInfo['version'] .  '</p>';
            echo '<a href="' . $updateInfo['download_url'] . '">Hier herunterladen</a>';
            echo '</div>';
        }
    }
}
