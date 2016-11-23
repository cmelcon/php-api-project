<?php
// Include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Prepare user object
$user = new User($db);

// Get id of user to be edited
$data = json_decode(file_get_contents("php://input"));

// Set ID property of user to be edited
$user->user_id = $data->user_id;

// Read the details of product to be edited
$user->readOne();

// Create array
$user_arr[] = array(
	"user_id" =>  $user->user_id,
	"first_name" => $user->first_name,
	"last_name" => $user->last_name,
	"phone" => $user->phone,
	"email" => $user->email
);

// Make it json format
print_r(json_encode($user_arr));
?>
