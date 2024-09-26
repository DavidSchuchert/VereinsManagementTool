<h1>Einstellungen</h1>
<h2>Vereinsdaten ändern:</h2>
<form action="" method="POST">
    <input type="hidden" name="page" value="settings">
    <input type="hidden" name="action" value="saveName">

    <label for="verein_logo">Vereins-Name:</label>
    <input type="text" name="vereinName" value="<?php echo htmlspecialchars($vereinName) ?>">

    <input type="submit" value="Speichern" class="blue-btn add-btn">
</form>

<form action="" method="post" enctype="multipart/form-data">

    <label for="verein_logo">Vereins-Logo:</label>

    <input type="hidden" name="page" value="settings">
    <input type="hidden" name="action" value="saveLogo">
    <input type="file" id="verein_logo" name="verein_logo">

    <input type="submit" value="Speichern" class="blue-btn add-btn">

</form>

