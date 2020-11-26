<?php
class Database {
    private $_connection;
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "gestion";
    /*
    Get an instance of the Database
    @return Instance
    */
    // Constructor
    public function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }
}