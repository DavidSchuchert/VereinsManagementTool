# VereinsManagementTool

## 1. Einleitung
Das Vereinstool ist ein webbasiertes System zur Verwaltung von Vereinsaktivitäten und -mitgliedern. Es ermöglicht Vereinen, ihre Mitglieder, Transaktionen sowie ihr Inventar effizient zu organisieren.

## 2. Voraussetzungen
Bevor du das Vereinstool installierst und betreibst, stelle sicher, dass folgende Voraussetzungen erfüllt sind:
- **Webserver** (z.B. Apache)
- **PHP Version 7.4+**
- **MySQL-Datenbank**
- **PHP-Mailclient**: Ein PHP-Mailclient muss installiert sein, um E-Mail-Benachrichtigungen zu senden. Dieser ist jedoch bei vielen Hostinganbietern standardmäßig installiert.

## 3. Installation

### 3.1 Download und Vorbereitung
Lade den Code für das Vereinstool von der Projektseite oder vom Repository herunter. Stelle sicher, dass du alle Dateien auf deinem Webserver in das entsprechende Verzeichnis kopierst.

### 3.2 MySQL-Datenbankeinrichtung
Erstelle eine neue MySQL-Datenbank auf deinem Server. Notiere dir die Zugangsdaten (Host, Benutzername, Passwort, Datenbankname), da du diese im Setup-Prozess des Vereinstools benötigst.

### 3.3 Konfigurationsschritte im Setup
Rufe die Webseite auf, um das Setup zu starten. Navigiere hierfür zu deiner URL im Verzeichnis `public`. Fülle das Formular mit den erforderlichen Informationen aus:
- **Datenbank-Host**: Der Server, auf dem deine MySQL-Datenbank läuft. Bei lokalem Hosting ist dies oft `localhost`, alternativ wird dieser von deinem Hostinganbieter bereitgestellt.
- **Datenbank-Benutzername**: Der MySQL-Benutzername, den du für den Zugriff auf die Datenbank verwendest.
- **Datenbank-Passwort**: Das Passwort für den Datenbankbenutzer.
- **Datenbank-Name**: Der Name der Datenbank, die du zuvor erstellt hast.
- **Vereinsname und Logo**: Der offizielle Vereinsname sowie ein Logo, das in der Anwendung angezeigt wird. Dies kann später über den Menüpunkt „Einstellungen“ geändert werden.

Klicke auf "Setup ausführen", um das Vereinstool zu konfigurieren.

## 4. Systemübersicht

### 4.1 Hauptfunktionen
- **Transaktionsverwaltung**: Erfasse und verwalte die Einnahmen und Ausgaben des Vereins. Füge zudem Rechnungen zu jeder Transaktion hinzu, um den Überblick über deine Dokumente zu behalten.
- **Mitgliederverwaltung**: Füge Mitglieder hinzu, bearbeite deren Daten und halte die Mitgliederinformationen aktuell. Zu jedem Mitglied kann eine Datei, z.B. der Mitgliedsantrag, hinzugefügt werden.
- **Inventarverwaltung**: Verwalte das Vereinsinventar, indem du Artikel mit Menge, EAN, Beschreibung und Lagerstandort erfasst.

## 5. Benutzeroberfläche

### 5.1 Dashboard
Das Dashboard bietet eine Übersicht über deine Mitgliedszahlen sowie die aktuellen Transaktionen.

### 5.2 Transaktionen verwalten
Über das Menü "Transaktionen" kannst du:
- Einnahmen und Ausgaben des Vereins erfassen.
- Transaktionen bearbeiten und löschen.
- Einen Überblick über den aktuellen Finanzstatus des Vereins erhalten.
- Eine Rechnung oder ein anderes Dokument an jede Transaktion anhängen.

### 5.3 Mitglieder verwalten
Verwalte die Mitglieder des Vereins:
- Mitglieder hinzufügen, bearbeiten oder löschen.
- Detailinformationen wie Name, Adresse und Mitgliedsstatus pflegen.
- Daten hochladen, wie z.B. das Beitragsformular des Mitglieds.

### 5.4 Einstellungen
Im Einstellungsbereich kannst du grundlegende Systemeinstellungen konfigurieren, z.B. den Vereinsnamen sowie das Vereinslogo.

## 6. Benutzerverwaltung

### 6.1 Administratoren erstellen
Während der Installation wird ein Administrator erstellt. Weitere Administratoren können im Benutzerverwaltungsbereich hinzugefügt werden.

### 6.2 Benutzer hinzufügen
- Gehe in den Bereich "Benutzerverwaltung".
- Füge einen neuen Benutzer hinzu, indem du einen Benutzernamen, eine E-Mail-Adresse und ein Passwort festlegst.
- Der neue Benutzer erhält das von dir festgelegte Passwort sowie seinen Benutzernamen per E-Mail zugesendet. Bitte wähle daher kein sensibles Passwort. Sobald der Benutzer sich eingeloggt hat, kann er sein Passwort selbst über den Menüpunkt „Profil“ ändern.

## 7. Datenbank-Konfiguration
Das Vereinstool verwendet MySQL als Datenbankmanagementsystem. Alle Mitglieder- und Transaktionsdaten werden in MySQL-Tabellen gespeichert. Für den Betrieb sind Tabellen wie `mitglieder`, `zahlungen`, `benutzer` und weitere relevant.

## 8. Datei-Uploads

### 8.1 Vereinslogo
Das Vereinslogo wird während der Installation hochgeladen und kann später über den Einstellungsbereich geändert werden. Unterstützte Formate sind `.jpg`, `.png` und `.gif`.

## 9. E-Mail-Benachrichtigungen
Das Vereinstool sendet automatisch E-Mail-Benachrichtigungen, wenn ein neuer Benutzer erstellt wird. Stelle sicher, dass ein PHP-Mailclient auf dem Server installiert ist (dies ist bei vielen Hostinganbietern bereits der Fall).

## 10. Fehlerbehandlung und Support
Solltest du bei der Verwendung des Vereinstools auf Probleme stoßen oder Fragen haben, gibt es folgende Möglichkeiten zur Fehlerbehebung:
- **E-Mail-Support**: Sende eine E-Mail mit einer detaillierten Beschreibung des Problems an vereinstool@david-schuchert.de.
- **GitHub-Issue**: Wenn du ein technisches Problem oder einen Bug gefunden hast, erstelle ein Issue auf GitHub im Repository des Projekts.

---

## Zusammenfassung
Das Vereinstool ist eine umfangreiche Lösung zur Verwaltung von Vereinsfinanzen, Vereinsinventar und Mitgliedern. Die intuitive Benutzeroberfläche macht es zu einem hilfreichen Werkzeug für Vereine.
