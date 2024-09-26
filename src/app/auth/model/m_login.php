<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login-username']) && isset($_POST['login-password'])) {
    $username = trim($_POST['login-username']);
    $password = trim($_POST['login-password']);

    if (empty($username) || empty($password)) {
        die("Benutzername und Passwort sind erforderlich!");
    }

    // Prepare and execute SQL statement
    $stmt = $mysqli->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        die('Execute() failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $passwordHash);
        $stmt->fetch();

        if (password_verify($password, $passwordHash)) {
            // Set session variables and redirect to dashboard
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            var_dump($_SESSION);
            header("Location: index.php");
            exit();
        } else {
            echo "Ungültiger Benutzername oder Passwort.";
        }
    } else {
        echo "Ungültiger Benutzername oder Passwort.";
    }

    $stmt->close();
}
?>