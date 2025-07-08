<?php
if (php_sapi_name() !== 'cli-server') {
    // Liefere immer index.html aus (für SPA-Fallback)
    readfile(__DIR__ . '/index.html');
    exit;
}
