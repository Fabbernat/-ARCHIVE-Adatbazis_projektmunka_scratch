<?php
class connectToDatabase
{
// Connect to database
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "adatbazis";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Hiba a kapcsolódás során: " . $this->conn->connect_error);
        }
    }

    // Other methods can be defined here for database operations

    // Destructor to close the database connection when the object is destroyed
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * @return mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }


}

