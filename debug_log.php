<?php
$logFile = 'c:/laragon/www/TASKFLOW/storage/logs/laravel-2025-12-29.log';
if (!file_exists($logFile)) {
    die("Log file not found");
}
$content = file_get_contents($logFile);
if (preg_match_all('/View \[(.*?)\] not found/', $content, $matches)) {
    echo "MISSING VIEW: " . end($matches[1]);
} else {
    echo "No matching error found.";
}
