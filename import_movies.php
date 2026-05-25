<?php
include "includes/db.php";

$csvFile = "public/movies.csv";

if (!file_exists($csvFile)) {
    die("CSV datoteka nije pronađena.");
}

$sql = "TRUNCATE TABLE filmovi";
mysqli_query($conn, $sql);

$file = fopen($csvFile, "r");

$header = fgetcsv($file);

while (($row = fgetcsv($file)) !== false) {
    $naslov = mysqli_real_escape_string($conn, $row[0]);
    $zanr = mysqli_real_escape_string($conn, $row[1]);
    $godina = (int)$row[2];
    $trajanje = (int)$row[3];
    $ocjena = (float)$row[4];
    $reziser = mysqli_real_escape_string($conn, $row[5]);
    $drzava = mysqli_real_escape_string($conn, $row[6]);

    $sql = "INSERT INTO filmovi 
            (Naslov, Zanr, Godina, Trajanje_min, Ocjena, Rezisery, Zemlja_porijekla)
            VALUES
            ('$naslov', '$zanr', $godina, $trajanje, $ocjena, '$reziser', '$drzava')";

    mysqli_query($conn, $sql);
}

fclose($file);

echo "Filmovi su uspješno ubačeni u bazu.";
?>