<?php

	session_start();

	$_SESSION['send_method'] = $_POST['send_method'];
	$_SESSION['user_name'] = $_POST['user_name'];
	$_SESSION['user_phone'] = $_POST['user_phone'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TFC Express</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
		<body>
			<center>
			<form action="order_credit.php" method="post">
				<select name="payment_method">
					<option value="paypal">PayPal</option>
					<option value="credit_card">Credit card</option>
				</select></br>
				<input type="reset" name="reset" value="reset"></br>
				<input type="submit" name="submit" value="next">
			</form>
			<a href="send_credit.php">Go Back</a>
		</body>
</html>