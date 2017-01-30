<?php

	session_start();

	$_SESSION['payment_method'] = $_POST['payment_method'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TFC Express</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
		<body>
			<center>
			<form action="summarize.php" method="post">
				<input type="text" name="amount" value="<?php echo $_SESSION['amount'];?>"></br>
				<input type="text" name="currency" value="<?php echo $_SESSION['currency'];?>"></br>
				<input type="text" name="country" value="<?php echo $_SESSION['country'];?>"></br>
				<input type="text" name="sender" value="<?php echo $_SESSION['sender'];?>"></br>
				<input type="text" name="send_method" value="<?php echo $_SESSION['send_method'];?>"></br>
				<input type="text" name="user_name" value="<?php echo $_SESSION['user_name'];?>"></br>
				<input type="text" name="user_phone" value="<?php echo $_SESSION['user_phone'];?>"></br>
				<input type="text" name="payment_method" value="<?php echo $_POST['payment_method'];?>"></br>
				<input type="submit" name="submit" value="pay and send">
			</form>
			<a href="payment_method.php">Go Back</a>
		</body>
</html>

<?php

	session_destroy();

?>