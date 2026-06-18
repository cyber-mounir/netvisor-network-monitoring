<?php

class NetworkService
{
    public function getSubnets()
    {
        return [
            "192.168.1",
            "192.168.0",
            "192.168.137",
            "192.168.11"
        ];
    }

    public function generateIPs($subnet)
    {
        $ips = [];

        for ($i = 1; $i <= 254; $i++) {
            $ips[] = $subnet . "." . $i;
        }

        return $ips;
    }
}
