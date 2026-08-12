<?php
function connectDB() {
    $servername = "elinie25.treok.io";
    $username = "elinie25_dnd_group_user";
    $password = "?]X[z[@npT*jEHGO";
    //$port = 3306;
    $dbname = "elinie25_dnd_group_project";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}