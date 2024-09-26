<?php 
if (isset($_GET['page']) && $_GET['page'] == 'settings'){
    require __DIR__ . '/../view/settings.php';
    if(isset($_POST['action']) && $_POST['action'] == 'saveName'){
        require __DIR__ . '/../model/m_save_name.php';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'saveLogo'){
        require __DIR__ . '/../model/m_save_logo.php';
    }
}