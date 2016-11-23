<?php
// Get database connection
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Instantiate user object
include_once 'objects/user.php';
$user = new User($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Set user property values
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->phone = $data->phone;
$user->email = $data->email;

// Add the user
if($user->create()){
	echo "User was added.";
}

// If unable to add the user, tell the user
else{
	echo "Unable to add user.";
}
?>
