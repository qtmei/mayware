<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM tickets WHERE id=:id");
		$sta->execute(array(':id' => $_GET["id"]));
		$ticketInfo = $sta->fetch();

		echo '
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>Ticket</title>

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
							<tr><td>' . $ticketInfo["timestamp"] . ' UTC</td></tr>
							<tr><td>Company: ' . $ticketInfo["company"] . '</td></tr>
							<tr><td>Representative: ' . $ticketInfo["job"] . ', ' . $ticketInfo["name"] . '</td></tr>
							<tr><td>Contact: ' . $ticketInfo["email"] . ' , ' . $ticketInfo["phone"] . '</td></tr>
							<tr><td>Message: <pre>' . $ticketInfo["message"] . '</pre></td></tr>
						</table>
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
