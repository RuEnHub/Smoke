<?php
	$mysqli = mysqli_connect('localhost','root','root','smoke_base');
	if (!$mysqli) {
		echo "Ошибка подключения";
	}
?>