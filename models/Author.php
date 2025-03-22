<?php
class Author {
    // DB Connection
    private $conn;
    private $table = 'authors';
   
    
    // Properties
    public $id;
    public $author;

    // Constructor

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get authors
    public function read() {
        // Create query
        $query = 'SELECT id, author FROM authors ORDER BY author DESC';

        // Prepare statement
        try { 
            $stmt = $this->conn->prepare($query);
        } catch (PDOException $e) {
        echo "Error preparing statement: " . $e->getMessage();
        return null;
        }
        
        // Execute query
       try { $stmt->execute();
       } catch (PDOException $e) {
        echo "Error executing query: " . $e->getMessage();
        return null;
    } 

        return $stmt;
    }

    // Get single author
    public function read_single() {
        $query = 'SELECT id, author 
        FROM authors
        WHERE id = ?
        ORDER BY author DESC
        LIMIT 1'; 

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Set properties
        $this->author = $row['author'];
        $this->id = $row['id'];
    } else {
        
    }
}

// Create Author
public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author)';

    // Prepare Statement
    try {
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind data
        $stmt->bindParam(':author', $this->author);

        // Execute query
         if ($stmt->execute()) {

            // Get the inserted ID
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {

        // Catch any errors during the execution
        echo "Error: " . $e->getMessage();
        return false;
    }
    }

// Update Author
public function update() {
    
    // Create query
    $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';

    // Prepare Statement
    try {
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        
        // Catch any errors during the execution
        echo "Error: " . $e->getMessage();
        return false;
    }
    }

   // Delete Author
    public function delete() {
        // Create Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    try {
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {

        // Catch any errors during execution
        echo "Error: " . $e->getMessage();
        return false;
        }
    }

    }

