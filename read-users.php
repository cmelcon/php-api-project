<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$user = new User($db);

// Query products
$stmt = $user->readAll();
$num = $stmt->rowCount();

// Check if more than 0 record found
if($num>0){

	$data="";
	$x=1;

	// Retrieve our table contents
	// Fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);

		$data .= '{';
			$data .= '"user_id":"' . $user_id . '",';
			$data .= '"first_name":"' . $first_name . '",';
			$data .= '"last_name":"' . $last_name . '",';
			$data .= '"phone":"' . $phone . '"';
			$data .= '"email":"' . $email . '"';
		$data .= '}';

		$data .= $x<$num ? ',' : '';

		$x++;
	}
}

// Json format output
echo '{"records":[' . $data . ']}';
?>
