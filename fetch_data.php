<?php
require 'config.php';

$pracownikID = isset($_GET['pracownikID']) ? $_GET['pracownikID'] : '';
$dataOd = isset($_GET['dataOd']) ? $_GET['dataOd'] : '';
$dataDo = isset($_GET['dataDo']) ? $_GET['dataDo'] : '';
$showDescriptions = isset($_GET['showDescriptions']) ? $_GET['showDescriptions'] : 0;
$columnWidth = isset($_GET['columnWidth']) ? $_GET['columnWidth'] : 200;

$query = "SELECT h.*, p.Imię, p.Nazwisko FROM harmonogram h 
          JOIN pracownicy p ON h.Pracownik_id = p.ID WHERE 1";

if (!empty($pracownikID)) {
    $query .= " AND h.Pracownik_id = '" . $conn->real_escape_string($pracownikID) . "'";
}
if (!empty($dataOd)) {
    $query .= " AND h.Data >= '" . $conn->real_escape_string($dataOd) . "'";
}
if (!empty($dataDo)) {
    $query .= " AND h.Data <= '" . $conn->real_escape_string($dataDo) . "'";
}

$query .= " ORDER BY h.Data, h.Godzina";

$result = $conn->query($query);

echo "<table border='1' style='width: 100%; text-align: center;'>";
echo "<tr> 
        <th style='width: {$columnWidth}px;'>Pracownik</th>
        <th style='width: {$columnWidth}px;'>Firma</th>
        <th style='width: {$columnWidth}px;'>Data</th>
        <th style='width: {$columnWidth}px;'>Godzina</th>";
if ($showDescriptions) {
    echo "<th style='width: {$columnWidth}px;'>Opis</th>";
}
echo "</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['Imię']} {$row['Nazwisko']}</td>";
    echo "<td>{$row['Firma']}</td>";
    echo "<td>{$row['Data']}</td>";
    echo "<td>{$row['Godzina']}</td>";
    if ($showDescriptions) {
        echo "<td>{$row['Opis']}</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
