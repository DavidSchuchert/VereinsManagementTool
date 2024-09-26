<?php
if (isset($_GET['page']) && $_GET['page'] == 'transactions' && !isset($_GET['transactions'])) {

    require __DIR__ . '/../model/m_get_transactions.php';
    require __DIR__ . '/../model/m_get_table.php';
    require __DIR__ . '/../model/m_difference_transaction.php';
    require __DIR__ . '/../model/m_update_transaction.php';
    require __DIR__ . '/../model/m_add_transactions.php';
    require __DIR__ . '/../model/m_delete_transaction.php';
    require __DIR__ . '/../view/transactions.php';

}



