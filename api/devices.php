<?php

require_once "../app/services/DeviceService.php";

header('Content-Type: application/json');

$service = new DeviceService();

echo json_encode($service->getAll());
