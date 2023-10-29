<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a way to identify the current user (e.g., from a session)
    $current_user = "felhasznaloneved"; // Replace with the actual username

    // Retrieve form data
    $ticket_type = $_POST["ticket_type"];
    $num_tickets = $_POST["num_tickets"];

    // Insert purchased tickets into the database
    $sql = "INSERT INTO jegy (jaratazonosito, felhasznalonev, darab) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $ticket_type, $current_user, $num_tickets);

    if ($stmt->execute()) {
        echo "Sikeres jegyvásárlás!";
    } else {
        echo "Hiba a jegyvásárlás során: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jegyvásárlás</title>
</head>
<body>
<h1>Jegyvásárlás</h1>
<form action="buy_tickets.php" method="post">
    <label for="ticket_type">Járat azonosító:</label>
    <input type="text" name="ticket_type" id="ticket_type" required>
    <br>
    <label for="num_tickets">Darabszám:</label>
    <input type="number" name="num_tickets" id="num_tickets" required>
    <br>
    <input type="submit" value="Jegyvásárlás">
</form>
</body>
</html>