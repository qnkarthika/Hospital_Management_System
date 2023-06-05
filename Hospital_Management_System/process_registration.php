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
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$phone_number = $_POST['phone_number'];
$guardian_name = $_POST['guardian_name'];
$guardian_ph = $_POST['guardian_ph'];

// Retrieve the highest room_no for the current registrations
$sql = "SELECT MAX(room_no) AS max_room FROM registration";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$room_no = $row['max_room'] + 1;

// Insert the registration data into the database
$sql = "INSERT INTO registration (name, age, gender, phone_number, guardian_name, guardian_ph, room_no)
        VALUES ('$name', '$age', '$gender', '$phone_number', '$guardian_name', '$guardian_ph', '$room_no')";

if ($conn->query($sql) === TRUE) {
    header("Location: registration_success.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
