<?
	include "core/functions.php";

	if(!IsValidSession())
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}
	
	$sta = $con->prepare("SELECT * FROM accounts");
	$sta->execute();
	$html = "";

	while($row = $sta->fetch())
		$html .= '<tr><td><a href="employee.php?id=' . $row["id"] . '">' . $row["name"] . '</a></td></tr>';

	echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<title>Team</title>

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
					<table>
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