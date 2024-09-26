<?php
$user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

$sql = "UPDATE users SET password_hash = ? WHERE username = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $user_password, $userName);

if ($stmt->execute()) {
    echo "Benutzerdaten erfolgreich aktualisiert.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}
$stmt->close();

?>