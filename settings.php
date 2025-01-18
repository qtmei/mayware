<?
	include "core/functions.php";

	if(IsValidSession())
	{
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

				echo "Password changed.";
			}
			else
			{
				echo "Passwords do not match or invalid password. Minimum requirements: 8 characters, 4 unique.";
			}
		}

		echo '
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>Settings</title>

					<meta charset="UTF-8">
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta name="language" content="English">

					<link rel="icon" href="favicon.ico">
					<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
					<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196">
					<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080">

					<link rel="stylesheet" href="stylesheet.css">
				</head>

				<body>
					<header>
						<img src="favicon-1080x1080.png">

						<nav>
							<a href="tickets.php">Tickets</a><a href="team.php">Team</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
						</nav>
					</header>

					<main>
						<form method="POST">
							New password<br>
							<input type="password" name="new_password" maxlength="256"><br>
							Confirm password<br>
							<input type="password" name="confirm_password" maxlength="256"><br>
							<br>
							<input type="submit" value="Update">
						</form>
					</main>

					<footer>
						&copy; ' . date("Y") . ' Mayware
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