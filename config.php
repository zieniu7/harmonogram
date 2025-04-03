<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tygodniowyharmonogrampracy";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia " . $conn->connect_error);
}

$conn-> set_charset("utf8mb4");
?>
