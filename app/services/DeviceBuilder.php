<?php

require_once __DIR__ . "/../models/Device.php";

function buildDevice(
    $ip,
    $mac,
    $ports
)
{
    return new Device(
        $ip,
        $mac,
        "online",
        $ports
    );
}
