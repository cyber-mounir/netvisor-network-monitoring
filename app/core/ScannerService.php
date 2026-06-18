<?php

class ScannerService
{
    /* -------------------------
        PING SCAN (ALIVE HOSTS)
    --------------------------*/
    public function scan($ips)
    {
        $alive = [];

        foreach ($ips as $ip) {

            $output = shell_exec("ping -c 1 -W 1 $ip");

            if ($output && strpos($output, "ttl") !== false) {
                $alive[] = $ip;
            }
        }

        return $alive;
    }

    /* -------------------------
        ARP TABLE PARSING
    --------------------------*/
    public function getARP()
    {
        $arp = shell_exec("ip neigh");

        $result = [];

        foreach (explode("\n", trim($arp)) as $line) {

            if (empty($line)) continue;

            $parts = preg_split('/\s+/', $line);

            if (count($parts) >= 5) {
                $ip = $parts[0];
                $mac = $parts[4];

                $result[$ip] = $mac;
            }
        }

        return $result;
    }

    /* -------------------------
        PORT SCANNING (BASIC)
    --------------------------*/
    public function scanPorts($ip)
    {
        $ports = [22, 80, 443, 8080];
        $open = [];

        foreach ($ports as $port) {

            $connection = @fsockopen($ip, $port, $errno, $errstr, 0.2);

            if ($connection) {
                $open[] = $port;
                fclose($connection);
            }
        }

        return $open;
    }

    /* -------------------------
        HOSTNAME RESOLUTION
    --------------------------*/
    public function getHostname($ip)
    {
        $host = @gethostbyaddr($ip);

        return $host ? $host : "unknown";
    }

    /* -------------------------
        FULL SCAN WRAPPER (OPTIONAL)
    --------------------------*/
    public function fullScan($ips)
    {
        $alive = $this->scan($ips);
        $arp = $this->getARP();

        $devices = [];

        foreach ($alive as $ip) {

            $devices[] = [
                "ip" => $ip,
                "mac" => $arp[$ip] ?? "unknown",
                "hostname" => $this->getHostname($ip),
                "ports" => $this->scanPorts($ip)
            ];
        }

        return $devices;
    }
}
