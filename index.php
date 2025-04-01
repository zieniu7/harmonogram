<?php 
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tygodniowy harmonogram pracy</title>
</head>
<body>
    <center>
    <h1>Harmonogram pracy</h1>

    <form action="index.php" id="form">
        <label for="pracownik"> Wybierz pracownika: </label>
        <select name="pracownikID" id="pracownikID">
        <option value="">Wszyscy</option> 
        <?php 
        $query = "SELECT ID, Imię, Nazwisko FROM pracownicy";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()){
            echo "<option value = '{$row['id']}'> {$row['imię']} {$row['nazwisko']} </option>";
        }
        ?>
        </select> <br><br>

        <label for="data_od">Data od: </label>
        <input type="date" name="data_od" id="data_od"> <br><br>

        <label for="data_do">Data do: </label>
        <input type="date" name="data_do" id="data_do"> <br><br>

        <button type="submit">Filtruj</button>
    </form>

    <div id="harmonogram">
        <p>Ładowanie danych...</p>
    </div>


    </center>
</body>
</html>