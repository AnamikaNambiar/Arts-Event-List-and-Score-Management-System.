<!DOCTYPE html>
<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="multiuserlogin";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['Login'])){
    $username=$_POST['username'];
    $password = $_POST['password'];
    $usertype=$_POST['usertype'];
    $query = "SELECT * FROM `multiuserlogin` WHERE username='".$username."' and password = '".$password."' and usertype='".$usertype."'";
    $result = mysqli_query($conn, $query);
if($result){
    $row=mysqli_fetch_array($result);
    if($row!=null){
    echo'<script type="text/javascript">alert("you are login successfully and you are logined as ' .$row['usertype'].'")</script>';

if($row['username']==$username && $row['password']==$password && $row['usertype']=='admin'){
    $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header("Location: admin.php");
            exit();
}
elseif($row['username']==$username && $row['password']==$password && $row['usertype']=='judge'){
    $_SESSION['username'] = $username;
            $_SESSION['login'] = true; 
            header("Location: judge.php");
             exit();
}elseif($row['username']==$username && $row['password']==$password && $row['usertype']=='student'){
    $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header("Location: user.php");
            exit();
}
}else{
    echo '<script type="text/javascript">alert("Invalid Login Credentials. Please try again.")</script>';
}
}else{
    echo 'no result';
}

}

?>
<html>
<head>
	<title>College Arts Fest</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	<div class="login-box">
		<h1>Login</h1>
		<form method="post">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" placeholder="Enter the username" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Enter the password" required>
            <label for="reg-type">User Type</label>
			<select name="usertype" id="usertype">
				<option value="">--Select user type--</option>
				<option value="admin">admin</option>
				<option value="student">student</option>
				<option value="judge">judge</option>
			</select>
			<button type="submit" name="Login" value="Login" >Login</button>
			<p class="message">Not registered? <a href="#" id="register-link">Create an account</a></p>
		</form>
	</div>
    <div class="register-box">
		<h1>Register </h1>
		<form action="register.php" method="post">
			<label for="regusername">Username</label>
			<input type="text" name="regusername" id="regusername" placeholder="Enter the username" required>
			<label for="regpassword">Password</label>
			<input type="password" name="regpassword" id="regpassword" placeholder="Enter the password" required>
            <label for="sem">Semester</label>
			<input type="text" name="sem" id="sem" placeholder="Current semester" required>
            <label for="dep">Department</label>
			<select name="dep" id="dep">
				<option value="">--Select department--</option>				
				<option value="CSE">CSE</option>
                <option value="CE">CE</option>
                <option value="EEE">EEE</option>
                <option value="EC">EC</option>				
			</select>
			<label for="regtype">User Type</label>
			<select name="regtype" id="regtype">
				<option value="">--Select user type--</option>				
				<option value="student">student</option>				
			</select>
			<button type="submit" name="Register" value="Register">Register</button>
			<p class="message">Already registered? <a href="#" id="login-link">Login</a></p>
		</form>
	</div>

	<script src="script.js"></script>
</body>
</html>