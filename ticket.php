<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}

	$sta = $con->prepare("SELECT * FROM tickets WHERE id=:id");
	$sta->execute(array(':id' => $_GET["id"]));
	$ticketInfo = $sta->fetch();

	if(isset($_GET["close"]))
	{
		$sta = $con->prepare("DELETE FROM tickets WHERE id=:id");
		$sta->execute(array(':id' => $_GET["id"]));

		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/tickets.php");
		exit();
	}

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
						<tr>
							<td>' . $ticketInfo["ts"] . ' UTC</td>
							<td>Company: ' . $ticketInfo["company"] . '</td>
						</tr>

						<tr>
							<td>Actions: <a href="ticket.php?id=' . $ticketInfo["id"] . '&close">Close</a></td>
							<td>Representative: ' . $ticketInfo["job"] . ', ' . $ticketInfo["name"] . '</td>
						</tr>

						<tr>
							<td></td>
							<td>Contact: <a href="mailto:' . $ticketInfo["email"] . '">' . $ticketInfo["email"] . '</a>, <a href="tel:' . $ticketInfo["phone"] . '">' . $ticketInfo["phone"] . '</a></td>
						</tr>
					</table>

					<article>
						<h1>Message</h1>

						<p>' . $ticketInfo["message"] . '</p>
					</article>
				</main>

				<footer>
					&copy; 2021 ' . $domain . '
				</footer>
			</body>
		</html>
	';
?>