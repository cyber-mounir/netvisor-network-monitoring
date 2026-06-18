<?php

require_once "app/database/DB.php";

$db = DB::connect();

$stmt = $db->query("
    SELECT *
    FROM devices
    ORDER BY id DESC
");

$devices = $stmt->fetchAll();

echo "===== DEVICES =====\n\n";

foreach ($devices as $device)
{
    echo "ID: " . $device['id'] . "\n";
    echo "IP: " . $device['ip'] . "\n";
    echo "HOSTNAME: " . $device['hostname'] . "\n";
    echo "VENDOR: " . $device['vendor'] . "\n";
    echo "MAC: " . $device['mac'] . "\n";
    echo "PORTS: " . $device['ports'] . "\n";
    echo "FIRST SEEN:" . $device['first_seen'] . "\n";
    echo "LAST SEEN: " . $device['last_seen'] . "\n";
    echo "------------------------\n";
}

$result = $db->query("
    SELECT COUNT(*) AS total
    FROM devices
")->fetch();

echo "Total Devices: " . $result['total'] . "\n";
