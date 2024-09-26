<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register-username']) && isset($_POST['register-password']) && isset($_POST['register-email'])) {
    $username = trim($_POST['register-username']);
    $email = trim($_POST['register-email']);
    $password = trim($_POST['register-password']);

    if (empty($username) || empty($email) || empty($password)) {
        die("Alle Felder sind erforderlich!");
    }

    // Passwort hashen
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Benutzer registrieren
        registerUser($username, $email, $passwordHash, $mysqli);
        
        // Willkommens-E-Mail senden
        sendWelcomeEmail($username, $email);
        
        echo '<div class="succ_msg">Registrierung erfolgreich! Eine Bestätigungs-E-Mail wurde an ' . htmlspecialchars($email) . ' gesendet.</div>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}