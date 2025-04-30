<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}
	
	$sta = $con->prepare("SELECT * FROM tickets");
	$sta->execute();
	$html = "";

	while($row = $sta->fetch())
		$html .= '<tr><td>' . $row["ts"] . ' UTC</td><td>' . $row["company"] . '</td><td>' . $row["job"] . '</td><td>' . $row["name"] . '</td><td><a href="ticket.php?id=' . $row["id"] . '">View</a></td></tr>';

	echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<title>Tickets</title>

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
					<a href="tickets.php">Tickets</a><a href="employees.php">Employees</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
				</nav>

				<main>
					<table>
						<tr>
							<th>Timestamp</th>
							<th>Company</th>
							<th>Job Title</th>
							<th>Representative</th>
							<th>Actions</th>
						</tr>
						' . $html . '
					</table>
				</main>

				<footer>
					&copy; 2021 ' . $domain . '
				</footer>
			</body>
		</html>
	';
?>