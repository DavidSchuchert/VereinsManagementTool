<?php

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

function getTransactionDiffColor($mysqli){
    if(getTransactionDiff($mysqli) > 0){
        return "green";
    } else {
        return "red";
    }
};