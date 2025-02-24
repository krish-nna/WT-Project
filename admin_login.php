<?php
// admin_login.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Database connection parameters
$host = "localhost";
$dbname = "dp";
$user = "postgres";
$password = "allblue";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

// Get the username and password from the POST data
$data = json_decode(file_get_contents("php://input"), true);
$username = isset($data["username"]) ? trim($data["username"]) : "";
$password_input = isset($data["password"]) ? trim($data["password"]) : "";

if (empty($username) || empty($password_input)) {
    echo json_encode(["success" => false, "error" => "Username and password are required."]);
    exit;
}

// Query the admin table for matching credentials
$query = "SELECT * FROM admin WHERE username = $1 AND password = $2";
$result = pg_query_params($conn, $query, [$username, $password_input]);

if (!$result) {
    echo json_encode(["success" => false, "error" => "Query error: " . pg_last_error($conn)]);
    pg_close($conn);
    exit;
}

$admin = pg_fetch_assoc($result);

if ($admin) {
    // Credentials match; set session flag
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    echo json_encode(["success" => true, "message" => "Login successful"]);
} else {
    echo json_encode(["success" => false, "error" => "Invalid username or password"]);
}

pg_close($conn);
?>
