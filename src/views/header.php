<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Session starten, wenn noch keine gestartet wurde
}
include_once '../src/config/config.db.php';
?>

<head>
    <link rel="stylesheet" href="../public/css/header.css">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <?php if ($logoPath == '') {
                    echo "<strong>" . $vereinName . "</strong>";
                } else {
                    echo '<img src="' . htmlspecialchars($logoPath) . '" alt="Vereinslogo">';
                } ?>
            </div>
            <nav>
                <!-- Desktop-Menu -->
                <ul class="menu">
                    <li><a href="index.php?page=dashboard">Dashboard</a></li>
                    <li><a href="index.php?page=members">Mitglieder</a></li>
                    <li><a href="index.php?page=transactions">Zahlungen</a></li>
                    <li><a href="index.php?page=inventory">Inventar</a></li>

                    <!-- Dropdown-Menü für Verwaltung -->
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Verwaltung</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=profile">Profil</a>
                            <a href="index.php?page=user">Benutzerverwaltung</a>
                            <a href="index.php?page=settings">Einstellungen</a>
                        </div>
                    </li>

                </ul>
            </nav>

            <div class="user-info">
                <span>Angemeldet als: <b> <?php echo htmlspecialchars($_SESSION['username']); ?> </b></span>
                <a href="index.php?page=auth&action=logout" class="logout-btn lila-btn btn-d-logout">Logout</a>
                <img src="../src/img/burger-menu.png" class="burgermenu-img" alt="Menu">
            </div>
        </div>


        <!-- Responsive Menu -->
        <div id="burger-menu" class="hidden">
            <li><a href="index.php?page=dashboard">Dashboard</a></li>
            <li><a href="index.php?page=members">Mitglieder</a></li>
            <li><a href="index.php?page=transactions">Zahlungen</a></li>
            <li><a href="index.php?page=inventory">Inventar</a></li>
            <li><a href="index.php?page=profile">Profil</a></li>
            <li><a href="index.php?page=user">Benutzerverwaltung</a></li>
            <li><a href="index.php?page=settings">Einstellungen</a></li>
            <div class="user-info">
                <a href="index.php?page=auth&action=logout" class="logout-btn lila-btn">Logout</a>
            </div>
        </div>
    </header>
</body>
<script>
    document.querySelector('.burgermenu-img').addEventListener('click', function() {
        document.getElementById('burger-menu').classList.toggle('hidden');
    });
</script>
</html>