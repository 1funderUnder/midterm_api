<?php 
  class Database {
    // DB Params
    private $host;
   // private $port;
    private $dbname;
    private $username;
    private $password;
    private $conn;

public function __construct() {
  $this->username = getenv('USERNAME');
  $this->password = getenv('PASSWORD');
  $this->dbname = getenv('DBNAME');
  $this->host = getenv('HOST');
  
}

    // DB Connect
    public function connect() {
      if ($this->conn) {
        return $this->conn; // If connection already exists, return it
      }

      $dsn = "pgsql:host={$this->host};dbname={$this->dbname};";
      
            try { 
        $this->conn = new PDO($dsn, $this->username, $this->password);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      } 

  }

 /* class Database {
    private $host = 'localhost';
    private $dbname = 'quotesdb';   
    private $username = 'postgres'; 
    private $password = 'postgres';
    private $conn;
    
    // DB Connect
    public function connect() {
        $this->conn = null;       
        try {
            $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
        } catch (PDOException $e) {
            echo 'Database connection error: ' . $e->getMessage(); // Handle connection error
        }
        return $this->conn;
    }
}*/
 