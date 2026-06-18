<?php

require_once "app/core/NetworkService.php";
require_once "app/core/ScannerService.php";

$networkService = new NetworkService();
$scannerService = new ScannerService();

$network = $networkService->getLocalNetwork();
$ips = $networkService->generateIPs($network);

$aliveIps = $scannerService->scan($ips);

echo "FAST SCAN RESULTS\n";
echo "=================\n";

foreach ($aliveIps as $ip)
{
    echo $ip . PHP_EOL;
}

echo "\nTOTAL: " . count($aliveIps) . "\n";
