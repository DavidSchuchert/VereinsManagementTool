<?php

if (isset($_GET['page']) && $_GET['page'] == 'auth') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'login':
            require_once __DIR__ . '/../view/login.php';
            require_once __DIR__ . '/../model/m_login.php';
            break;

        case 'register':
            if (!isset($_GET['reg'])) {
                require_once __DIR__ . '/../view/register.php';
            } elseif (isset($_GET['reg']) && $_GET['reg'] == 'done') {
                require_once __DIR__ . '/../model/m_regDB.php';
                require_once __DIR__ . '/../model/m_regSendMail.php';
                require_once __DIR__ . '/../model/m_regFormValid.php';
                header('Location: index.php?page=auth&action=login');
            }
            break;

        case 'logout':
            require_once __DIR__ . '/../model/m_logout.php';
            break;
    }
} else {
    echo "Seite nicht gefunden";
}
