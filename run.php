<?php

require_once "app/core/NetworkService.php";
require_once "app/core/ScannerService.php";

require_once "app/services/DeviceService.php";
require_once "app/services/EventService.php";
require_once "app/services/DiscordService.php";

require_once "app/modules/Vendor.php";

echo "NETVISOR V28 FINAL SYSTEM\n\n";

$networkService = new NetworkService();
$scannerService = new ScannerService();

$deviceService = new DeviceService();
$eventService  = new EventService();

$vendorService = new VendorService();

$discord = new DiscordService("https://discord.com/api/webhooks/1516235149115785337/gPxetbbceAkHTdoGbwsLIGm4uEOMmO8rJiOP4s5uG55NyFQ8V8RdsLOxqxweqriia7Gp");

$db = DB::connect();

/* MULTI-SUBNET */
$subnets = $networkService->getSubnets();
$allIps = [];

foreach ($subnets as $subnet) {
    $allIps = array_merge(
        $allIps,
        $networkService->generateIPs($subnet)
    );
}

$aliveIps = $scannerService->scan($allIps);
$arp = $scannerService->getARP();

/* RESET STATUS */
$db->exec("UPDATE devices SET status='OFFLINE'");

/* SIMPLE RISK ENGINE */
function riskScore($ports)
{
    $c = count($ports);

    if ($c > 12) return 90;
    if ($c > 6) return 60;
    return 20;
}

/* PROCESS */
foreach ($aliveIps as $ip)
{
    $mac = $arp[$ip] ?? "unknown";

    $hostname = $scannerService->getHostname($ip);
    $vendor   = $vendorService->getVendor($mac);
    $ports    = $scannerService->scanPorts($ip);

    $risk = riskScore($ports);

    $exists = $deviceService->deviceExists($ip);

    if (!$exists)
    {
        $deviceService->saveDevice(
            $ip,
            $mac,
            $hostname,
            $vendor,
            $ports
        );

        $eventService->log(
            $ip,
            "NEW_DEVICE",
            "Device discovered",
            40
        );
    }
    else
    {
        $deviceService->updateDevice(
            $ip,
            $mac,
            $hostname,
            $vendor,
            $ports
        );

        $eventService->log(
            $ip,
            "DEVICE_ACTIVE",
            "Risk: $risk",
            $risk
        );
    }

    if ($risk >= 80)
    {
        $discord->send(
            "🚨 HIGH RISK DEVICE\nIP: $ip\nRISK: $risk"
        );
    }

    echo "$ip | Risk: $risk\n";
}

/* OFFLINE DETECTION */
$offline = $db->query("
    SELECT ip FROM devices WHERE status='OFFLINE'
")->fetchAll(PDO::FETCH_ASSOC);

foreach ($offline as $d)
{
    $eventService->log(
        $d['ip'],
        "DEVICE_OFFLINE",
        "Device not responding",
        70
    );

    $discord->send(
        "🔴 DEVICE OFFLINE\nIP: ".$d['ip']
    );
}

echo "\nDONE V28 FINAL\n";
