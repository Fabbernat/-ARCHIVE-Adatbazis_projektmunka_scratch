<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $station_id = $_POST["station_id"];
    $name = $_POST["name"];
    $city = $_POST["city"];

    // Insert data into the database
    $sql = "INSERT INTO allomas (azonosito, nev, varos) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $station_id, $name, $city);

    if ($stmt->execute()) {
        echo "Állomás sikeresen felvéve!";
    } else {
        echo "Hiba az állomás felvitele során: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
