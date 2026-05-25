<?php
session_start();

include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['film_id'])) {
    die("Film nije odabran.");
}

$film_id = (int) $_GET['film_id'];
$korisnik_id = $_SESSION['korisnik_id'];

$sqlFilm = "SELECT * FROM filmovi WHERE id = $film_id";
$resultFilm = mysqli_query($conn, $sqlFilm);
$film = mysqli_fetch_assoc($resultFilm);

if (!$film) {
    die("Film nije pronađen.");
}

$upozorenje = "";

if ($film['Ocjena'] < 5.0) {
    $upozorenje = "Upozorenje: Ovaj film ima nisku ocjenu – jeste li sigurni da ga želite dodati?";
}

$provjera = "SELECT * FROM zeljeni_filmovi 
             WHERE korisnik_id = $korisnik_id 
             AND film_id = $film_id";

$resultProvjera = mysqli_query($conn, $provjera);

if (mysqli_num_rows($resultProvjera) == 0) {

    $sql = "INSERT INTO zeljeni_filmovi (korisnik_id, film_id)
            VALUES ($korisnik_id, $film_id)";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodavanje filma</title>

    <style>
        body {
            font-family: Arial;
            padding: 30px;
        }

        .upozorenje {
            background-color: #ffcccc;
            color: darkred;
            padding: 15px;
            border: 1px solid red;
            margin-bottom: 20px;
            width: 500px;
        }

        .uspjeh {
            background-color: #ccffcc;
            color: darkgreen;
            padding: 15px;
            border: 1px solid green;
            width: 500px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php if ($upozorenje != "") { ?>
    <div class="upozorenje">
        <?php echo $upozorenje; ?>
    </div>
<?php } ?>

<div class="uspjeh">
    Film "<?php echo $film['Naslov']; ?>" dodan je u videoteka popis.
</div>

<a href="filmovi.php">
    Nazad na filmove
</a>

</body>
</html>