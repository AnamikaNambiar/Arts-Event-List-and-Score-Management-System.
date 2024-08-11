<?php
session_start();

$host = 'localhost';
$dbusername = 'root';
$dbpass = '';
$dbName = 'multiuserlogin';

$con = new mysqli($host, $dbusername, $dbpass, $dbName);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedEvent = $_POST['event'];
    $selectedCheckboxes = isset($_POST['checkbox']) ? $_POST['checkbox'] : [];

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = $_SESSION['username'];

        foreach ($selectedCheckboxes as $checkbox) {
            $stmt = $con->prepare("SELECT COUNT(*) FROM participation WHERE username = ? AND program_name = ?");
            $stmt->bind_param("ss", $username, $checkbox);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->fetch_row()[0];

            if ($count > 0) {
                echo "Already registered for $checkbox!";
            } else {
                $stmt = $con->prepare("INSERT INTO participation (username, event_name, program_name) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $selectedEvent, $checkbox);
                if ($stmt->execute()) {
                    echo "Registered successfully for $checkbox!";
                } else {
                    echo "Failed to register for $checkbox.";
                }
            }
        }
        $stmt->close();
    } else {
        echo "User not logged in";
    }
}

$con->close();
?>
