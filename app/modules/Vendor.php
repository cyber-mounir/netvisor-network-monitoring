<?php

class VendorService
{
    public function getVendor($mac)
    {
        $vendors = [
            "7C:2A:DB" => "TP-Link",
            "0E:24:2C" => "Huawei",
            "64:29:43" => "Cisco"
        ];

        $prefix = strtoupper(substr($mac, 0, 8));

        return $vendors[$prefix] ?? "Unknown";
    }
}
