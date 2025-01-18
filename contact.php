<?
	include "core/functions.php";

	if($_POST)
	{
		$company = htmlspecialchars(substr($_POST["company"], 0, 32));
		$job = htmlspecialchars(substr($_POST["job"], 0, 32));
		$name = htmlspecialchars(substr($_POST["name"], 0, 32));
		$email = htmlspecialchars(substr($_POST["email"], 0, 64));
		$phone = htmlspecialchars(substr($_POST["phone"], 0, 16));
		$message = htmlspecialchars(substr($_POST["message"], 0, 2048));

		if($name != "" && $company != "" && $job != "" && $email != "" && $phone != "" && $message != "")
		{
			$sta = $con->prepare("INSERT INTO tickets (company, job, name, email, phone, message) VALUES (:company, :job, :name, :email, :phone, :message)");
			$sta->execute(array(':company' => $company, ':job' => $job, ':name' => $name, ':email' => $email, ':phone' => $phone, ':message' => $message));

			echo "Request submitted. We will be in touch in 1-2 business days.";
		}
		else
		{
			echo "Your request has missing details and was not submitted.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Mayware - Contact us</title>

		<meta name="title" content="Mayware - Contact us">
		<meta name="description" content="Contact us for personalized software with excellent optimization and security.">
		<meta name="keywords" content="mayware, mayware.net, software, software consult, software consulting, software consultation, affordable software consult, affordable software consulting, affordable software consultation">

		<meta property="og:type" content="website">
		<meta property="og:url" content="https://mayware.net/contact.php">
		<meta property="og:title" content="Mayware - Contact us">
		<meta property="og:description" content="Contact us for personalized software with excellent optimization and security.">
		<meta property="og:image" content="https://mayware.net/favicon-1080x1080.png">

		<meta property="twitter:card" content="summary_large_image">
		<meta property="twitter:url" content="https://mayware.net/contact.php">
		<meta property="twitter:title" content="Mayware - Contact us">
		<meta property="twitter:description" content="Contact us for personalized software with excellent optimization and security.">
		<meta property="twitter:image" content="https://mayware.net/favicon-1080x1080.png">

		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index, follow">
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
				<a href="/">Home</a><a href="contact.php">Contact us</a><a href="login.php">Login</a>
			</nav>
		</header>

		<main>
			For consulting, quotes, or help, please fill out the form below.
			<br>
			<form method="POST">
				Company<br>
				<input type="text" name="company" maxlength="32" required><br>
				Job title<br>
				<input type="text" name="job" maxlength="32" required><br>
				Full name<br>
				<input type="text" name="name" maxlength="32" required><br>
				Email address<br>
				<input type="text" name="email" maxlength="64" required><br>
				Phone number<br>
				<input type="text" name="phone" maxlength="16" required><br>
				Message<br>
				<textarea id="message" name="message" maxlength="2048" wrap="soft" required></textarea><br>
				<br>
				<input type="submit" value="Submit">
			</form>
		</main>

		<footer>
			&copy; <? echo date("Y") ?> Mayware
		</footer>
	</body>
</html>