<?php

class Server
{

    private $servername = "d70980.mysql.zonevs.eu";
    private $username = "d70980_voco";
    private $password = "tarturakenduslikkolledz";
    private $dbname = "d70980_voco";
    private $conn;

    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function register($name) {
        $name = $this->_sanitizeInput($name);
        $userName = $this->_generateUsername($name);

        $sql = "INSERT INTO users (name, username) VALUES ('$name', '$userName')";

        if ($this->conn->query($sql) === TRUE) {
            return "Registreerimine õnnestus! Teie kasutajanimi on: <strong>" . $userName . "</strong>";
        }
        else {
            return "0";
        }
    }

    public function login($userName) {
        $userName = $this->_sanitizeInput($userName);
        $sql = "SELECT name FROM users WHERE username = '$userName' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_row();
            return "Sisselogimine õnnestus! Teie nimi on <strong>$row[0]</strong>";
        }
        return "0";
    }

    public function install() {
        // Create user table if not exists
        $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(30) NOT NULL,
                    username VARCHAR(30) NOT NULL
                )";

        if ($this->conn->query($sql)) {
            echo "Installed successfully";
            return true;
        }

        // Close the connection
        $this->close();

        return false;
    }

    public function close() {
        $this->conn->close();
    }

    private function _sanitizeInput($text) {
        $text = strip_tags($text);
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $text = trim($text);
        $text = str_replace('"', "", $text);
        $text = str_replace("'", "", $text);
        if (!$text) {
            $text = 'user';
        }
        return $text;
    }

    private function _usernameExists($userName) {
        $sql = "SELECT id FROM users WHERE username='$userName' LIMIT 1";
        $result = $this->conn->query($sql);
        return ($result->num_rows > 0);
    }

    private function _generateUsername($name) {
        // Remove non-alphanumeric characters
        $userName = preg_replace('/[^a-zA-Z0-9]/', '', $name);

        // Ensure it's not empty
        if (empty($userName)) {
            $userName = 'user';
        }

        // Generate a unique username
        $i = 1;
        $testName = $userName;

        while ($this->_usernameExists($testName)) {
            $testName = $userName . $i++;
        }

        return $testName;
    }

}

?>
