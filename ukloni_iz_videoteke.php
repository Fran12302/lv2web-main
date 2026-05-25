<?php
session_start();

include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $korisnik_id = $_SESSION['korisnik_id'];

    $sql = "DELETE FROM zeljeni_filmovi
            WHERE id = $id AND korisnik_id = $korisnik_id";

    mysqli_query($conn, $sql);
}

header("Location: moja_videoteka.php");
exit();
?>