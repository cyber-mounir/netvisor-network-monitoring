<?php

require_once "app/services/EventService.php";

$service = new EventService();
$events = $service->getLatest(200);

?>

<!DOCTYPE html>
<html>
<head>
    <title>NETVISOR EVENTS</title>

    <style>
        body{
            font-family: Arial;
            background:#0f172a;
            color:white;
            margin:20px;
        }

        h1{
            color:#38bdf8;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th,td{
            padding:10px;
            border-bottom:1px solid #334155;
        }

        th{
            background:#1e293b;
        }

        .NEW_DEVICE{
            color:#22c55e;
            font-weight:bold;
        }

        .DEVICE_SEEN{
            color:#38bdf8;
        }

        .DEVICE_OFFLINE{
            color:#ef4444;
        }
    </style>
</head>

<body>

<h1>NETVISOR EVENT LOG</h1>

<table>

<tr>
    <th>Time</th>
    <th>IP</th>
    <th>Event</th>
    <th>Message</th>
</tr>

<?php foreach ($events as $e): ?>

<tr>

    <td><?= $e['created_at'] ?></td>
    <td><?= $e['ip'] ?></td>

    <td class="<?= $e['event_type'] ?>">
        <?= $e['event_type'] ?>
    </td>

    <td><?= $e['message'] ?></td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
