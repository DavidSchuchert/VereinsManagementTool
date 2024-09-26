<?php

function getTransactions($mysqli)
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM zahlungen WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    return null;
}
