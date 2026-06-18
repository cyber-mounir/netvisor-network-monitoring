<?php

require_once "../app/database/DB.php";

header('Content-Type: application/json');

$db = DB::connect();

$stmt = $db->query("
    SELECT ip, message
    FROM device_events
    WHERE event_type='NEW_DEVICE'
    ORDER BY id DESC
    LIMIT 5
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
