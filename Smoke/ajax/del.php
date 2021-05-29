<?php
	$mysqli = new mysqli('localhost','root','root','smoke_base');
	$id = $_POST['id'];
	$mysqli->query("DELETE FROM game WHERE id=$id");
?>