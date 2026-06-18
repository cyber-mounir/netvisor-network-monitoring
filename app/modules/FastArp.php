<?php

function fastARP()
{
    $arpTable = [];

    exec("ip neigh", $output);

    foreach ($output as $line) {

        if (preg_match('/(\d+\.\d+\.\d+\.\d+).*?lladdr\s([a-fA-F0-9:]+)/', $line, $m)) {
            $arpTable[$m[1]] = $m[2];
        }
    }

    return $arpTable;
}
