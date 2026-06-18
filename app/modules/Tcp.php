<?php

function scanPorts($ip)
{
    $ports = [22, 80, 443];

    $openPorts = [];

    foreach ($ports as $port)
    {
        $conn = @fsockopen(
            $ip,
            $port,
            $errno,
            $errstr,
            0.5
        );

        if ($conn)
        {
            $openPorts[] = $port;
            fclose($conn);
        }
    }

    return $openPorts;
}
