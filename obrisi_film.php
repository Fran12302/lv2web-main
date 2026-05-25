<?php
include("includes/db.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "DELETE FROM filmovi WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: filmovi.php");
        exit();
    } else {
        echo "Greška pri brisanju filma.";
    }
} else {
    echo "ID filma nije poslan.";
}
?>