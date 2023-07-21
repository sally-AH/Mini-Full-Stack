<?php
session_start();
require_once "connection.php";
// Read the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

$user_name = $data['user_name'];
$user_password = $data['user_password'];

// Check if the provided credentials are correct
$sql = "SELECT * FROM Users WHERE user_name = '$user_name' AND user_password = '$user_password'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION["user_name"] = $user_name;
    $responseData = ['status' => TRUE];
} else {
    $responseData = ['status' => FALSE, 'message' => 'Invalid credentials'];
}
// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($responseData);
?>