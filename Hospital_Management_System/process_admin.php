<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'hospital_management';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the admin credentials exist in the database
$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirect to patient details page
    header("Location: patient_details.php");
} else {
    echo "Invalid username or password";
}

// Close the database connection
$conn->close();
?>
