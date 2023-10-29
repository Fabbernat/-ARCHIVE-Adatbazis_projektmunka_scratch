<?php
include_once "return_to_index.html";
include_once "connect_to_database.php";

$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();
