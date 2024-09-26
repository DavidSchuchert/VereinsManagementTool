<?php
if (isset($_GET['page']) && $_GET['page'] == 'inventory') {
    require __DIR__ . '/../model/m_get_inventory.php';
    if (isset($_POST['add_inventory'])) {
        require __DIR__ . '/../model/m_add_inventory.php';
    };

    if (isset($_POST['delete_inventory']) && $_POST['delete_inventory'] == '1') {
        require __DIR__ . '/../model/m_delete_inventory.php';
    };
    if (isset($_POST['update_menge'])) {
        require __DIR__ . '/../model/m_update_inventory.php';
    }
    require __DIR__ . '/../view/inventory.php';
}
