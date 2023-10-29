<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the flight ID from the form or any source you prefer
    $flightId = $_POST["flight_id"]; // Adjust the field name as needed

    // Prepare and execute the SQL query to delete the flight
    $sql = "DELETE FROM jaratazonosito WHERE jaratazonosito = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $flightId);

    if ($stmt->execute()) {
        echo "Járat sikeresen törölve!";
    } else {
        echo "Hiba a járat törlése során: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();