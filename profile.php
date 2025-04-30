<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}

	$sta = $con->prepare("SELECT * FROM accounts WHERE id=:id");
	$sta->execute(array(':id' => $_GET["id"]));
	$accountInfo = $sta->fetch();

	$avatarURL = file_exists("photos/" . $accountInfo["username"] . ".png") ? "photos/" . $accountInfo["username"] . ".png" : "favicon-1080x1080.png";

	echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<title>Profile</title>

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
					<img src="favicon-1080x1080.png"/><h1>' . $domain . '<br/>Software Consulting</h1>
				</header>

				<nav>
					<a href="tickets.php">Tickets</a><a href="team.php">Team</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
				</nav>

				<main>
					<table>
						<tr><td><img src="' . $avatarURL . '" style="width: 16vh; height: 16vh; object-fit: cover;"></td></tr>
						<tr><td>' . $accountInfo["name"] . '</td></tr>
						<tr><td>' . $accountInfo["title"] . '</tr></td>
						<tr><td>' . $accountInfo["ts"] . ' UTC</td></tr>
						<tr><td><a href="mailto:' . $accountInfo["username"] . '@mayware.net">' . $accountInfo["username"] . '@mayware.net</a></td></tr>
					</table>
				</main>

				<footer>
					&copy; 2021 ' . $domain . '
				</footer>
			</body>
		</html>
	';
?>