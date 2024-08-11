<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>College Arts Fest</title>
	<link rel="stylesheet" type="text/css" href="addevent.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo">
			<img src="logo.jpg">
		</a>
        <nav class="navigation">
            <a href="admin.php">Profile</a>
            <a href="addevent.php">Add Event</a>
            <a href="deleteevent.php">Delete Event</a>
            <a href="logout.php">LogOut</a>
        </nav>
    </header>
    <div class="add">
		<h1>Add Event</h1>
		<form action="add_event_handler.php" method="POST">
            <label for="Program">Event:</label>
            <select name="event_name">
                <option value="">Select an item</option>
                <option value="OnStage">OnStage</option>
                <option value="Ofstage">Ofstage</option>
            </select>
            <label for="name">Program Name:</label>
			<input type="text" name="program_name" id="name">
            <button type="submit" name="submit" value="submit">ADD</button>
        </form>
    </div>
    <div id="message"></div> 
    </div>

    <script>
    // JavaScript code to handle form submission and display the message
    const form = document.querySelector('form');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the form from submitting normally

        // Send the form data to the server using AJAX or fetch API
        fetch(form.action, {
            method: form.method,
            body: new FormData(form)
        })
        .then(response => response.text())
        .then(message => {
            
            messageDiv.textContent = message;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
</body>
</html>