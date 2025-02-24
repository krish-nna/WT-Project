<?php
// update_students.php

header('Content-Type: application/json');

// Include the database configuration
require_once 'db_config.php';

// Get and sanitize input data
$tid = isset($_POST['tid']) ? intval($_POST['tid']) : 0; // Primary key for student record
$sname = $_POST['sname'] ?? '';
$class = $_POST['class'] ?? '';
$phno = $_POST['phno'] ?? ''; // Phone as a string to preserve leading zeros
$division = $_POST['division'] ?? '';
$rollno = isset($_POST['rollno']) ? intval($_POST['rollno']) : 0;
$email = $_POST['email'] ?? '';
$rank_status = $_POST['rank_status'] ?? '';

// Validate required fields
if ($tid == 0 || empty($sname) || empty($class) || empty($phno) || empty($division) || empty($rollno) || empty($email) || $rank_status === '') {
    echo json_encode(["success" => false, "error" => "All fields are required"]);
    pg_close($conn);
    exit;
}

// Prepare the SQL query with parameter placeholders
$query = "UPDATE stdata 
          SET sname = $1, class = $2, phno = $3, division = $4, rollno = $5, email = $6, rank_status = $7 
          WHERE tid = $8";
$params = [$sname, $class, $phno, $division, $rollno, $email, $rank_status, $tid];

// Execute the query using pg_query_params
$result = pg_query_params($conn, $query, $params);

if ($result) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Update failed: " . pg_last_error($conn)]);
}

// Close the connection
pg_close($conn);
?>
