<?php
$database_url = getenv("DATABASE_PUBLIC_URL"); // Full connection string (optional)

$host     = getenv("PGHOST");
$dbname   = getenv("PGDATABASE");
$user     = getenv("PGUSER");
$password = getenv("PGPASSWORD");
$port     = getenv("PGPORT");

// Option 1: Use individual variables to construct the connection string:
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Option 2: Alternatively, if your DATABASE_PUBLIC_URL is set properly, you could simply use:
// $conn = pg_connect($database_url);

if (!$conn) {
    die("Database connection failed: " . pg_last_error());
}
?>

