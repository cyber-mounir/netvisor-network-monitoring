<?php

function pingHost($ip)
{
    exec("ping -c 1 -W 1 $ip > /dev/null 2>&1", $o, $status);
    return $status === 0;
}
