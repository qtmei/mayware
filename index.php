<?
	include "core/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="title" content="<? echo $domain; ?> - Home">
		<meta name="description" content="We provide you personalized software with excellent optimization and security.">

		<link rel="icon" href="favicon.ico">
		<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196">
		<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080">
		<link rel="stylesheet" href="stylesheet.css">
	</head>

	<body>
		<header>
			<img src="favicon-1080x1080.png"/><h1><? echo $domain; ?></h1>

			<nav>
				<a href="/">Home</a><a href="contact.php">Contact us</a><a href="login.php">Login</a>
			</nav>
		</header>

		<main>
			<h2>We provide you personalized software with excellent optimization and security.</h2>
			<br>
			Why you should choose us:<br>
			Lower rates than our competitors<br>
			Higher standards for optimization and security<br>
			24/7 Customer Support<br>
			<br>
			<i>For consultation, quotes, or help, please visit our <a href="contact.php">contact</a> page.</i>
		</main>

		<footer>
			&copy; <? echo date("Y") . " " . $domain; ?>
		</footer>
	</body>
</html>