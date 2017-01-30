<?php

	session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TFC Express</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
		<body>
			<center>
			<form action="send_credit.php" method="post">
				<input type="text" name="credit" value="credit" disabled></br>
				<input type="text" name="amount" value="50 Clubcoins (5.00 GBP)"></br>
				<select name="currency">
					<option value="gbp" selected>GBP</option>
					<option value="usd">USD</option>
					<option value="eur">EUR</option>
				</select></br>
				<select name="country">
					<option value="uk" selected>UK</option>
					<option value="us">US</option>
				</select></br>
				<select name="sender">
					<option value="company" selected>KidChoose</option>
					<option value="name">Sender name</option>
					<option value="logo">Company logo</option>
				</select></br>
				<input type="reset" name="reset" value="reset"></br>
				<input type="submit" name="submit" value="next">
			</form>
			<a href="javascript:history.back()">Go Back</a>
		</body>
</html>
