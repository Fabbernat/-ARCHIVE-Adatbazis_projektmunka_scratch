<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

$sql = "SELECT j.jegyazonosito, j.felhasznalonev, j.jaratazonosito, ja.induloallomas, ja.celallomas, COUNT(*) AS ticket_count
        FROM jegy j
        INNER JOIN jaratazonosito ja ON j.jaratazonosito = ja.jaratazonosito
        GROUP BY j.jaratazonosito, j.felhasznalonev";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Jegyek darabszámának listázása állomások szerint, állomás-információval</h1>";
    echo "<table>";
    echo "<tr><th>Jegyazonosító</th><th>Felhasználónév</th><th>Járat azonosító</th><th>Induló állomás</th><th>Cél állomás</th><th>Darabszám</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["jegyazonosito"] . "</td><td>" . $row["felhasznalonev"] . "</td><td>" . $row["jaratazonosito"] . "</td><td>" . $row["induloallomas"] . "</td><td>" . $row["celallomas"] . "</td><td>" . $row["ticket_count"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek jegyek a megadott állomásokkal.";
}

// Close the database connection
$conn->close();