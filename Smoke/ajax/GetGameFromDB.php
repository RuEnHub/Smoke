<?php session_start()?>
<?php
	$mysqli = new mysqli('localhost','root','root','smoke_base');
	if ($_POST['id'] == '') {
		$users = mysqli_query($mysqli,"SELECT * FROM users WHERE id = ".$_SESSION['id']);
		$user = mysqli_fetch_assoc($users);

		if ($user['type'] == 'admin') 
	    	$result = mysqli_query($mysqli,"SELECT * FROM `game`");
	    if ($user['type'] == 'developer') 
	    	$result = mysqli_query($mysqli,"SELECT * FROM `game` WHERE dev_id = ".$_SESSION['id']);
	    if ($user['type'] == '') 
			$result = mysqli_query($mysqli,"SELECT * FROM `game` WHERE `visible` = TRUE");

		while ($game = mysqli_fetch_assoc($result))
			$data[] = $game;
	}
	else {
		$id = $_POST['id'];
		$result = mysqli_query($mysqli,"SELECT * FROM `game` WHERE id = '$id'");
		$data = mysqli_fetch_assoc($result);
	
	}
	echo json_encode($data);
?>