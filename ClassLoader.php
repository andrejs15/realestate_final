<?php

/**
 * Source/adaptation: Vaííčko Framework ClassLoader.php
 * https://github.com/thevajko/vaiicko/blob/master/Framework/ClassLoader.php
 *
 * AI-assisted migration note: this loader keeps the application in the repository root
 * while the required Vaííčko framework is pinned as a Git submodule in /vaiicko.
 */
spl_autoload_register(function (string $className): void {
    $className = ltrim($className, '\\');

    if ($className === 'Framework\\Http\\Responses\\ViewResponse') {
        $file = __DIR__ . '/FrameworkOverrides/Http/Responses/ViewResponse.php';
    } elseif (str_starts_with($className, 'Framework\\')) {
        $relative = substr($className, strlen('Framework\\'));
        $file = __DIR__ . '/vaiicko/Framework/' . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
    } elseif (str_starts_with($className, 'App\\')) {
        $relative = substr($className, strlen('App\\'));
        $file = __DIR__ . '/App/' . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
    } else {
        return;
    }

    if (!is_file($file)) {
        throw new RuntimeException("Class {$className} file {$file} was not found.");
    }

    require $file;
});
