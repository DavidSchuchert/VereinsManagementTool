<?php

if (isset($_GET['page']) && $_GET['page'] == 'members') {
    if (isset($_GET['add_member']) && $_GET['add_member'] == 'true') {
        require __DIR__ . '/../model/m_add_member.php';
    };
    if (isset($_GET['delete_id'])) {
        require __DIR__ . '/../model/m_delete_member.php';
    };
    if (isset($_GET['id'])) {
        require __DIR__ . '/../model/m_update_member.php';
    };
    require __DIR__ . '/../model/m_get_member_table.php';
    require __DIR__ . '/../model/m_get_member.php';
    require __DIR__ . '/../model/m_members.php';
    require __DIR__ . '/../view/members.php';
}
