<?php
require 'config.php';
header('Content-Type: application/json');

// Sprawdzamy, czy mamy ID pracownika w zapytaniu GET
if (!isset($_GET['pracownikID']) || empty($_GET['pracownikID'])) {
    echo json_encode(["error" => "Brak ID pracownika"]);
    exit;
}

// Oczyszczamy i konwertujemy ID pracownika na liczbę całkowitą
$pracownikID = intval($_GET['pracownikID']);

// Przygotowujemy zapytanie SQL, aby pobrać dane harmonogramu
$query = "SELECT data, godzina, firma, opis FROM harmonogram WHERE Pracownik_id = ?";
$stmt = $conn->prepare($query);

// Sprawdzamy, czy przygotowanie zapytania SQL się powiodło
if (!$stmt) {
    echo json_encode(["error" => "Błąd SQL: " . $conn->error]);
    exit;
}

// Przypisujemy parametr do zapytania (ID pracownika)
$stmt->bind_param("i", $pracownikID);
$stmt->execute();
$result = $stmt->get_result();

// Tworzymy pustą tablicę na dane harmonogramu
$schedule = [];

// Przechodzimy przez wyniki zapytania i dodajemy każdy wiersz do tablicy
while ($row = $result->fetch_assoc()) {
    $schedule[] = $row;  // Dodajemy wiersz do tablicy harmonogramu
}

// Jeśli harmonogram jest pusty, zwracamy odpowiedni komunikat
if (empty($schedule)) {
    echo json_encode(["error" => "Brak danych harmonogramu"]);
    exit;
}

// Zwracamy dane harmonogramu w formacie JSON
echo json_encode($schedule, JSON_PRETTY_PRINT);
?>
