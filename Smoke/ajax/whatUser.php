<?php session_start()?>
<?php 
	$mysql = new mysqli('localhost','root','root','smoke_base');
	$users = mysqli_query($mysql,"SELECT * FROM users WHERE id = ".$_SESSION['id']);
	$user = mysqli_fetch_assoc($users);
	echo ($user['type']);
?>