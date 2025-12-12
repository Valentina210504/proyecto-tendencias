<?php
$logFile = 'storage/logs/laravel.log';
if (!file_exists($logFile)) {
    echo "Log file not found.";
    exit;
}
$content = file_get_contents($logFile);
$lines = explode("\n", $content);
$lastLines = array_slice($lines, -50); // Get last 50 lines
$output = implode("\n", $lastLines);
file_put_contents('debug_log_output.txt', $output);
echo "Log extracted to debug_log_output.txt";
