<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

// Űrlap adatainak feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Ellenőrizzük, hogy a jelszavak megegyeznek-e
    if ($password !== $confirm_password) {
        echo "A megadott jelszavak nem egyeznek meg.";
    } else {
        // Jelszó titkosítása (pl. használva a password_hash függvényt)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $felhasznalo = "http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=adatb_helyfoglalas&table=felhasznalo";
        // Adatok beszúrása az adatbázisba
        $sql = "INSERT INTO $felhasznalo (felhasznalonev, email, jelszo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Sikeres regisztráció!";
        } else {
            echo "Hiba a regisztráció során: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Adatbázis kapcsolat bezárása
$conn->close();
