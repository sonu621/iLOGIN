<?php
function getDatabaseConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_register";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}
?>