<?php
if (isset($_GET['page']) && $_GET['page'] == 'dashboard' && !isset($_GET['dashboard'])) {
    /*    require  __DIR__ . '/../models/m_dashboard.php';*/
    require __DIR__ . '/../models/m_transaction_stats.php';
    require __DIR__ . '/../models/m_member_stats.php';
    require __DIR__ . '/../view/dashboard.php';
}
