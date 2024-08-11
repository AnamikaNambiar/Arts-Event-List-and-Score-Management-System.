<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the user is logged in
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the submitted data
        $event_name = $_POST['event_name'];
        $program_name = $_POST['program_name'];

        // Validate the submitted data
        if (empty($event_name) || empty($program_name)) {
            echo "Please select an event type and enter a program name.";
        } else {
            
            $host = 'localhost';
            $dbusername = 'root';
            $dbpass = '';
            $dbName = 'multiuserlogin';

            $con = new mysqli($host, $dbusername, $dbpass, $dbName);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            $stmt = $con->prepare("INSERT INTO events (event_name, program_name) VALUES (?, ?)");
            $stmt->bind_param("ss", $event_name, $program_name);
            if ($stmt->execute()) {
                echo "Event added successfully!";
            } else {
                echo "Failed to add event.";
            }

            $stmt->close();
            $con->close();
        }
    }
} else {
    echo "User not logged in";
}
?>
