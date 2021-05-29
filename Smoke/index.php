<?php session_start()?>
<!DOCTYPE html>
<html >
	<?php include "php/DB.php"; ?>
<head>
	<meta charset="UTF-8">
	<title>Smoke</title>

	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon/favicon.ico" type="image/x-icon">

    <script src="https://kit.fontawesome.com/fad2c517c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="js/main.js"></script>
    <script src="js/time.js"></script>
    <script src="js/show.js"></script>
</head>

<body><?php 
	if (!array_key_exists('user', $_SESSION)) {
		include "blocks/Authorization.php";
	} else {
		include "blocks/header.php";
		
        if($_GET['content'] == '') { 
        		include "blocks/main-content.php";	
        }
        if($_GET['content'] == 'info') {
            include "blocks/AboutSmoke.php";
        }
        include "blocks/footer.php";
    }
?>
</body>
</html>
