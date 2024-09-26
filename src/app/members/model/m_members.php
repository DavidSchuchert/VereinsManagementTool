<?php
$form_submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'submitMemberFile') === 0) {
            $memberID = str_replace('submitMemberFile', '', $key);
            uploadFile(
                'fileToUpload',
                '../uploads/member',
                50000000,  // 50 MB
                ['jpg', 'jpeg', 'png', 'pdf'],  // Erlaubte Dateitypen
                $memberID,
                $mysqli,
                'Mitglieder',
                'file_path',
                'db_id'
            );
            $form_submitted = true;
            break;
        }
    }

    if (isset($_POST['close'])) {
        $form_submitted = true;
    } elseif (isset($_GET['add_member'])) {
        // Neues Mitglied hinzufügen
        try {
            if (addMember($mysqli, $_POST)) {
                echo "<p>Neues Mitglied erfolgreich hinzugefügt!</p>";
                $form_submitted = true;
                header("Location: " . $_SERVER['PHP_SELF'] . "?page=members");
                exit();
            }
        } catch (DDDatabaseException $e) {
            echo "<p>Fehler: " . $e->getMessage() . "</p>";
        }
    } else {
        // Mitgliedsdaten aktualisieren
        try {
            if (isset($_POST['db_id']) && !empty($_POST['db_id'])) {
                if (updateMember($mysqli, $_POST)) {
                    echo "<div class='succ_msg'><p>Datensatz erfolgreich aktualisiert!</p></div>";
                    $form_submitted = true;
                    header("Location: " . $_SERVER['PHP_SELF'] . "?page=members");
                    exit();
                }
            }
        } catch (DDDatabaseException $e) {
            echo "<p>Fehler: " . $e->getMessage() . "</p>";
        }
    }
}

?>