<?php

if (isset($_GET['page']) && $_GET['page'] == 'user') {
    require __DIR__ . '/../model/m_get_all_users.php';
    require __DIR__ . '/../model/m_delete_user.php';
    require __DIR__ . '/../model/m_create_user.php';
    require __DIR__ . '/../view/user.php';
    if(isset($_GET['action']) && $_GET['action'] == 'create_success') {
        require __DIR__ . '/../model/m_regSendMail.php';
    }
}
