<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>College Arts Fest</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
    <header class="header">
        <a href="#" class="logo">
			<img src="logo.jpg">
		</a>
        <nav class="navigation">
            <a href="user.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">LogOut</a>
        </nav>
    </header>
    <h1>Participation Details</h1>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Event Name</th>
            <th>Program Name</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $Host="localhost";
            $dbusername="root";
            $dbpass="";
            $dbName="multiuserlogin";
            
            $con=new mysqli($Host,$dbusername,$dbpass,$dbName);

            if($con->connect_error){
                die("connection failed:".$con->connect_error);
            }
            if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $stmt = $con->prepare("SELECT id,event_name,program_name FROM participation WHERE username = ?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    die("Invalid query:".$con->error);
                }
                while($row=$result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["event_name"]."</td>
                    <td>".$row["program_name"]."</td>
                    <td>
                    <a class='btn btn-danger btn-sm' href='remove.php?id=".$row['id']."'>Delete</a>
                    </td>
                </tr>";
                
                }
            }       
            ?>
        </tbody>
    </table>
</body>
</html>