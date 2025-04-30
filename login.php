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
			echo '<script>alert("Wrong password.");</script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><? echo $domain; ?> - Login</title>

		<meta name="title" content="<? echo $domain; ?> - Login"/>
		<meta name="description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta name="keywords" content="mayware, meiware, mayware.net, meiware.net, software, software consult, software consulting, software consultation, affordable software consult, affordable software consulting, affordable software consultation"/>

		<meta property="og:type" content="website"/>
		<meta property="og:url" content="https://<? echo $domain2; ?>.net/login.php"/>
		<meta property="og:title" content="<? echo $domain; ?> - Login"/>
		<meta property="og:description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta property="og:image" content="https://<? echo $domain2; ?>.net/favicon-1080x1080.png"/>

		<meta property="twitter:card" content="summary_large_image"/>
		<meta property="twitter:url" content="https://<? echo $domain2; ?>.net/login.php"/>
		<meta property="twitter:title" content="<? echo $domain; ?> - Login"/>
		<meta property="twitter:description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta property="twitter:image" content="https://<? echo $domain2; ?>.net/favicon-1080x1080.png"/>

		<meta charset="UTF-8"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="robots" content="index, follow"/>
		<meta name="language" content="English"/>

		<link rel="icon" type="image/x-icon" href="favicon.ico"/>
		<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196"/>
		<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080"/>

		<link rel="stylesheet" href="stylesheet.css"/>
	</head>

	<body>
		<header>
			<img src="favicon-1080x1080.png"/><h1><? echo $domain; ?><br/>Software Consulting</h1>
		</header>

		<nav>
			<a href="/">Home</a><a href="contact.php">Contact us</a><a href="login.php">Login</a>
		</nav>

		<main>
			<form method="POST">
				Username
				<input type="text" name="username" maxlength="16" required/>

				Password
				<input type="password" name="password" maxlength="256" required/>

				<input type="submit" value="Login"/>
			</form>
		</main>

		<footer>
			&copy; <? echo date("Y") . " " . $domain; ?>
		</footer>
	</body>
</html>
