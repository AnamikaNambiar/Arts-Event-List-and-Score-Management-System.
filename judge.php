<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the marks were submitted
    if (isset($_POST['marks'])) {
        // Connect to the database
        $Host = "localhost";
        $dbusername = "root";
        $dbpass = "";
        $dbName = "multiuserlogin";

        $con = new mysqli($Host, $dbusername, $dbpass, $dbName);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Iterate through the submitted marks
        $successCount = 0;
        $errorCount = 0;

        foreach ($_POST['marks'] as $id => $marks) {
            // Update the marks for the corresponding ID
            $stmt = $con->prepare("UPDATE participation SET marks = ? WHERE id = ?");
            $stmt->bind_param("si", $marks, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $successCount++;
            } else {
                $errorCount++;
            }
        }

        $con->close();

        // Redirect to the respective page based on success or error
        if ($successCount > 0) {
            header("Location: success.php");
            exit;
        } else {
            header("Location: error.php");
            exit;
        }
    }
}
?>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="judge.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
    <header class="header">
        <a href="#" class="logo">
            <img src="logo.jpg">
        </a>
        <nav class="navigation">           
            <a href="judge.php">Profile</a>
            <a href="logout.php">LogOut</a>
        </nav>
    </header><br>
    <h2><center>Student Participation Details</center></h2>
    <br>
    <form action="" method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Event Name</th>
                    <th>Program Name</th>
                    <th>Semester</th>
                    <th>Department</th>
                    <th>Marks</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Host = "localhost";
                $dbusername = "root";
                $dbpass = "";
                $dbName = "multiuserlogin";
                
                $con = new mysqli($Host, $dbusername, $dbpass, $dbName);

                if ($con->connect_error) {
                    die("connection failed:".$con->connect_error);
                }
                
                $stmt = $con->prepare("SELECT id, username, event_name, program_name, sem, dep, marks FROM participation ORDER BY program_name");
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$result) {
                    die("Invalid query:".$con->error);
                }
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        
                    <td>
                        <input type='hidden' name='id' value='".$row["id"]."'>" . $row["id"] . "
                    </td>
                    <td>
                        <input type='text' name='username' value='".$row["username"]."' readonly>
                    </td>
                    <td>
                        <input type='text' name='event_name' value='".$row["event_name"]."' readonly>
                    </td>
                    <td>
                        <input type='text' name='program_name' value='".$row["program_name"]."' readonly>
                    </td>
                    <td>
                        <input type='text' name='sem' value='".$row["sem"]."' readonly>
                    </td>
                    
                    <td>
                        <input type='text' name='dep' value='".$row["dep"]."' readonly>
                    </td>
                    <td>
                        <input type='text' name='marks[".$row["id"]."]' value='".$row["marks"]."'>
                    </td>
                    <td>
                        <input type='submit' class='btn btn-danger btn-sm' value='Submit'>
                    </td>
                </tr>";            
                }
                ?>
            </tbody>
        </table>
    </form>
</body>
</html>
