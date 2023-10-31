<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Fabian Transport - Járatok</title>
    </head>
    <body>
        <h1>Járatok</h1>

        <!-- Szűrés állomások szerint -->
        <h2>Szűrés állomások szerint:</h2>
        <label for="indulo_allomas">Induló állomás:</label>
        <input type="text" id="indulo_allomas">
        <label for="cel_allomas">Cél állomás:</label>
        <input type="text" id="cel_allomas">
        <button onclick="szuresAllomasSzerint()">Szűrés</button>

        <!-- Szűrés közlekedési eszköz szerint -->
        <h2>Szűrés közlekedési eszköz szerint:</h2>
        <input type="checkbox" id="busz" name="kozlekedes" value="busz">
        <label for="busz">Busz</label>
        <input type="checkbox" id="vonat" name="kozlekedes" value="vonat">
        <label for="vonat">Vonat</label>
        <input type="checkbox" id="repulo" name="kozlekedes" value="repulo">
        <label for="repulo">Repülő</label>
        <button onclick="szuresKozlekedesSzerint()">Szűrés</button>

        <!-- Kikapcsolás gomb -->
        <button onclick="torles()">Törlés</button>

        <script>
            function szuresAllomasSzerint() {
                // Szűrés megvalósítása állomások szerint
                var induloAllomas = document.getElementById("indulo_allomas").value;
                var celAllomas = document.getElementById("cel_allomas").value;

                // Itt hozzáfűz szűrés logikáját
                // Például: elküld az állomásokat a szerverre és lekér a szűrt járatokat

                // Eredmények megjelenítése - példa
                var eredmenyekDiv = document.getElementById("eredmenyek");
                eredmenyekDiv.innerHTML = "Szűrt járatok: " + induloAllomas + " -> " + celAllomas;
            }

            function torles() {
                // Kikapcsolás, visszaállítás a szűrés nélküli állapotra
                document.getElementById("indulo_allomas").value = "";
                document.getElementById("cel_allomas").value = "";
                const checkboxes = document.querySelectorAll('input[name="kozlekedes"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        </script>

        <!-- Keresési eredmények megjelenítése -->
        <div id="eredmenyek">
            <!-- Itt jelennek meg a szűrt járatok -->
        </div>
    </body>
</html>
