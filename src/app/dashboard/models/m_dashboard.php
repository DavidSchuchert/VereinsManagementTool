<?php
require_once __DIR__ . '/../../../../src/config/config.db.php';
require_once __DIR__ . '/m_member_stats.php';
require_once __DIR__ . '/m_transaction_stats.php';

// Daten für die Charts vorbereiten
$data = [
    'total_members' => getMemberCount($mysqli),
    'support_members' => getSupportMemberCount($mysqli),
    'Gruendungs_members' => getGruendungsMemberCount($mysqli),
    'ordentliches_members' => getNormalMemberCount($mysqli),
    'einnahme' => getTransactionPlus($mysqli),
    'ausgabe' => getTransactionMinus($mysqli),
    'differenz' => getTransactionDiff($mysqli)
];

// Daten als JSON zurückgeben
header('Content-Type: application/json');
echo json_encode($data);
