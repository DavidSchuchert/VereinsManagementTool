<div class="container">
    <h1>Willkommen</h1>
    <div id="login-form">
        <h2>Login</h2>
        <form action="index.php?page=auth&action=login" method="post">
            <div class="form-group">
                <label for="login-username">Benutzername:</label>
                <input type="text" id="login-username" name="login-username" required>
            </div>
            <div class="form-group">
                <label for="login-password">Passwort:</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</div>
</body>
