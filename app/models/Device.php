<?php

class Device
{
    public string $ip;
    public string $mac;
    public string $status;
    public string $hostname;
    public string $vendor;


    public array $ports = [];

    public function __construct(
        $ip,
        $mac = "unknown",
        $status = "online",
        $ports = []
    )
    {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->status = $status;
        $this->ports = $ports;
    }
}
