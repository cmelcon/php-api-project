<?php

// Include database and object file
include_once 'config/database.php';
include_once 'objects/product.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Prepare user object
$product = new User($db);

// Get product id
$data = json_decode(file_get_contents("php://input"));

// Set user id to be deleted
$user->user_id = $data->user_id;

// Delete the user
if($user->delete()){
	echo "User was deleted.";
}

// If unable to delete the user
else{
	echo "Unable to delete user.";
}
?>
