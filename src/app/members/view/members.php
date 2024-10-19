
<h1>Vereins-Datenbank</h1>

<h2>Mitglieder:</h2>
<?php
echo getMembersTable($mysqli);

echo "<button class='blue-btn add-btn' onclick='window.location.href=\"?page=members&add_member=true\";'>Neues Mitglied hinzufügen</button>";


if (!$form_submitted) {
    if (isset($_GET['id'])) {
        $headers = getTableHeaders('Mitglieder', $mysqli);
        $member = getMembers($mysqli);

        echo "<form method='post'>";
        foreach ($headers as $header) {
            $value = htmlspecialchars($member[$header] ?? '');
            echo "<div class='form-group'>";
            if ($header === 'db_id') {
                echo "<label for='$header'>$header (nicht änderbar):</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' readonly>";
            } elseif ($header == 'ID') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Vorname') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Nachname') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Mail') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='email' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Beitritt') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='date' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Austritt') {
                echo "<label for='$header'>$header*:</label>";
                echo "<select name='$header' id='$header' required>
                <option value='Nein' " . ($value == 'Nein' ? 'selected' : '') . ">Nein</option>
                <option value='Ja' " . ($value == 'Ja' ? 'selected' : '') . ">Ja</option>
                </select>";
            } elseif ($header == 'Strasse') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'PLZ') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'HausNr') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value' required>";
            } elseif ($header == 'Rang') {
                echo "<label for='$header'>$header*:</label>";
                echo "<select name='$header' id='$header' required>
                    <option value='Gruendungsmitglied' " . ($value == 'Gruendungsmitglied' ? 'selected' : '') . ">Gruendungsmitglied</option>
                    <option value='Supportmitglied' " . ($value == 'Supportmitglied' ? 'selected' : '') . ">Supportmitglied</option>
                    <option value='Ordentlichesmitglied' " . ($value == 'Ordentlichesmitglied' ? 'selected' : '') . ">Ordentliches Mitglied</option>
                    <option value='sonstiges' " . ($value == 'sonstiges' ? 'selected' : '') . ">Sonstiges</option>
                    </select>";
            } elseif ($header == 'Geburtstag') {
                echo "<label for='$header'>$header*:</label>";
                echo "<input type='date' name='$header' id='$header' value='$value' required>";
            } else {
                echo "<label for='$header'>$header:</label>";
                echo "<input type='text' name='$header' id='$header' value='$value'>";
            }
            echo "</div>";
        }
        echo "<input type='hidden' name='db_id' value='" . htmlspecialchars($member['db_id']) . "'>";
        echo "<input type='submit' value='Speichern'>";
        echo "<button type='submit' name='close' value='true' class='close-btn'>Schließen</button>";
        echo "</form>";
    } elseif (isset($_GET['add_member'])) {
        // Formular für neues Mitglied hinzufügen
        echo "<h2>Neues Mitglied hinzufügen:</h2>";
        echo "<form method='post' action='?page=members&add_member=true'>";
        $headers = getTableHeaders('Mitglieder', $mysqli);
        foreach ($headers as $header) {
            if ($header !== 'db_id') { // db_id automatisch generieren
                echo "<div class='form-group'>";
                echo "<label for='$header'>$header" . (in_array($header, ['ID', 'Vorname', 'Nachname', 'Mail', 'Beitritt', 'Austritt', 'Strasse', 'HausNr', 'Rang', 'Geburtstag']) ? '*' : '') . ":</label>";
                if ($header == 'Rang') {
                    echo "<select name='$header' id='$header' required>
                        <option value='Gruendungsmitglied'>Gruendungsmitglied</option>
                        <option value='Supportmitglied'>Supportmitglied</option>
                        <option value='Ordentlichesmitglied'>Ordentliches Mitglied</option>
                        <option value='sonstiges'>Sonstiges</option>
                        </select>";
                } elseif ($header == 'Austritt') {
                    echo "<select name='$header' id='$header' required>
                        <option value='Nein'>Nein</option>
                        <option value='Ja'>Ja</option>
                        </select>";
                } else {
                    echo "<input type='" . ($header == 'Mail' ? 'email' : ($header == 'Beitritt' || $header == 'Geburtstag' ? 'date' : 'text')) . "' name='$header' id='$header'" . (in_array($header, ['ID', 'Vorname', 'Nachname', 'PLZ', 'Mail', 'Beitritt', 'Austritt', 'Strasse', 'HausNr', 'Rang', 'Geburtstag']) ? ' required' : '') . ">";
                }
                echo "</div>";
            }
        }
        echo "<input type='submit' value='Hinzufügen'>";
        echo "</form>";
    }
}
?>
<script>
    function confirmDelete() {
        return confirm("Sind Sie sicher, dass Sie dieses Mitglied löschen möchten?");
    }
</script>
