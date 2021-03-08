<?php

spl_autoload_register(function ($name) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $name) . '.php';
    if (file_exists($path)) {
        //var_dump($path);
        require_once($path);
    } else {
        $path = explode('\\', $name);
        array_pop($path);
        $path = implode(DIRECTORY_SEPARATOR, $path) . DIRECTORY_SEPARATOR . 'model.php';
        require_once($path);
    }
});