<?php
// delete_student.php for PostgreSQL

header('Content-Type: application/json');

// Include database configuration
require_once 'db_config.php';

// Retrieve and validate the primary key (tid) for the student record
$tid = isset($_POST['tid']) ? intval($_POST['tid']) : 0;
if ($tid <= 0) {
    echo json_encode(["success" => false, "error" => "Invalid record ID"]);
    exit;
}

// Prepare and execute DELETE query using pg_query_params
$query = "DELETE FROM stdata WHERE tid = $1";
$result = pg_query_params($conn, $query, array($tid));

if (!$result) {
    echo json_encode(["success" => false, "error" => "Failed to execute deletion: " . pg_last_error($conn)]);
    pg_close($conn);
    exit;
}

// Check affected rows using pg_affected_rows
$affected_rows = pg_affected_rows($result);
if ($affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "No record found with the given ID"]);
}

pg_free_result($result);
pg_close($conn);
?>