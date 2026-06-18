<?php

require_once __DIR__ . "/../database/DB.php";

class EventService
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function log($ip, $type, $message, $severity = 10)
    {
        $stmt = $this->db->prepare("
            INSERT INTO device_events
            (ip, event_type, message, severity, created_at)
            VALUES (?, ?, ?, NOW())
        ");

        $stmt->execute([
            $ip,
            $type,
            $message,
            $severity
        ]);
    }

    public function getLatest($limit = 100)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM device_events
            ORDER BY id DESC
            LIMIT ?
        ");

        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
