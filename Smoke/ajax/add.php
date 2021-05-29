<?php session_start()?>
<?php
	$mysqli = new mysqli('localhost','root','root','smoke_base');
	$users = $mysqli->query("SELECT * FROM users WHERE id = ".$_SESSION['id']);
	$user = $users->fetch_assoc();

	$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
	$image = filter_var(trim($_POST['image']),FILTER_SANITIZE_STRING);
	$text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
	$year = filter_var(trim($_POST['year']), FILTER_SANITIZE_STRING);
	$download = filter_var(trim($_POST['download']), FILTER_SANITIZE_STRING);
	$dev_id = $user['id'];
	
	$mysqli->query("INSERT INTO `game` (`name`, `image`, `text`, `year`, `download`, `dev_id`) VALUES('$name', '$image', '$text', '$year', '$download', ".$user['id'].")");
?>