<link rel="stylesheet" href="../css/signin.css">

<body>
	<form action="php/check.php" method="post">
		<input checked="" id="signin" name="action" type="radio" value="signin">
		<label for="signin">Войти</label>
		<input id="signup" name="action" type="radio" value="signup">
		<label for="signup">Зарегистрироваться</label>


		<div id="wrapper">
			<div id="arrow"></div>
			<input id="login" placeholder="Логин" type="text" name="login">
			<input id="pass" placeholder="Пароль" type="password" name="pass">
			<input id="type" placeholder="Имя" type="text" name="type">
		</div>
		<button type="submit">
			<span>
				<br>
				Войти
				<br>
				Зарегистрироваться
			</span>
		</button>
		<div id="hint"><?= $_GET['get'];?></div>
	</form>
</body>