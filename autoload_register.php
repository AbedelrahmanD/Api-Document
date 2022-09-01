<?php

spl_autoload_register(function ($class_name) {
    $paths = [
        "",
        "Api/",
        "Helpers/",
    ];
    foreach ($paths as $path) {
        $classPath =  __DIR__ . "./$path$class_name.php";
        if (file_exists($classPath)) {
            include_once $classPath;
        }
    }
});

if (strpos(Config::$baseUrl, $_SERVER["HTTP_HOST"]) == false) {
    echo "change basic url in config.php";
    exit;
}
