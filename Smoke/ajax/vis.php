<?php
	$mysqli = new mysqli('localhost','root','root','smoke_base');
	$id = $_POST['id'];
	$mysqli->query("UPDATE game SET visible=(if(visible = TRUE,FALSE,TRUE)) WHERE id=$id");
?>