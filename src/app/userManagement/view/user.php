<!-- Preloader-Element -->
<div id="preloader">
    <div class="spinner"></div>
</div>

<h1>Benutzerverwaltung</h1>

<h2>Benutzer erstellen</h2>
<form method="POST" action="" onsubmit="showPreloader()">
    <label for="username">Benutzername:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="email">E-Mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit" name="create_user" class="blue-btn add-btn">Benutzer erstellen</button>
</form>

<h2>Alle Benutzer</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Benutzername</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Verwende htmlspecialchars(), um Benutzereingaben zu schützen
            echo "<tr onclick='toggleDetails(" . htmlspecialchars($row["id"]) . ")'>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
            echo "</tr>";

            // Versteckte Zeile mit den zusätzlichen Informationen
            echo "<tr  class='hidden extra_info_user justify-content-between' id='details_" . htmlspecialchars($row["id"]) . "'>";
            echo "<td colspan='2'>";
            echo "<div class='extra_info'>";
            echo "<p><b>E-Mail:</b> " . htmlspecialchars($row["email"]) . "</p>";

            // Überprüfen, ob der Benutzer die ID 1 hat und den Löschen-Button nicht anzeigen, wenn ja
            if ($row["id"] != 1) {
                echo "<form method='POST' action='' class='no_margin width_auto'>
                            <input type='hidden' name='user_id' value='" . htmlspecialchars($row["id"]) . "'>
                            <button type='submit' name='delete_user' onclick='return confirm(\"Möchtest du diesen Artikel wirklich löschen?\");'><img class='btn-icon' src='../src/img/delete-svgrepo-com.svg' alt='Delete Icon'></button>
                          </form>";
            } else {
                echo "<p>Der Benutzer mit ID 1 kann nicht gelöscht werden.</p>";
            }

            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Keine Benutzer gefunden</td></tr>";
    }
    ?>
</table>

<script>
    function toggleDetails(id) {
        var element = document.getElementById('details_' + id);
        element.classList.toggle('hidden');
    }
        // Zeigt den Preloader an, wenn das Formular abgesendet wird
        function showPreloader() {
            document.getElementById("preloader").style.visibility = "visible";
        }

        function toggleDetails(id) {
            var element = document.getElementById('details_' + id);
            element.classList.toggle('hidden');
        }

</script>