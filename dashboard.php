<?php

require_once "app/services/DeviceService.php";
require_once "app/services/EventService.php";

$deviceService = new DeviceService();
$eventService  = new EventService();

$devices = $deviceService->getAll();
$events  = $eventService->getLatest(20);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>NETVISOR V28 FINAL DASHBOARD</title>

<style>

body{
    background:#0f172a;
    color:white;
    font-family:Arial;
    margin:20px;
}

h1{
    color:#38bdf8;
}

.container{
    display:flex;
    gap:20px;
}

.box{
    background:#1e293b;
    padding:15px;
    border-radius:10px;
    width:50%;
    height:500px;
    overflow:auto;
}

.device.safe{ color:#22c55e; }
.device.warning{ color:#facc15; }
.device.danger{ color:#ef4444; }

.event{
    border-bottom:1px solid #334155;
    padding:5px 0;
    font-size:13px;
}

</style>
</head>

<body>

<h1>🛡 NETVISOR V28 FINAL SIEM DASHBOARD</h1>

<div class="container">

<!-- DEVICES -->
<div class="box">

<h2>Devices</h2>

<?php foreach($devices as $d): ?>

<?php
$risk = rand(10,100); // replace with real risk if stored

$class =
    ($risk > 70) ? "danger" :
    (($risk > 40) ? "warning" : "safe");
?>

<div class="device <?= $class ?>">
    <?= $d['ip'] ?> |
    <?= $d['hostname'] ?> |
    <?= $d['status'] ?>
</div>

<?php endforeach; ?>

</div>

<!-- EVENTS -->
<div class="box">

<h2>Events</h2>

<?php foreach($events as $e): ?>

<div class="event">
    [<?= $e['event_type'] ?>]
    <?= $e['ip'] ?>
    <br>
    <small><?= $e['message'] ?></small>
</div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>
