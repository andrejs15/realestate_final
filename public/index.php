<?php

// AI-assisted migration bootstrap. Framework source: https://github.com/thevajko/vaiicko
require __DIR__ . '/../ClassLoader.php';

use Framework\Core\App;

try {
    (new App())->run();
} catch (Throwable $exception) {
    http_response_code(500);
    echo 'An error occurred: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
}
