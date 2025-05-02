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
		<meta name="description" content="Contact us for personalized software and web design with excellent optimization and security."/>
		<meta name="keywords" content="
			mayware, meiware, mayware.net, meiware.net, mayware lafayette, meiware lafayette, 
			software engineering, software consult, software consulting, software consultation, 
			web design, web designer, web design consult, web design consulting, web design consultation, 
			affordable software engineering, affordable software consult, affordable software consulting, affordable software consultation, 
			affordable web design, affordable web designer, affordable web design consult, affordable web design consulting, affordable web design consultation, 
			lafayette software engineering, lafayette software consult, lafayette software consulting, lafayette software consultation, 
			lafayette web design, lafayette web designer, lafayette web design consult, lafayette web design consulting, lafayette web design consultation, 
			software engineering lafayette, software consult lafayette, software consulting lafayette, software consultation lafayette, 
			web design lafayette, web designer lafayette, web design consult lafayette, web design consulting lafayette, web design consultation lafayette
		"/>
  		<meta name="geo.region" content="US-LA"/>
  		<meta name="geo.placename" content="Lafayette"/>

		<meta property="og:type" content="website"/>
		<meta property="og:url" content="https://<? echo $domain2; ?>.net/contact.php"/>
		<meta property="og:title" content="<? echo $domain; ?> - Contact us"/>
		<meta property="og:description" content="Contact us for personalized software and web design with excellent optimization and security."/>
		<meta property="og:image" content="https://<? echo $domain2; ?>.net/favicon-1080x1080.png"/>

		<meta property="twitter:card" content="summary_large_image"/>
		<meta property="twitter:url" content="https://<? echo $domain2; ?>.net/contact.php"/>
		<meta property="twitter:title" content="<? echo $domain; ?> - Contact us"/>
		<meta property="twitter:description" content="Contact us for personalized software and web design with excellent optimization and security."/>
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
			<img src="favicon-1080x1080.png" alt=""/><h1><? echo $domain; ?><br/>Software Consulting</h1>
		</header>

		<nav>
			<a href="/">Home</a><a href="contact.php">Contact us</a><a href="login.php">Login</a>
		</nav>

		<main>
			<form method="POST">
				<fieldset>
					<legend>To contact us please fill out the form below</legend>

					<label for="company">Company</label><input type="text" id="company" name="company" maxlength="32" required/>

					<label for="job">Job title</label><input type="text" id="job" name="job" maxlength="32" required/>

					<label for="name">Full name</label><input type="text" id="name" name="name" maxlength="32" required/>

					<label for="email">Email address</label><input type="email" id="email" name="email" maxlength="64" required/>

					<label for="phone">Phone number</label><input type="tel" id="phone" name="phone" maxlength="15" placeholder="0123456789" required/>

					<label for="message">Message</label><textarea id="message" id="message" name="message" maxlength="2048" wrap="soft" required></textarea>

					<input type="submit" value="Submit"/>
				</fieldset>
			</form>
		</main>

		<footer>
			&copy; 2021 <? echo $domain; ?>
		</footer>
	</body>
</html>