<?php
session_start();

spl_autoload_register(function ($class) {
    $directory = __DIR__ . '/classes';
    $class_file = str_replace('\\', '/', $class) . '.php';

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $filename) {
        if (strtolower($filename->getFilename()) == strtolower($class_file)) {
            require_once $filename;
            return;
        }
    }

    // Поиск и загрузка трейтов
    $traits_directory = __DIR__ . '/traits';
    $trait_file = str_replace('\\', '/', $class) . '.php';

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($traits_directory)) as $filename) {
        if (strtolower($filename->getFilename()) == strtolower($trait_file)) {
            require_once $filename;
            return;
        }
    }
});
?>