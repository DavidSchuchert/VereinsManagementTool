<?php
$form_submitted = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_submitted = false;

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'submitBillFile') === 0) {
            $transactionId = str_replace('submitBillFile', '', $key);
            uploadFile(
                'fileToUpload',
                '../uploads/bills',
                50000000,  // 50 MB
                ['jpg', 'jpeg', 'png', 'pdf'],  // Erlaubte Dateitypen
                $transactionId,
                $mysqli,
                'zahlungen',
                'file_path',
                'id'
            );
            $form_submitted = true;
            break;
        }
    }

    if (!$form_submitted) {
        $postData = $_POST;
        unset($postData['submitBillFile']);
        unset($postData['saveTransaction']);
        unset($postData['close']);

        try {
            if (isset($_GET['add_transaction'])) {
                if (addTransaction($mysqli, $postData)) {
                    echo "<div class='succ_msg'><p>Neue Transaktion erfolgreich hinzugefügt!</p></div>";
                    header("Location: " . $_SERVER['PHP_SELF'] . "?page=transactions");
                    exit();
                }
            } else {
                if (updateTransaction($mysqli, $postData)) {
                    echo "<div class='succ_msg'><p>Datensatz erfolgreich aktualisiert!</p></div>";
                    header("Location: " . $_SERVER['PHP_SELF'] . "?page=transactions");
                    exit();
                }
            }
        } catch (DDDatabaseException $e) {
            echo "<p>Fehler: " . $e->getMessage() . "</p>";
        }
    } elseif (isset($_POST['close'])) {
        $form_submitted = true;
    }
}

function addTransaction($mysqli, $data)
{
    unset($data['id']);
    if (isset($data['betrag'])) {
        $data['betrag'] = str_replace(',', '.', $data['betrag']);
    };
    $sql = "INSERT INTO zahlungen (";
    $sql .= implode(", ", array_keys($data));
    $sql .= ") VALUES (";
    $sql .= implode(", ", array_fill(0, count($data), '?'));
    $sql .= ")";
    if ($stmt = $mysqli->prepare($sql)) {
        $types = str_repeat('s', count($data));
        $values = array_values($data);
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new DDDatabaseException("Fehler beim Einfügen des Datensatzes: " . $stmt->error);
        }
    } else {
        throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
    }
}


?>