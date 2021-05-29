<?php
	$mysql = new mysqli('localhost','root','root','smoke_base');

	$id = filter_var(trim($_POST['id']),FILTER_SANITIZE_STRING);
	$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
	$image = filter_var(trim($_POST['image']),FILTER_SANITIZE_STRING);
	$text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
	$year = filter_var(trim($_POST['year']), FILTER_SANITIZE_STRING);
	$download = filter_var(trim($_POST['download']), FILTER_SANITIZE_STRING);
	
	$mysql->query("UPDATE `game` SET name='$name', image='$image', text='$text', year='$year', download='$download' WHERE id='$id'");
?>