<?php 

// Funktion, um die Anzahl der Mitglieder zu ermitteln
function getMemberCount($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM Mitglieder";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}


// Funktion, um die Anzahl der Gründungsmitglieder zu ermitteln
function getGruendungsMemberCount($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM Mitglieder WHERE Rang = 'Gruendungsmitglied'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Funktion, um die Anzahl der Supportmitglieder zu ermitteln
function getSupportMemberCount($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM Mitglieder WHERE Rang = 'Supportmitglied'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getNormalMemberCount($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM Mitglieder WHERE Rang = 'Ordentlichesmitglied'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}