<?php

if (isset($_GET['page']) && $_GET['page'] == 'profile') {
    require __DIR__ . '/../model/m_get_user.php';
    require __DIR__ . '/../view/profile.php';

    if (isset($_GET['action']) && $_GET['action'] == 'save') {
        require __DIR__ . '/../model/m_save_user_data.php';
    }
}
