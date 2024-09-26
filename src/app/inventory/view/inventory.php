<h1>Inventar-Verwaltung</h1>
<h2>Inventar:</h2>
<form class="inventory_search" method="GET" action="">
    <input type="hidden" name="page" value="inventory"> <!-- Damit du auf der richtigen Seite bleibst -->
    <input class="inventory_search_input" type="text" name="search" placeholder="Suche nach Artikel, EAN, Standort..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button class="blue-btn inventory_search_button" type="submit">Suchen</button>
</form>
<?php
getInventoryTable($mysqli);
?>

<h2>Neuen Artikel hinzufügen:</h2>
<form method="POST" action="" class="flex-column">
    <label for="artikel">Artikel:</label>
    <input type="text" name="artikel" id="artikel" required>

    <label for="ean">EAN:</label>
    <input type="text" name="ean" id="ean">

    <label for="menge">Menge:</label>
    <input type="number" name="menge" id="menge" required>

    <label for="bemerkungen">Bemerkungen:</label>
    <input type="text" name="bemerkungen" id="bemerkungen" >

    <label for="lagerstandort">Lagerstandort:</label>
    <input type="text" name="lagerstandort" id="lagerstandort">

    <button type="submit" name="add_inventory" class="blue-btn add-btn">Hinzufügen</button>
</form>