<?php
try {
    if (isset($_SESSION['new_user'])) {
        $username = htmlspecialchars($_SESSION['new_user']['username'], ENT_QUOTES, 'UTF-8');
        $email = filter_var($_SESSION['new_user']['email'], FILTER_VALIDATE_EMAIL);
        $password = htmlspecialchars($_SESSION['new_user']['password'], ENT_QUOTES, 'UTF-8');
    } else {
        throw new Exception("Benutzerinformationen fehlen.");
    }

    if (!$email) {
        throw new Exception("Ungültige E-Mail-Adresse.");
    }

    $subject = 'Willkommen bei Vereinsmanagement';
    $message = "
        <html>
        <head>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #1e1e1e; color: #ffffff; padding: 20px; }
                h1 { color: #b39ddb; }
                p { color: #ffffff; }
                a { color: #b39ddb; text-decoration: none; }
                a:hover { text-decoration: underline; color: #d1c4e9; }
                .content { background-color: #2c2c2c; padding: 20px; border-radius: 8px; }
            </style>
        </head>
        <body>
            <h1>Willkommen bei Vereinsmanagement</h1>
            <div class='content'>
                <p>Hallo <strong>$username</strong>,</p>
                <p>Wir haben für dich ein Benutzerkonto im Managementtool von <strong>$vereinName</strong> angelegt!<br>
                Dein Nutzername ist: $username <br>
                Du kannst dich mit diesem Passwort einloggen: <strong>$password</strong>.</p>
                <br>
                <strong>Bitte ändere dein Passwort so schnell wie möglich!</strong><br>
                Wir freuen uns, dich an Bord zu haben.
                <p>Mit freundlichen Grüßen,<br>Das $vereinName Team</p>
            </div>
        </body>
        </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: no-reply@VereinsTool.de' . "\r\n";

    if (mail($email, $subject, $message, $headers)) {
        header("Location: index.php?page=user");
        exit;
    } else {
        throw new Exception("E-Mail konnte nicht gesendet werden.");
    }
} catch (Exception $e) {
    error_log("Fehler beim E-Mail-Versand: " . $e->getMessage());
    exit;
}

ob_end_flush();
?>
