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

    $stmt = $con->prepare("SELECT multiuserlogin.username, multiuserlogin.sem, multiuserlogin.dep
        FROM multiuserlogin 
        INNER JOIN participation ON multiuserlogin.username = participation.username 
        WHERE participation.program_name = ?");
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
