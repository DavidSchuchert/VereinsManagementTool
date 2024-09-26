<?php
function updateTransaction($mysqli, $data)
{
// Entferne unerwünschte Schlüssel wie 'submitBillFile', 'saveTransaction' etc.
unset($data['submitBillFile']);
unset($data['saveTransaction']);
unset($data['close']);

if (isset($data['betrag'])) {
$data['betrag'] = str_replace(',', '.', $data['betrag']);
};

$id = $data['id'] ?? null;
if (!$id) {
throw new Exception("Fehler: 'id' wurde nicht gefunden.");
}

unset($data['id']);  // Entferne die ID aus den Daten

// Entferne das `aktualisiert_am`-Feld aus den Daten
if (isset($data['aktualisiert_am'])) {
unset($data['aktualisiert_am']);
}

$sql = "UPDATE zahlungen SET ";
$fields = [];
foreach ($data as $key => $value) {
$fields[] = "$key = ?";
}
$sql .= implode(", ", $fields);
$sql .= " WHERE id = ?";

if ($stmt = $mysqli->prepare($sql)) {
$types = str_repeat('s', count($data)) . 'i';
$values = array_values($data);
$values[] = $id;
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
return true;
} else {
throw new DDDatabaseException("Fehler beim Aktualisieren des Datensatzes: " . $stmt->error);
}
} else {
throw new DDDatabaseException("Fehler bei der Vorbereitung des Statements: " . $mysqli->error);
}
}