<?php

class User {

  // Database connection and table name
  private $conn;
  private $table_name = 'users';

  // Object properties
  public $user_id;
  public $first_name;
  public $last_name;
  public $phone;
  public $email;

  // Constructor with $db as database connection
  public function __constructor($db) {
    $this->conn = $db;
  }

  // Add user
  function create() {
    // Query to insert record
    $query = 'INSERT INTO ' . $this->table_name . ' SET first_name=:first_name, last_name=:last_name, phone=:phone, email=:email';

    // Prepare query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name=htmlspecialchars(strip_tags($this->last_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->email=htmlspecialchars(strip_tags($this->email));

    // Bind values
    $stmt->bindParam(":first_name", $this->first_name);
		$stmt->bindParam(":last_name", $this->last_name);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":email", $this->email);

    // Execute query
    if($stmt->execute()) {
      return true;
    }else {
      echo '<pre>';
        print_r($stmt->errorInfo());
      echo '</pre>';

      return false;
    }
  }

  // Read users
  function readAll() {

		// Select all query
		$query = 'SELECT id, name, description, price, created FROM ' . $this->table_name . ' ORDER BY id DESC';

		// Prepare query statement
		$stmt = $this->conn->prepare( $query );

		// Execute query
		$stmt->execute();

		return $stmt;
	}

  // Used when filling up the update user form
	function readOne() {

		// Query to read single record
		$query = 'SELECT first_name, last_name, phone, email FROM ' . $this->table_name . ' WHERE user_id = ? LIMIT 0,1';

		// Prepare query statement
		$stmt = $this->conn->prepare( $query );

		// Bind id of product to be updated
		$stmt->bindParam(1, $this->user_id);

		// Execute query
		$stmt->execute();

		// Get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Set values to object properties
		$this->first_name = $row['first_name'];
		$this->last_name = $row['last_name'];
		$this->phone = $row['phone'];
		$this->email = $row['email'];
	}

  // Update the product
	function update() {

		// Update query
		$query = 'UPDATE ' . $this->table_name . ' SET first_name = :first_name, last_name = :last_name, phone = :phone, email = :email WHERE user_id = :user_id';

		// Prepare query statement
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->first_name=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name=htmlspecialchars(strip_tags($this->last_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));

		// Bind new values
		$stmt->bindParam(':first_name', $this->first_name);
		$stmt->bindParam(':last_name', $this->last_name);
		$stmt->bindParam(':phone', $this->phone);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':user_id', $this->user_id);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

  // Delete the product
	function delete() {

		// Delete query
		$query = 'DELETE FROM ' . $this->table_name . ' WHERE user_id = ?';

		// Prepare query
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));

		// Bind id of record to delete
		$stmt->bindParam(1, $this->user_id);

		// execute query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}

?>
