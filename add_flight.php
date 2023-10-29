<?php
// Database connection
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_id = $_POST["flight_id"];
    $type = $_POST["type"];
    $departure = $_POST["departure"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Insert data into the database
    $sql = "INSERT INTO jaratazonosito (jaratazonosito, tipus, induloallomas, celallomas, datum, idopont) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $flight_id, $type, $departure, $destination, $date, $time);

    if ($stmt->execute()) {
        echo "Járat sikeresen felvéve!";
    } else {
        echo "Hiba a járat felvitele során: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
