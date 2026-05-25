<?php
include("includes/db.php");

if (!isset($_GET['id'])) {
    die("ID filma nije poslan.");
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM filmovi WHERE id = $id";
$result = mysqli_query($conn, $sql);
$film = mysqli_fetch_assoc($result);

if (!$film) {
    die("Film nije pronađen.");
}

$poruka = "";

if (isset($_POST['spremi'])) {
    $naslov = mysqli_real_escape_string($conn, trim($_POST['naslov']));
    $zanr = mysqli_real_escape_string($conn, trim($_POST['zanr']));
    $godina = (int) $_POST['godina'];
    $trajanje = (int) $_POST['trajanje'];
    $ocjena = (float) $_POST['ocjena'];
    $reziser = mysqli_real_escape_string($conn, trim($_POST['reziser']));
    $drzava = mysqli_real_escape_string($conn, trim($_POST['drzava']));

    if (empty($naslov) || empty($zanr) || empty($reziser) || empty($drzava)) {
        $poruka = "Sva tekstualna polja moraju biti popunjena.";
    } elseif ($godina < 1888 || $godina > 2026) {
        $poruka = "Godina mora biti između 1888 i 2026.";
    } elseif ($trajanje <= 0) {
        $poruka = "Trajanje mora biti veće od 0.";
    } elseif ($ocjena < 0 || $ocjena > 10) {
        $poruka = "Ocjena mora biti između 0 i 10.";
    } else {
        $sql = "UPDATE filmovi SET 
                Naslov = '$naslov',
                Zanr = '$zanr',
                Godina = '$godina',
                Trajanje_min = '$trajanje',
                Ocjena = '$ocjena',
                Rezisery = '$reziser',
                Zemlja_porijekla = '$drzava'
                WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            header("Location: filmovi.php");
            exit();
        } else {
            $poruka = "Greška pri uređivanju filma.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi film</title>

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

    <h1>Uredi film</h1>

    <div class="poruka">
        <?php echo $poruka; ?>
    </div>

    <form method="POST">

        <input
            type="text"
            name="naslov"
            value="<?php echo htmlspecialchars($film['Naslov']); ?>"
            required
        >

        <input
            type="text"
            name="zanr"
            value="<?php echo htmlspecialchars($film['Zanr']); ?>"
            required
        >

        <input
            type="number"
            name="godina"
            value="<?php echo $film['Godina']; ?>"
            min="1888"
            max="2026"
            required
        >

        <input
            type="number"
            name="trajanje"
            value="<?php echo $film['Trajanje_min']; ?>"
            min="1"
            required
        >

        <input
            type="number"
            step="0.1"
            min="0"
            max="10"
            name="ocjena"
            value="<?php echo $film['Ocjena']; ?>"
            required
        >

        <input
            type="text"
            name="reziser"
            value="<?php echo htmlspecialchars($film['Rezisery']); ?>"
            required
        >

        <input
            type="text"
            name="drzava"
            value="<?php echo htmlspecialchars($film['Zemlja_porijekla']); ?>"
            required
        >

        <button type="submit" name="spremi">
            Spremi promjene
        </button>

    </form>

    <br>

    <a href="filmovi.php">
        Nazad na popis filmova
    </a>

</div>

</body>
</html>