<?php
$Host = "localhost";
$dbusername = "root";
$dbpass = "";
$dbName = "multiuserlogin";

$con = new mysqli($Host, $dbusername, $dbpass, $dbName);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['sortby'])) {
    $sortBy = $_POST['sortby'];

    $stmt = $con->prepare("SELECT m.username, m.sem, m.dep, p.marks
        FROM multiuserlogin m
        INNER JOIN participation p ON m.username = p.username 
        WHERE p.program_name = ? 
        ORDER BY p.marks DESC
        LIMIT 2");
    $stmt->bind_param("s", $sortBy);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare the response array
    $response = [];

    // Fetch rows and add them to the response array
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    // Send the response as JSON
    echo json_encode($response);
}

$stmt->close();
$con->close();
?>
