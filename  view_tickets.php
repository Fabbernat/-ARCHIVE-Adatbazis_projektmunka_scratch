<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a way to identify the current user (e.g., from a session)
    $current_user = "felhasznaloneved"; // Replace with the actual username

    // Query to retrieve the user's own tickets
    $sql = "SELECT * FROM jegy WHERE felhasznalonev = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $current_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h1>Felhasználó saját jegyeinek listája</h1>";
        echo "<table>";
        echo "<tr><th>Jegyazonosító</th><th>Járat azonosító</th><th>Felhasználónév</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["jegyazonosito"] . "</td><td>" . $row["jaratazonosito"] . "</td><td>" . $row["felhasznalonev"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Nincsenek jegyek a felhasználónak.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}