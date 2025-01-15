<?
	include "core/functions.php";

	if($_POST)
	{
		$username = substr(strtolower($_POST["username"]), 0, 16);
		$password = substr($_POST["password"], 0, 256);

		$sta = $con->prepare("SELECT password FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$fetchedPassword = $sta->fetch()["password"];

		if(password_verify($password, $fetchedPassword))
		{
			$sta = $con->prepare("SELECT id FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $username));
			$id = $sta->fetch()["id"];

			$_SESSION["id"] = $id;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $fetchedPassword;

			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/tickets.php");
			exit();
		}
		else
		{
			echo "Wrong password.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="title" content="<? echo $domain; ?> - Login">

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
			<form method="POST">
				username<br>
				<input type="text" name="username" maxlength="16" required><br>
				password<br>
				<input type="password" name="password" maxlength="256" required><br>
				<br>
				<input type="submit" value="Login">
			</form>
		</main>

		<footer>
			&copy; <? echo date("Y") . " " . $domain; ?>
		</footer>
	</body>
</html>