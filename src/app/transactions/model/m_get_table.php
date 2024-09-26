<?php
function getTransactionTable($mysqli)
{
    $sql = "SELECT * FROM zahlungen";

    echo "<table>";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            // Hauptzeile mit den Transaktionsdetails
            echo "<tr onclick='test(" . $row['id'] . ")'>";
            echo "<td><b>" . htmlspecialchars($row['beschreibung']) . "</b><br>" . "R.-Nr.: " . htmlspecialchars($row['rechnungsnr']) . " Datum: " . htmlspecialchars($row['datum']) . "</td>";
            echo "<td>" . ($row['typ'] == 'Einnahme' ? '<b style="color: green">+ ' : '<b style="color: red">- ') . htmlspecialchars($row['betrag']) . " € </b><br>" . htmlspecialchars($row['zahlungsart']) . "</td>";
            echo "</tr>";

            //Zusatzelemente
            echo "<tr class='hidden ' id='" . $row['id'] . "'>";
            echo "<td colspan='2' class='transactions_td'>";
            echo "<div class='extra_info'>";
            echo " <a href='?page=transactions&id=" . htmlspecialchars($row['id']) . "'><img class='transactions_extra_icon' src='../src/img/edit-svgrepo-com.svg' alt='Edit Icon'> Bearbeiten</a>";
            echo "<a href='?page=transactions&delete_id=" . htmlspecialchars($row['id']) . "' class='delete-btn' onclick='return confirmDelete();'><img class='btn-icon' src='../src/img/delete-svgrepo-com.svg' alt='Delete Icon'> Löschen</a>";
            if ($row['file_path']) {
                // Datei-Link anzeigen
                echo "<a href='../uploads/bills/" . htmlspecialchars($row['file_path']) . "' target='_blank'> <img class='btn-icon' src='../src/img/file-svgrepo-com.svg' alt='File Icon'>" . htmlspecialchars($row['file_path']) . "</a>";
            } else {
                // Upload-Formular anzeigen
                echo "
                    <form class='file_upload width_auto' action='' method='post' enctype='multipart/form-data'>
                        <input type='file' name='fileToUpload' id='fileToUpload' class='no_margin'>
                        <input type='submit' class='no_margin' value='>' name='submitBillFile" . htmlspecialchars($row['id']) . "'>
                    </form>";
            };
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
        echo '<div class="transactions_sum" style="background-color:' . getTransactionDiffColor($mysqli) . ';"> Aktueller Stand: ' . getTransactionDiff($mysqli) . ' €</div>';
    } else {
        throw new DDDatabaseException("Fehler bei der Abfrage der Mitglieder: " . htmlspecialchars($mysqli->error));
    }
    echo "</table>";
    echo "<p>Gesamtanzahl der Transaktionen: <b>" . htmlspecialchars(getTableCount('zahlungen', $mysqli)) . "</b></p>";

    echo "<script>
    function test(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
    </script>";
}
