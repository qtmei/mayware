<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM tickets");
		$sta->execute();
		$html = "";

		while($row = $sta->fetch())
		{
			$html .= '<tr><td><a href="ticket.php?id=' . $row["id"] . '">' . $row["timestamp"] . ' UTC, ' . $row["company"] . ', ' . $row["job"] . ', ' . $row["name"] . '</a></td></tr>';
		}

		echo '
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>Tickets</title>

					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta name="title" content="' . $domain . ' - Tickets">

					<link rel="icon" href="favicon.ico">
					<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196">
					<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080">
					<link rel="stylesheet" href="stylesheet.css">
				</head>

				<body>
					<header>
						<img src="favicon-1080x1080.png"/><h1>' . $domain . '</h1>

						<nav>
							<a href="tickets.php">Tickets</a><a href="team.php">Team</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
						</nav>
					</header>

					<main>
						<table>
							' . $html . '
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