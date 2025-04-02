<?php
require 'config.php';

$query = "SELECT ID, Imię, Nazwisko FROM pracownicy";
$result = $conn->query($query);

$options = "<option value =''> Wybierz osobę </option>";

while ($row = $result->fetch_assoc()) {
    $options .= "<option value='{$row['ID']}'> {$row['Imię']} {$row['Nazwisko']} </option>";
}
echo $options;
?>