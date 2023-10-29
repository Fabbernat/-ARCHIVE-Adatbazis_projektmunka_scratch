<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

// Query to get the most popular flights based on sold tickets
$sql = "SELECT jaratazonosito, COUNT(*) AS eladott_jegyek
        FROM jegy
        GROUP BY jaratazonosito
        ORDER BY eladott_jegyek DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Legnépszerűbb járatok adatai</h1>";
    echo "<table>";
    echo "<tr><th>Járat azonosító</th><th>Eladott jegyek száma</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["jaratazonosito"] . "</td><td>" . $row["eladott_jegyek"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek adatok a legnépszerűbb járatokról.";
}

// Close the database connection
$conn->close();