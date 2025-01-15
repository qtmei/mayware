<?
	include "core/functions.php";

	if(IsValidSession())
	{
		if($_POST && $_SESSION["id"] == 1)
		{
			$username = $_POST["username"];
			$password = $_POST["password"];
			$name = $_POST["name"];
			$title = $_POST["title"];

			$sta = $con->prepare("INSERT INTO accounts (username, password, name, title) VALUES (:username, :password, :name, :title)");
			$sta->execute(array(':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT), ':name' => $name, ':title' => $title));
		}

		echo '
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>Create user</title>

					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">

					<link rel="icon" href="favicon.ico">
					<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196">
					<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080">
					<link rel="stylesheet" href="stylesheet.css">
				</head>

				<body>
					<header>
						<img src="favicon-1080x1080.png"/>

						<nav>
							<a href="tickets.php">Tickets</a><a href="team.php">Team</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
						</nav>
					</header>

					<main>
						<form method="POST">
							username<br>
							<input type="text" name="username"><br>
							password<br>
							<input type="password" name="password"><br>
							full name<br>
							<input type="text" name="name"><br>
							job title<br>
							<input type="text" name="title"><br>
							<br>
							<input type="submit" value="Create">
						</form>
					</main>

					<footer>
						&copy; ' . date("Y") . ' ' . $domain . '
					</footer>
				</body>
			</html>
		';
	}
	else
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}
?>