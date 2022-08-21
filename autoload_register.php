<?php

spl_autoload_register(function ($class_name) {
    $paths = [
        "",
        "Models/",
        "Helpers/",
    ];
    foreach ($paths as $path) {
        $classPath =  __DIR__."./$path$class_name.php";
        if (file_exists($classPath)) {
            include_once $classPath;
        }
    }
});
