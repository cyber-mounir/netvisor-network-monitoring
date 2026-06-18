<?php

function fastPingSweep($network)
{
    $alive = [];

    foreach ($network as $ip) {

        // fast ping (1 packet only)
        exec("ping -c 1 -W 1 $ip > /dev/null 2>&1", $out, $status);

        if ($status === 0) {
            echo "Alive: $ip\n";
            $alive[] = $ip;
        }
    }

    return $alive;
}
