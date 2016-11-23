<?php
// Include database and object files
include_once 'config/database.php';
include_once 'objects/user.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Prepare user object
$user = new User($db);

// Get id of user to be edited
$data = json_decode(file_get_contents("php://input"));

// Set ID property of user to be edited
$user->user_id = $data->user_id;

// Set user property values
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->phone = $data->phone;
$user->email = $data->email;

// Update the product
if($user->update()){
	echo "User was updated.";
}

// If unable to update the user, tell the user
else{
	echo "Unable to update user.";
}
?>
