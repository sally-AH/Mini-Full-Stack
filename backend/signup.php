<?php
require_once "connection.php";
// Read the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

$user_name = $data["user_name"];
$user_email = $data["user_email"];
$user_password = $data["user_password"];

// Check if the username or email already exist
$sql = "SELECT * FROM Users WHERE user_name = '$user_name' OR user_email = '$user_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $responseData = ['message' => 'Username and/or user email already taken'];
} else {
    // Insert the new user into the database
    $sql = "INSERT INTO Users (user_name, user_email, user_password) VALUES ('$user_name', '$user_email', '$user_password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["user_name"] = $user_name;
        $responseData = ['status' => TRUE];
    } else {
        $responseData = ['status' => FALSE, 'message' => 'Error creating user: ' . $conn->error];
    }
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($responseData);
?>