
<body class="_setup">
    <div class="container">
        <h1>Vereins-Tool Setup</h1>
        <form action="index.php?page=setup&action=setup" method="POST" enctype="multipart/form-data">
            <h2>MySQL Datenbank-Konfiguration</h2>

            <div class="form-group">
                <label for="db_host">Datenbank-Host:
                    <span class="tooltip">?
                        <span class="tooltiptext">Dies ist die Adresse des Servers, auf dem deine Datenbank läuft. Häufig ist es 'localhost' bei lokalen Installationen. Wenn du einen externen Webserver nutzt, bekommst du diese Information von deinem Hostinganbieter.</span>
                    </span>
                </label>
                <input type="text" id="db_host" name="db_host" required>
            </div>

            <div class="form-group">
                <label for="db_username">Datenbank-Benutzername:
                    <span class="tooltip">?
                        <span class="tooltiptext">Der Benutzername, mit dem du auf die Datenbank zugreifen kannst. Diese Informationen werden dir meistens von deinem Hostinganbieter bereitgestellt.</span>
                    </span>
                </label>
                <input type="text" id="db_username" name="db_username" required>
            </div>

            <div class="form-group">
                <label for="db_password">Datenbank-Passwort:
                    <span class="tooltip">?
                        <span class="tooltiptext">Das Passwort für den Datenbank-Benutzer. Dieses wird dir entweder vom Hostinganbieter bereitgestellt oder wurde von dir bei der Einrichtung festgelegt.</span>
                    </span>
                </label>
                <input type="password" id="db_password" name="db_password" required>
            </div>

            <div class="form-group">
                <label for="db_name">Datenbank-Name:
                    <span class="tooltip">?
                        <span class="tooltiptext">Der Name der Datenbank, die du für dein Vereins-Tool verwendest. Du kannst diesen beim Erstellen der Datenbank festlegen oder von deinem Hostinganbieter erfahren.</span>
                    </span>
                </label>
                <input type="text" id="db_name" name="db_name" required>
            </div>

            <h2>Vereins-Konfiguration</h2>

            <div class="form-group">
                <label for="verein_name">Name des Vereins:
                    <span class="tooltip">?
                        <span class="tooltiptext">Gib hier den offiziellen Namen deines Vereins ein. Dieser wird in der gesamten Anwendung verwendet.</span>
                    </span>
                </label>
                <input type="text" id="verein_name" name="verein_name" required>
            </div>

            <div class="form-group">
                <label for="verein_logo">Vereins-Logo:
                    <span class="tooltip">?
                        <span class="tooltiptext">Lade das Logo deines Vereins hoch. Dies wird in der Anwendung angezeigt. Achte darauf, dass das Bild in einem gängigen Format wie .jpg oder .png vorliegt.</span>
                    </span>
                </label>
                <input type="file" id="verein_logo" name="verein_logo">
            </div>

            <h2>Admin Benutzer</h2>

            <div class="form-group">
                <label for="admin_username">Admin-Benutzername:
                    <span class="tooltip">?
                        <span class="tooltiptext">Der Benutzername des Administrators, der das System verwaltet. Wähle einen eindeutigen Namen.</span>
                    </span>
                </label>
                <input type="text" id="admin_username" name="admin_username" required>
            </div>

            <div class="form-group">
                <label for="admin_email">Admin-E-mail:
                    <span class="tooltip">?
                        <span class="tooltiptext">Die E-Mail-Adresse des Administrators.</span>
                    </span>
                </label>
                <input type="email" id="admin_email" name="admin_email" required>
            </div>

            <div class="form-group">
                <label for="admin_password">Admin-Passwort:
                    <span class="tooltip">?
                        <span class="tooltiptext">Wähle ein sicheres Passwort für den Administrator-Account. Das Passwort sollte mindestens 8 Zeichen lang sein.</span>
                    </span>
                </label>
                <input type="password" id="admin_password" name="admin_password" required>
            </div>

            <input type="submit" value="Setup ausführen">
        </form>
    </div>
</body>