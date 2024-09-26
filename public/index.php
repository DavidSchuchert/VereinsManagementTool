<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/config/versioncheck.php';
require_once __DIR__ . '/../src/lib/lib.php';
require_once __DIR__ . '/../src/app/core/main.php';




$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

if (!file_exists('../src/config/setup.lock')) {
    if (!isset($_GET['page']) || $_GET['page'] !== 'setup') {
        header('Location: index.php?page=setup');
        exit();
    }
} else {
    require __DIR__ . '/../src/config/config.db.php';
    if (!isset($_SESSION['user_id']) && (!isset($_GET['page']) || $_GET['page'] !== 'auth')) {
        header("Location: index.php?page=auth&action=login");
        exit();
    }
}

if ($page !== 'auth' && $page !== 'setup') {
    require_once '../src/views/header.php';
}

if (empty($_GET)){
    header("Location: index.php?page=dashboard");
}



switch ($page) {
    case 'dashboard':
        require_once __DIR__ . '/../src/app/dashboard/controller/c_dashboard.php';
        break;
    case 'members':
        require_once __DIR__ . '/../src/app/members/controller/c_members.php';
        break;
    case 'transactions':
        require_once __DIR__ . '/../src/app/transactions/controller/c_transactions.php';
        break;
    case 'profile':
        require_once __DIR__ . '/../src/app/profile/controller/c_profile.php';
        break;
    case 'auth':
        require_once __DIR__ . '/../src/app/auth/controller/c_auth.php';
        break;
    case 'setup':
        require_once __DIR__ . '/../src/app/setup/controller/c_setup.php';
        break;
    case 'user':
        require_once __DIR__ . '/../src/app/userManagement/controller/c_user.php';
        break;
    case 'settings':
        require_once __DIR__ . '/../src/app/settings/controller/c_settings.php';
        break;
        case 'inventory':
            require_once __DIR__ . '/../src/app/inventory/controller/c_inventory.php';
            break;
}
?>