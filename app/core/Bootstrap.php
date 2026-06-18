<?php

spl_autoload_register(function ($class) {

    $baseDir = __DIR__ . "/../";

    $paths = [
        "app/core/",
        "app/services/",
        "app/modules/",
        "app/database/",
        "app/models/"
    ];

    foreach ($paths as $path) {

        $file = $baseDir . $path . $class . ".php";

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
