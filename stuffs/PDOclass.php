<?php
	
	//add this to connection after
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	//First, create the database handle
	//using MySQL (connection via local socket)
	$dsn = "mysql:host=localhost;dbname=thefirstclub"

	//using MySQL (connection via network, port optional)
	//$dsn = "mysql:host+127.0.0.1;port=3306;dbname=tfc3;charset=utf8";

	$username = "root";
	$password = "root";

	$db = new PDO($dsn, $username, $password);

	//setup PDO to throw an exception if and invalid query is provided
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//prepare a statment for execution with a single placeholder
	$query = "SELECT * FROM users WHERE class = ?";
	$statement = $db->prepare($query);

	//create some parameters to fill the placeholders, and execute the statement
	$parameters = [ "221B"];
	$statement->execute($parameters);

	//now, loop through each record as an assoc array
	while ($row=$statement->fetch(PDO::FECH_ASSOC)){
		do_stuff($row);
	}

	//2 placeholders: 1(:) 2(?)
	
	//using named placeholders
	$sql = 'SELECT name, email, user_level FROM users WHERE userID = :user';
	$prep = $conn->prepare($sql);
	$prep->execute([':user' => $_GET['user']]); //associative array
	$result = $prep->fetchAll();

	//using question-mark placeholders
	$sql = 'SELECT name, user_level FROM users WHERE userID = ? AND user_level = ?';
	$prep = $conn->prepare($sql);
	$prep->execute([$_GET['user'], $_GET['user_level']]); //indexed array
	$result = $prep->fetchAll();

	//database transactions
	//provides methods for beginning, committing and rollbacking back transactions

	$pdo = new PDO(
		$dsn,
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
		);

	try {

		$statement = $pdo->prepare("UPDATE user SET name = :name");

		$pdo->beginTransaction();

		$statement->execute([":name"=>'Bob']);
		$statement->execute([":name"=> 'James']);

		$pdo->commit();	
	}

	catch (\Exception $e){

		if ($pdo->inTransaction()) {
			$pdo->rollback();
		}
		throw $e;

	}

	//practical example using transactions
	//Inserting a new order to the database (can fails)

	// Insert the metadata of the order into the database
	$preparedStatement = $db->prepare(
	    'INSERT INTO `orders` (`name`, `address`, `telephone`, `created_at`)
	     VALUES (:name, :address, :telephone, :created_at)'
	);

	$preparedStatement->execute([
	    ':name' => $name,
	    ':address' => $address,
	    ':telephone' => $telephone,
	    ':created_at' => time(),
	]);

	// Get the generated `order_id`
	$orderId = $db->lastInsertId();

	// Construct the query for inserting the products of the order
	$insertProductsQuery = 'INSERT INTO `orders_products` (`order_id`, `product_id`, `quantity`) VALUES';

	$count = 0;
	foreach ( $products as $productId => $quantity ) {
	    $insertProductsQuery .= ' (:order_id' . $count . ', :product_id' . $count . ', :quantity' . $count . ')';
	    
	    $insertProductsParams[':order_id' . $count] = $orderId;
	    $insertProductsParams[':product_id' . $count] = $productId;
	    $insertProductsParams[':quantity' . $count] = $quantity;
	    
	    ++$count;
	}

	// Insert the products included in the order into the database
	$preparedStatement = $db->prepare($insertProductsQuery);
	$preparedStatement->execute($insertProductsParams);

	//Inserting a new order into the database with a transaction(fix previous example)

	// In this example we are using MySQL but this applies to any database that has support for transactions
	$db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $username, $password);    

	// Make sure that PDO will throw an exception in case of error to make error handling easier
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {
	    // From this point and until the transaction is being committed every change to the database can be reverted
	    $db->beginTransaction();    
	    
	    // Insert the metadata of the order into the database
	    $preparedStatement = $db->prepare(
	        'INSERT INTO `orders` (`order_id`, `name`, `address`, `created_at`)
	         VALUES (:name, :address, :telephone, :created_at)'
	    );
	    
	    $preparedStatement->execute([
	        ':name' => $name,
	        ':address' => $address,
	        ':telephone' => $telephone,
	        ':created_at' => time(),
	    ]);
	    
	    // Get the generated `order_id`
	    $orderId = $db->lastInsertId();

	    // Construct the query for inserting the products of the order
	    $insertProductsQuery = 'INSERT INTO `orders_products` (`order_id`, `product_id`, `quantity`) VALUES';
	    
	    $count = 0;
	    foreach ( $products as $productId => $quantity ) {
	        $insertProductsQuery .= ' (:order_id' . $count . ', :product_id' . $count . ', :quantity' . $count . ')';
	        
	        $insertProductsParams[':order_id' . $count] = $orderId;
	        $insertProductsParams[':product_id' . $count] = $productId;
	        $insertProductsParams[':quantity' . $count] = $quantity;
	        
	        ++$count;
	    }
	    
	    // Insert the products included in the order into the database
	    $preparedStatement = $db->prepare($insertProductsQuery);
	    $preparedStatement->execute($insertProductsParams);
	    
	    // Make the changes to the database permanent
	    $db->commit();
	}
	catch ( PDOException $e ) { 
	    // Failed to insert the order into the database so we rollback any changes
	    $db->rollback();
	    throw $e;
	}

	//get number of affected rows by a query
	$query = $db->query("DELETE FROM table WHERE name = 'John'");
	$count = $query->rowCount();

	echo "Deleted $count rows named John";

	






?>