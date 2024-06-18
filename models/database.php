<?php
namespace models;

class database {
    private $servername = "localhost"; // Adresa serveru MySQL
    private $username = "root"; // Uživatelské jméno MySQL
    private $password = "root"; // Heslo MySQL
    private $database = "taskmanager"; // Název databáze
    protected $conn;

    // Konstruktor pro vytvoření spojení s databází
    public function __construct(){
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Funkce pro získání objektu spojení s databází
    public function db_connect(): \mysqli
    {
        return $this->conn;
    }
}
?>