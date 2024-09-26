<?php

if (isset($_GET['page']) && $_GET['page'] == 'setup' && !isset($_GET['action'])) {
    require_once __DIR__ . '/../view/setup.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'setup' && isset($_GET['action']) && $_GET['action'] == 'setup') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require __DIR__ . '/../model/m_setupDbconnect.php';
        require __DIR__ . '/../model/m_setupDbcreate.php';
        $mysqli->select_db($dbname);
        require __DIR__ . '/../model/m_setup_generate_main_table.php';
        require __DIR__ . '/../model/m_setup_generate_orte.php';
        require __DIR__ . '/../model/m_setup_generate_logo_name.php';
        require __DIR__ . '/../model/m_setup_generate_admin.php';
        require __DIR__ . '/../model/m_setupSaveConfig.php';
        $stmt->close();
    }
}
