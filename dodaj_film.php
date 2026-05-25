<?php
include("includes/db.php");

$poruka = "";

if(isset($_POST['dodaj'])) {

    $naslov = mysqli_real_escape_string($conn, trim($_POST['naslov']));
    $zanr = mysqli_real_escape_string($conn, trim($_POST['zanr']));
    $godina = (int) $_POST['godina'];
    $trajanje = (int) $_POST['trajanje'];
    $ocjena = (float) $_POST['ocjena'];
    $reziser = mysqli_real_escape_string($conn, trim($_POST['reziser']));
    $drzava = mysqli_real_escape_string($conn, trim($_POST['drzava']));

    if (
        empty($naslov) ||
        empty($zanr) ||
        empty($reziser) ||
        empty($drzava)
    ) {

        $poruka = "Sva tekstualna polja moraju biti popunjena.";

    } elseif ($godina < 1888 || $godina > 2026) {

        $poruka = "Godina mora biti između 1888 i 2026.";

    } elseif ($trajanje <= 0) {

        $poruka = "Trajanje mora biti veće od 0.";

    } elseif ($ocjena < 0 || $ocjena > 10) {

        $poruka = "Ocjena mora biti između 0 i 10.";

    } else {

        $sql = "INSERT INTO filmovi 
        (Naslov, Zanr, Godina, Trajanje_min, Ocjena, Rezisery, Zemlja_porijekla)
        VALUES
        ('$naslov', '$zanr', '$godina', '$trajanje', '$ocjena', '$reziser', '$drzava')";

        if(mysqli_query($conn, $sql)) {

            $poruka = "Film uspješno dodan!";

        } else {

            $poruka = "Greška pri dodavanju filma.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj film</title>

    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background-color: #f4f4f4;
        }

        .forma-box {
            width: 420px;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background: orange;
            color: white;
            border: none;
            cursor: pointer;
        }

        .poruka {
            margin-bottom: 15px;
            font-weight: bold;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="forma-box">

    <h1>Dodaj novi film</h1>

    <div class="poruka">
        <?php echo $poruka; ?>
    </div>

    <form method="POST">

        <input
            type="text"
            name="naslov"
            placeholder="Naslov"
            required
        >

        <input
            type="text"
            name="zanr"
            placeholder="Žanr"
            required
        >

        <input
            type="number"
            name="godina"
            placeholder="Godina"
            min="1888"
            max="2026"
            required
        >

        <input
            type="number"
            name="trajanje"
            placeholder="Trajanje"
            min="1"
            required
        >

        <input
            type="number"
            step="0.1"
            min="0"
            max="10"
            name="ocjena"
            placeholder="Ocjena"
            required
        >

        <input
            type="text"
            name="reziser"
            placeholder="Režiser"
            required
        >

        <input
            type="text"
            name="drzava"
            placeholder="Država"
            required
        >

        <button type="submit" name="dodaj">
            Dodaj film
        </button>

    </form>

    <br>

    <a href="filmovi.php">
        Nazad na filmove
    </a>

</div>

</body>
</html>