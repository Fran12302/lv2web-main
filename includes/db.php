<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "filmovi_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Greška pri spajanju na bazu: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>