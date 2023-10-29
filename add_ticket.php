<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = $_POST["ticket_id"];
    $station = $_POST["station"];
    $price = $_POST["price"];
    $available_quantity = $_POST["available_quantity"];

    // Insert data into the database
    $sql = "INSERT INTO jegyek (azonosito, allomas, ar, elerheto_darab) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $ticket_id, $station, $price, $available_quantity);

    if ($stmt->execute()) {
        echo "Jegy sikeresen felvéve!";
    } else {
        echo "Hiba a jegy felvitele során: " . $stmt->error;
    }

    $stmt->close();
}

// Database connection close
$conn->close();
