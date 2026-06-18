<?php

if (!function_exists('resolveHostname')) {

    function resolveHostname($ip)
    {
        $hostname = gethostbyaddr($ip);

        if ($hostname === $ip) {
            return "unknown";
        }

        return $hostname;
    }

}
