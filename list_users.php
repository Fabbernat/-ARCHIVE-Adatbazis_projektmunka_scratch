<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

// Retrieve user data from the database
$sql = "SELECT felhasznalonev, email, vezeteknev, keresztnev, szerep FROM felhasznalo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display user data in a table
    echo "<table>";
    echo "<tr><th>Felhasználónév</th><th>E-mail</th><th>Vezetéknév</th><th>Keresztnév</th><th>Szerep</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["felhasznalonev"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["vezeteknev"] . "</td>";
        echo "<td>" . $row["keresztnev"] . "</td>";
        echo "<td>" . $row["szerep"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek felhasználók az adatbázisban.";
}

// Database connection close
$conn->close();
?>
</body>
</html>
