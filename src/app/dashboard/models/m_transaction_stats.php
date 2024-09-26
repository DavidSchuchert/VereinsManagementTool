<?php 
function getTransactionPlus($mysqli)
{
    $sql = "SELECT COALESCE(SUM(betrag), 0) AS total_einnahme FROM zahlungen WHERE typ = 'Einnahme'";
    $result = $mysqli->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_einnahme'];
    } else {
        // Fehlerbehandlung
        throw new DDDatabaseException("Fehler bei der Abfrage: " . $mysqli->error);
    }
}

function getTransactionMinus($mysqli)
{
    $sql = "SELECT COALESCE(SUM(betrag), 0) AS total_ausgabe FROM zahlungen WHERE typ = 'Ausgabe'";
    $result = $mysqli->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_ausgabe'];
    } else {
        // Fehlerbehandlung
        throw new DDDatabaseException("Fehler bei der Abfrage: " . $mysqli->error);
    }
}

function getTransactionDiff($mysqli)
{
    $sql = "SELECT 
        COALESCE(SUM(CASE WHEN typ = 'Einnahme' THEN betrag ELSE 0 END), 0) - 
        COALESCE(SUM(CASE WHEN typ = 'Ausgabe' THEN betrag ELSE 0 END), 0) AS differenz
    FROM zahlungen";

    if ($result = $mysqli->query($sql)) {
        $row = $result->fetch_assoc();
        return $row['differenz'];
    }
}