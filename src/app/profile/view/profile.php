<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Profilseite</title>
</head>
<body>
    <h1>Profilseite</h1>
    <form action="?page=profile&action=save" method="post">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userName); ?>" required disabled>
        <br>
        <label for="password">Neues Passwort:</label>
        <input type="password" id="user_password" name="user_password" required>
        <br>
        <button type="submit" class="blue-btn add-btn">Änderungen speichern</button>
        
    </form>
</body>
</html>