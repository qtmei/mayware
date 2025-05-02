<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}

	if($_POST && $_SESSION["id"] == 1)
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$name = $_POST["name"];
		$title = $_POST["title"];

		$sta = $con->prepare("INSERT INTO accounts (username, password, name, title) VALUES (:username, :password, :name, :title)");
		$sta->execute(array(':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT), ':name' => $name, ':title' => $title));

		$sta = $con->prepare("SELECT * FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$accountInfo = $sta->fetch();

		move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $accountInfo["id"] . ".png");
	}

	echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<title>Create user</title>

				<meta charset="UTF-8"/>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<meta name="language" content="English"/>

				<link rel="icon" href="favicon.ico"/>

				<link rel="stylesheet" href="stylesheet.css"/>
			</head>

			<body>
				<header>
					<img src="logo.png" alt=""/><h1>' . $domain . '<br/>Software Consulting</h1>
				</header>

				<nav>
					<a href="tickets.php">Tickets</a><a href="employees.php">Employees</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
				</nav>

				<main>
					<form method="POST" enctype="multipart/form-data">
						<fieldset>
							<legend>Create user</legend>

							<label for="username">Username</label><input type="text" id="username" name="username"/>

							<label for="password">Password</label><input type="password" id="password" name="password"/>

							<label for="name">Full name</label><input type="text" id="name" name="name"/>

							<label for="title">Job title</label><input type="text" id="title" name="title"/>

							<label for="photo">Photo</label><input type="file" id="photo" name="photo" accept="image/png"/>

							<input type="submit" value="Create"/>
						</fieldset>
					</form>
				</main>

				<footer>
					&copy; 2021 ' . $domain . '
				</footer>
			</body>
		</html>
	';
?>