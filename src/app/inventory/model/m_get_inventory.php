<?php
function getInventoryTable($mysqli)
{
    $sql = "SELECT * FROM inventory";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $mysqli->real_escape_string($_GET['search']);
        $sql .= " WHERE artikel LIKE '%$search%' OR ean LIKE '%$search%' OR bemerkungen LIKE '%$search%' OR lagerstandort LIKE '%$search%'";
    }

    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Artikel</th>
                    <th>Menge</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                // Hauptzeile mit dem Artikel und der Menge
                echo "<tr onclick='toggleDetails(" . $row['id'] . ")'>";
                echo "<td><b>" . htmlspecialchars($row['artikel']) . "</b><br>EAN: " . htmlspecialchars($row['ean']) . "</td>";
                echo "<td>" . htmlspecialchars($row['menge']) . "</td>";
                echo "</tr>";

                // Zusätzliche Informationen und das Textfeld in der versteckten Zeile
                echo "<tr class='hidden' id='details_" . $row['id'] . "'>";
                echo "<td colspan='3' class='inventory_extra_details'>";
                echo "<div class='extra_info_inventory'>";
                echo "<div class='extra_info_text'>";
                echo "<p><b>Bemerkungen:</b> " . htmlspecialchars($row['bemerkungen']) . "</p>";
                echo "<p><b>Lagerstandort:</b> " . htmlspecialchars($row['lagerstandort']) . "</p>";
                echo "</div>";
                
                // Hier fügst du das Textfeld mit den Pfeilen hinzu
                echo "<form class='inventory_actions_form no_margin align_items width_auto display_flex align_items' method='POST' style='padding: 3px !important' action=''>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <label for'new_menge'>Menge: </label> <input type='number' name='new_menge' class='no_margin' style='width: 80px;' value='" . htmlspecialchars($row['menge']) . "' min='0' step='1'>
                        <button type='submit' name='update_menge' class='blue-btn add-btn hidden'>></button>
                      </form>";
                
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Keine Ergebnisse gefunden.</p>";
        }
    } else {
        echo "<p>Fehler beim Abrufen des Inventars: " . $mysqli->error . "</p>";
    }

    echo "<script>
    function toggleDetails(id) {
        var element = document.getElementById('details_' + id);
        element.classList.toggle('hidden');
    }
    </script>";
}
