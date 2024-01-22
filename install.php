<?php

include "server.php";

// Create user table if not exists
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL
)";

if ($conn->query($sql)) {
    echo "Installed successfully";
}

// Close the connection
$conn->close();

exit();
?>
