<!DOCTYPE html>
<html>
<head>
    <title>Department-wise Result</title>
    <style>
        body {
	font-family: Arial, sans-serif;
	min-height: 100vh;
    background-color: #333333;
    background-position: center;
    background-size: cover;
    margin: 50px;
    padding-top: 5em;
}
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            background-color: #f2f2f2;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            color: #f2f2f2;
        }
        h2{
            color: aliceblue;
        }
    </style>
</head>
<body>
    <h2><center>Department-wise Result</center></h2>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Total Points</th>
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
                die("Connection failed: " . $con->connect_error);
            }

            $stmt = $con->prepare("SELECT m.dep, SUM(p.marks) AS total_marks
                FROM multiuserlogin m
                INNER JOIN participation p ON m.username = p.username 
                GROUP BY m.dep
                ORDER BY total_marks DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['dep']}</td>
                            <td>{$row['total_marks']}</td>
                          </tr>";
                }
            } else {
                echo "<tr>
                        <td colspan='2'>No departments found</td>
                      </tr>";
            }

            $stmt->close();
            $con->close();
            ?>
        </tbody>
    </table>
</body>
</html>
