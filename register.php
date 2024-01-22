<?php

include "server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && $_POST["name"]) {
    $Server = new Server();
    echo $Server->register($_POST["name"]);
    $Server->close();
    exit();
}
echo "Registreerimisel tekkis viga, nimi ei ole leitav";
?>
