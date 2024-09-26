<body>
    <h1>Transaktions-Datenbank</h1>
    <h2>Transaktionen:</h2>
    <?php
    getTableHeaders('zahlungen', $mysqli);
    echo getTransactionTable($mysqli);
    echo "<button class='blue-btn add-btn' onclick='window.location.href=\"?page=transactions&add_transaction=true\";'>Neue Transaktion hinzufügen</button>";

    if (!$form_submitted) {
        if (isset($_GET['id'])) {
            // Formular für das Bearbeiten einer Transaktion
            $headers = getTableHeaders('zahlungen', $mysqli);
            $transaction = getTransactions($mysqli);

            echo "<form method='post'>";
            foreach ($headers as $header) {
                // Die Felder 'erstellt am' und 'aktualisiert am' auslassen
                if ($header !== 'erstellt_am' && $header !== 'aktualisiert_am') {
                    $value = htmlspecialchars($transaction[$header] ?? '');
                    echo "<div class='form-group'>";
                    if ($header === 'id') {
                        echo "<label for='$header'>$header (nicht änderbar):</label>";
                        echo "<input type='text' name='$header' id='$header' value='$value' disabled>";
                    } elseif ($header === 'datum') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input class='datetime' type='datetime-local' name='$header' id='$header' value='$value' required>";
                    } elseif ($header === 'file_path') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header' value='$value'>";
                    } elseif ($header === 'typ') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<select name='$header' id='$header' required>";
                        echo "<option value='Einnahme'" . ($value === 'Einnahme' ? " selected" : "") . ">Einnahme</option>";
                        echo "<option value='Ausgabe'" . ($value === 'Ausgabe' ? " selected" : "") . ">Ausgabe</option>";
                        echo "</select>";
                    } elseif ($header === 'zahlungsart') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<select name='$header' id='$header' required>";
                        echo "<option value='PayPal'" . ($value === 'PayPal' ? " selected" : "") . ">PayPal</option>";
                        echo "<option value='Banküberweisung'" . ($value === 'Banküberweisung' ? " selected" : "") . ">Banküberweisung</option>";
                        echo "<option value='Kreditkarte'" . ($value === 'Kreditkarte' ? " selected" : "") . ">Kreditkarte</option>";
                        echo "<option value='Andere'" . ($value === 'Andere' ? " selected" : "") . ">Andere</option>";
                        echo "</select>";
                    } else {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header' value='$value' required>";
                    }
                    echo "</div>";
                }
            }
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($transaction['id']) . "'>";
            echo "<input type='submit' value='Speichern'>";
            echo "<button type='submit' name='close' value='true' class='close-btn'>Schließen</button>";
            echo "</form>";
        } elseif (isset($_GET['add_transaction'])) {
            // Formular für neues Mitglied hinzufügen
            echo "<h2>Neue Transaktion hinzufügen:</h2>";
            echo "<form method='post' action='?page=transactions&add_transaction=true'>";
            $headers = getTableHeaders('zahlungen', $mysqli);
            foreach ($headers as $header) {
                // Die Felder 'erstellt am' und 'aktualisiert am' auslassen
                if ($header !== 'erstellt_am' && $header !== 'aktualisiert_am') {
                    echo "<div class='form-group'>";
                    if ($header === 'datum') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input class='datetime' type='datetime-local' name='$header' id='$header' required>";
                    } elseif ($header === 'typ') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<select name='$header' id='$header' required>
                            <option value='Einnahme'>Einnahme</option>
                            <option value='Ausgabe'>Ausgabe</option>
                        </select>";
                    } elseif ($header === 'id') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header' disabled>";
                    } elseif ($header === 'file_path') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header'>";
                    } elseif ($header === 'betrag') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header' placeholder='in €' required>";
                    } elseif ($header === 'zahlungsart') {
                        echo "<label for='$header'>$header:</label>";
                        echo "<select name='$header' id='$header' required>
                            <option value='PayPal'>PayPal</option>";
                        echo "<option value='Banküberweisung'>Banküberweisung</option>";
                        echo "<option value='Kreditkarte'>Kreditkarte</option>";
                        echo "<option value='Andere'>Andere</option>";
                        echo "</select>";
                    } else {
                        echo "<label for='$header'>$header:</label>";
                        echo "<input type='text' name='$header' id='$header' required>";
                    }
                    echo "</div>";
                }
            }
            echo "<input type='submit' value='Hinzufügen'>";
            echo "</form>";
        }
    }
    ?>
</body>

</html>