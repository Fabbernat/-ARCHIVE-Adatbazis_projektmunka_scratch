<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ellenőrzés a felhasználói adatok alapján
    $sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["jelszo"])) {
            echo "Sikeres bejelentkezés!";
            // Itt további műveletek végrehajthatók, például session létrehozása.
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nem található felhasználó ezzel a névvel!";
    }

    $stmt->close();
}

// Adatbázis kapcsolat bezárása
$conn->close();
