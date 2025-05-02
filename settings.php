<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}
	
	$sta = $con->prepare("SELECT * FROM accounts WHERE id=:id");
	$sta->execute(array(':id' => $_SESSION["id"]));
	$accountInfo = $sta->fetch();

	if($_POST)
	{
		$newPassword = substr($_POST["new_password"], 0, 256);
		$confirmPassword = substr($_POST["confirm_password"], 0, 256);

		if($newPassword == $confirmPassword && strlen($newPassword) >= 8 && strlen(count_chars($newPassword, 3)) >= 4)
		{
			$sta = $con->prepare("UPDATE accounts SET password=:newPassword WHERE id=:id");
			$sta->execute(array(':newPassword' => password_hash($newPassword, PASSWORD_DEFAULT), ':id' => $_SESSION["id"]));

			$sta = $con->prepare("SELECT password FROM accounts WHERE id=:id");
			$sta->execute(array(':id' => $_SESSION["id"]));
			$fetchedPassword = $sta->fetch()["password"];

			$_SESSION["password"] = $fetchedPassword;

			echo '<script>alert("Password changed.");</script>';
		}
		else
			echo '<script>alert("Passwords do not match or invalid password. Minimum requirements: 8 characters, 4 unique.");</script>';
	}

	echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<title>Settings</title>

				<meta charset="UTF-8"/>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<meta name="language" content="English"/>

				<link rel="icon" type="image/x-icon" href="favicon.ico"/>
				<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
				<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196"/>
				<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080"/>

				<link rel="stylesheet" href="stylesheet.css"/>
			</head>

			<body>
				<header>
					<img src="favicon-1080x1080.png" alt=""/><h1>' . $domain . '<br/>Software Consulting</h1>
				</header>

				<nav>
					<a href="tickets.php">Tickets</a><a href="employees.php">Employees</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
				</nav>

				<main>
					<form method="POST">
						<fieldset>
							<legend>Account settings</legend>

							<label for="new_password">New password</label><input type="password" id="new_password" name="new_password" maxlength="256"/>

							<label for="confirm_password">Confirm password</label><input type="password" id="confirm_password" name="confirm_password" maxlength="256"/>

							<input type="submit" value="Update"/>
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