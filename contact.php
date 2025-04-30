<?
	include "core/functions.php";

	if($_POST)
	{
		$company = htmlspecialchars(substr($_POST["company"], 0, 32));
		$job = htmlspecialchars(substr($_POST["job"], 0, 32));
		$name = htmlspecialchars(substr($_POST["name"], 0, 32));
		$email = htmlspecialchars(substr($_POST["email"], 0, 64));
		$phone = htmlspecialchars(substr($_POST["phone"], 0, 15));
		$message = htmlspecialchars(substr($_POST["message"], 0, 2048));

		if($name == "" || $company == "" || $job == "" || $email == "" || $phone == "" || $message == "")
			echo '<script>alert("Your request has missing details and was not submitted.");</script>';
		else if(!str_contains($name, ' '))
			echo '<script>alert("Please use your full name.");</script>';
		else if(!str_contains($email, '@') || !str_contains($email, '.'))
			echo '<script>alert("Invalid email address.");</script>';
		else if(!is_numeric($phone))
			echo '<script>alert("Invalid phone number.");</script>';
		else
		{
			$sta = $con->prepare("INSERT INTO tickets (company, job, name, email, phone, message) VALUES (:company, :job, :name, :email, :phone, :message)");
			$sta->execute(array(':company' => $company, ':job' => $job, ':name' => $name, ':email' => $email, ':phone' => $phone, ':message' => $message));

			echo '<script>alert("Request submitted. We will be in touch in 1-2 business days.");</script>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><? echo $domain; ?> - Contact us</title>

		<meta name="title" content="<? echo $domain; ?> - Contact us"/>
		<meta name="description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta name="keywords" content="mayware, meiware, mayware.net, meiware.net, software, software consult, software consulting, software consultation, affordable software consult, affordable software consulting, affordable software consultation"/>

		<meta property="og:type" content="website"/>
		<meta property="og:url" content="https://<? echo $domain2; ?>.net/contact.php"/>
		<meta property="og:title" content="<? echo $domain; ?> - Contact us"/>
		<meta property="og:description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta property="og:image" content="https://<? echo $domain2; ?>.net/favicon-1080x1080.png"/>

		<meta property="twitter:card" content="summary_large_image"/>
		<meta property="twitter:url" content="https://<? echo $domain2; ?>.net/contact.php"/>
		<meta property="twitter:title" content="<? echo $domain; ?> - Contact us"/>
		<meta property="twitter:description" content="Contact us for personalized software with excellent optimization and security."/>
		<meta property="twitter:image" content="https://<? echo $domain2; ?>.net/favicon-1080x1080.png"/>

		<meta charset="UTF-8"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="robots" content="index, follow"/>
		<meta name="language" content="English"/>

		<link rel="icon" type="image/x-icon" href="favicon.ico"/>
		<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196"/>
		<link rel="icon" type="image/png" href="favicon-1080x1080.png" sizes="1080x1080"/>

		<link rel="stylesheet" href="stylesheet.css"/>
	</head>

	<body>
		<header>
			<img src="favicon-1080x1080.png"/><h1><? echo $domain; ?><br/>Software Consulting</h1>
		</header>

		<nav>
			<a href="/">Home</a><a href="contact.php">Contact us</a><a href="login.php">Login</a>
		</nav>

		<main>
			For consulting, quotes, or help, please fill out the form below.

			<form method="POST">
				Company
				<input type="text" name="company" maxlength="32" required/>

				Job title
				<input type="text" name="job" maxlength="32" required/>

				Full name
				<input type="text" name="name" maxlength="32" required/>

				Email address
				<input type="email" name="email" maxlength="64" required/>

				Phone number
				<input type="tel" name="phone" maxlength="15" placeholder="0123456789" required/>

				Message
				<textarea id="message" name="message" maxlength="2048" wrap="soft" required></textarea>

				<input type="submit" value="Submit"/>
			</form>
		</main>

		<footer>
			&copy; <? echo date("Y") . " " . $domain; ?>
		</footer>
	</body>
</html>