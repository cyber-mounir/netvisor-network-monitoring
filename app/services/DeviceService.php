<?php

require_once __DIR__ . "/../database/DB.php";

class DeviceService
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function deviceExists($ip)
    {
        $stmt = $this->db->prepare("
            SELECT id
            FROM devices
            WHERE ip = ?
        ");

        $stmt->execute([$ip]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveDevice($ip, $mac, $hostname, $vendor, $ports)
    {
        $stmt = $this->db->prepare("
            INSERT INTO devices
            (
                ip,
                mac,
                hostname,
                vendor,
                ports,
                status,
                scan_count,
                alerted,
                first_seen,
                last_seen
            )
            VALUES
            (
                ?, ?, ?, ?, ?,
                'ONLINE',
                1,
                0,
                NOW(),
                NOW()
            )
        ");

        $stmt->execute([
            $ip,
            $mac,
            $hostname,
            $vendor,
            json_encode($ports)
        ]);
    }

    public function updateDevice($ip, $mac, $hostname, $vendor, $ports)
    {
        $stmt = $this->db->prepare("
            UPDATE devices
            SET
                mac = ?,
                hostname = ?,
                vendor = ?,
                ports = ?,
                status = 'ONLINE',
                scan_count = scan_count + 1,
                last_seen = NOW()
            WHERE ip = ?
        ");

        $stmt->execute([
            $mac,
            $hostname,
            $vendor,
            json_encode($ports),
            $ip
        ]);
    }

    public function getAll()
    {
        return $this->db->query("
            SELECT *
            FROM devices
            ORDER BY last_seen DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStats()
    {
        $total = $this->db->query("
            SELECT COUNT(*)
            FROM devices
        ")->fetchColumn();

        $online = $this->db->query("
            SELECT COUNT(*)
            FROM devices
            WHERE status='ONLINE'
        ")->fetchColumn();

        return [
            'total' => $total,
            'online' => $online,
            'offline' => $total - $online
        ];
    }
}
