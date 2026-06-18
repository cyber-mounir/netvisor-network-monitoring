<?php

function getARPTable()
{
    $output = shell_exec("ip neigh");
    $lines = explode("\n", trim($output));

    $table = [];

    foreach ($lines as $line) {

        if (!$line) continue;

        preg_match('/(\d+\.\d+\.\d+\.\d+)/', $line, $ip);
        preg_match('/lladdr\s+([0-9a-f:]+)/i', $line, $mac);

        if (isset($ip[1])) {
            $table[$ip[1]] = $mac[1] ?? "unknown";
        }
    }

    return $table;
}
