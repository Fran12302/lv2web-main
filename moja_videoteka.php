<?php
session_start();

include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$korisnik_id = $_SESSION['korisnik_id'];

$sql = "SELECT zeljeni_filmovi.id AS zapis_id, filmovi.*
        FROM zeljeni_filmovi
        INNER JOIN filmovi ON zeljeni_filmovi.film_id = filmovi.id
        WHERE zeljeni_filmovi.korisnik_id = $korisnik_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Moja videoteka</title>

    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background-color: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        a {
            font-weight: bold;
            text-decoration: none;
        }

        .nazad {
            display: inline-block;
            margin-bottom: 20px;
            background: orange;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .ukloni {
            color: red;
        }
    </style>
</head>
<body>

<h1>Moja videoteka</h1>

<p>
    Prijavljeni korisnik:
    <strong><?php echo $_SESSION['korisnicko_ime']; ?></strong>
</p>

<a class="nazad" href="filmovi.php">Nazad na sve filmove</a>

<table>
    <tr>
        <th>Naslov</th>
        <th>Žanr</th>
        <th>Godina</th>
        <th>Trajanje</th>
        <th>Ocjena</th>
        <th>Režiser</th>
        <th>Država</th>
        <th>Akcija</th>
    </tr>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <tr>
            <td colspan="8">Još niste dodali nijedan film u videoteku.</td>
        </tr>
    <?php } ?>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['Naslov']; ?></td>
            <td><?php echo $row['Zanr']; ?></td>
            <td><?php echo $row['Godina']; ?></td>
            <td><?php echo $row['Trajanje_min']; ?> min</td>
            <td><?php echo $row['Ocjena']; ?></td>
            <td><?php echo $row['Rezisery']; ?></td>
            <td><?php echo $row['Zemlja_porijekla']; ?></td>
            <td>
                <a class="ukloni"
                   href="ukloni_iz_videoteke.php?id=<?php echo $row['zapis_id']; ?>"
                   onclick="return confirm('Ukloniti film iz videoteke?');">
                    Ukloni
                </a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>