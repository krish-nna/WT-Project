<?php
$host = "metro.proxy.rlwy.net";
$dbname = "railway";
$user = "postgres";
$password = "BSIoqAqteGwgiUvpCSepmCyNaiojnYFM";
$port = "12302"; 

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
