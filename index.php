<?php

/**
 * Laravel InfinityFree Root Entry Point
 * Menjembatani request root langsung ke public/index.php
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Jika file statis diminta dan ada di folder public, layani file tersebut
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
