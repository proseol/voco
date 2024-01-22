<?php

include "server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && $_POST["username"]) {
    $Server = new Server();
    echo $Server->login($_POST["username"]);
    $Server->close();
    exit();
}
echo "0";
?>
