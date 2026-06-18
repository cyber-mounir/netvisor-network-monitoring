<?php

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=netvisor;charset=utf8mb4",
        "netvisor",
        "Netvisor@2025!"
    );

    echo "DB Connected\n";

} catch (PDOException $e) {
    echo $e->getMessage();
}
