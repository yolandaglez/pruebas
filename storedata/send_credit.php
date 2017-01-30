<?php

	session_start();

	$_SESSION['amount'] = $_POST['amount'];
	$_SESSION['currency'] = $_POST['currency'];
	$_SESSION['country'] = $_POST['country'];
	$_SESSION['sender'] = $_POST['sender'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TFC Express</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
		<body>
			<center>
			<form action="payment_method.php" method="post">
				<input type="text" name="send_method" value="sms"></br>
				<input type="text" name="user_name" value="name"></br>
				<input type="text" name="user_phone" value="phone number"></br>
				<input type="reset" name="reset" value="reset"></br>
				<input type="submit" name="submit" value="next">
			</form>
			<a href="distribute_credit.php">Go Back</a>
		</body>
</html>