<?php
	if ($_POST['action'] == 'signup') {
		$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
		$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
		$type = filter_var(trim($_POST['type']), FILTER_SANITIZE_STRING);

		if (mb_strlen($login) < 6 || mb_strlen($login) > 19)
			$log = 'Длина логина должна быть больше 5 и меньше 20 символов';
		else if (mb_strlen($pass) < 6 || mb_strlen($pass) > 19)
			$log = 'Длина пароля должна быть больше 5 и меньше 20 символов';
		else if (mb_strlen($type) < 3 || mb_strlen($type) > 19)
			$log = 'Длина имени должна быть больше 2 и меньше 20 символов';
		else {
			$pass = md5($pass."qwerty");
			
			$mysql = new mysqli('localhost','root','root','smoke_base');
			$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
			$user = $result->fetch_assoc();
			if (count($user) == 0) {
				$mysql->query("INSERT INTO `users` (`login`, `password`, `type`) VALUES('$login', '$pass', '$type')");
				$log = 'Регистрация прошла успешно';
				$mysql->close();
			} else {
				$log = 'Данный логин уже занят';
				$mysql->close();
			}
		}
		header("Location: /?get=$log");
	}
	if ($_POST['action'] == 'signin') {
		$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
		$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

		$pass = md5($pass."qwerty");
		
		$mysql = new mysqli('localhost','root','root','smoke_base');

		$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
		$user = $result->fetch_assoc();
		if(count($user) == 0) {
			$log = 'Данного пользователя не существует';
			$mysql->close();
			header("Location: /?get=$log");
		} else {
			session_start();
			$_SESSION['user'] = $user['login'];
			$_SESSION['id'] = $user['id'];
			$mysql->close();
			header("Location: /");
		}	
	}
?>