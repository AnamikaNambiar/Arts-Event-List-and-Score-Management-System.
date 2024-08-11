<?php
	$id=$_GET['id'];
	$Host="localhost";
    $dbusername="root";
    $dbpass="";
    $dbName="multiuserlogin";

$con=new mysqli($Host,$dbusername,$dbpass,$dbName);
if($con->connect_error){
    die("connection failed:".$con->connect_error);
}
	mysqli_query($con,"delete from `participation` where id='$id'");
	header('location:profile.php');
?>