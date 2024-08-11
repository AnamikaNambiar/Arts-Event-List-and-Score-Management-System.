<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>College Arts Fest</title>
	<link rel="stylesheet" type="text/css" href="user.css">
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
    <div class="box">
        <h1>Registration</h1>
        <form action="participate.php" method="post">
            <label for="events">Events:</label>
            <select onchange="selectItem(this.value)" name="event" id="event">
                <option value="">Select an item</option>
                <?php               
                $host = 'localhost';
                $dbusername = 'root';
                $dbpass = '';
                $dbName = 'multiuserlogin';

                try {
                    $db = new PDO("mysql:host=$host;dbname=$dbName", $dbusername, $dbpass);

                    $query = "SELECT DISTINCT event_name FROM events";
                    $statement = $db->prepare($query);
                    $statement->execute();

                    // Generate options for the Events dropdown
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        $event_name = $row['event_name'];
                        echo "<option value='$event_name'>$event_name</option>";
                    }
                } catch (PDOException $e) {
                    echo "Database connection error: " . $e->getMessage();
                }
                ?>
            </select><br>
            <div id="container" style="display: none;">
                <?php
                // Fetch program names for Onstage event from the database
                $query = "SELECT program_name FROM events WHERE event_name = 'Onstage'";
                $statement = $db->prepare($query);
                $statement->execute();

                // Generate checkboxes for the program names
                echo "<div id='checkboxSet1' style='display: none;'>";
                echo "<label for='programs'>Programs:</label><br>";
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $program_name = $row['program_name'];
                    echo "<input type='checkbox' name='checkbox[]' value='$program_name'>$program_name<br>";
                }
                echo "</div>";

                // Fetch program names for Offstage event from the database
                $query = "SELECT program_name FROM events WHERE event_name = 'Ofstage'";
                $statement = $db->prepare($query);
                $statement->execute();

                // Generate checkboxes for the program names
                echo "<div id='checkboxSet2' style='display: none;'>";
                echo "<label for='programs'>Programs:</label><br>";
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $program_name = $row['program_name'];
                    echo "<input type='checkbox' name='checkbox[]' value='$program_name'>$program_name<br>";
                }
                echo "</div>";
                ?>
            </div>
            <input type="submit" value="Submit" name="Submit">
        </form>
    </div>
    <script>
        function selectItem(item) {
            var container = document.getElementById("container");
            container.style.display = "block";

            var checkboxSets = container.getElementsByTagName("div");
            for (var i = 0; i < checkboxSets.length; i++) {
                checkboxSets[i].style.display = "none";
            }

            switch (item) {
                case "Onstage":
                    document.getElementById("checkboxSet1").style.display = "block";
                    break;
                case "Ofstage":
                    document.getElementById("checkboxSet2").style.display = "block";
                    break;
                default:
                    container.style.display = "none";
                    break;
            }
        }

    </script>
</body>
</html>
