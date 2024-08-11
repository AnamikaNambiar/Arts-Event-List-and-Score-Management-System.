<?php
    session_start();
    $Host="localhost";
    $dbusername="root";
    $dbpass="";
    $dbName="multiuserlogin";
            
    $con=new mysqli($Host,$dbusername,$dbpass,$dbName);
    $sql="Select distinct program_name from participation";
    $res=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Results</title>
	<link rel="stylesheet" type="text/css" href="results.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <header class="header">
        <a href="#" class="logo">
			<img src="logo.jpg">
		</a>
        <nav class="navigation">
            <a href="index.php">Home</a>
            <a href="results.php">Results</a>
            <a href="schedule.html">Schedule</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>
    <div class="adminbox"><br><br>
        <form>
            <h4><a href="dep.php">Department wise result</a></h4>
            <h1><center>RESULTS</center></h1><br><br>
                <label for="sortby">SortBy:</label>
                <select id="sortby" onchange="sorting()">
                    <?php while($rows=mysqli_fetch_array($res)){
                        ?>
                        <option value="<?php echo $rows['program_name']; ?>">
                        <?php echo $rows['program_name'];?></option>
                    <?php
                    }
                    ?>
                </select>
                <table>
                    <thead>
                    <th style="width: 30%;">Name</th>
                    <th style="width: 30%;">Semester</th>
                    <th style="width: 30%;">Department</th>
                    </thead>
                <tbody id="ans">
    
                </tbody>
                </table>
        </form>
        </div>
        <script src="results.js"></script>
</body>
</html>