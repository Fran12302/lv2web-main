<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT Zanr FROM filmovi";
$result = mysqli_query($conn, $sql);

$zanrovi = [];

while ($row = mysqli_fetch_assoc($result)) {
    $lista = explode(",", $row['Zanr']);

    foreach ($lista as $zanr) {
        $zanr = trim($zanr);

        if (!isset($zanrovi[$zanr])) {
            $zanrovi[$zanr] = 0;
        }

        $zanrovi[$zanr]++;
    }
}

arsort($zanrovi);

$max = max($zanrovi);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Grafikoni filmova</title>

    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/grafikon.css">
</head>
<body>

<header>
    <h1>Moja web stranica o filmovima</h1>
</header>

<nav aria-label="Primarna navigacija">
    <ul class="nav-menu">
        <li><a href="filmovi.php">Početna</a></li>
        <li><a href="grafikon.php">Grafikoni</a></li>
        <li><a href="moja_videoteka.php">Moja videoteka</a></li>
        <li><a href="fotografije.php">Fotografije</a></li>
        <li><a href="logout.php">Odjava</a></li>
    </ul>
</nav>

<main class="content">
    <section>
        <h2>Zastupljenost žanrova filmova</h2>

        <p class="chart-intro">
            Grafikon se generira iz stvarnih podataka spremljenih u MySQL bazi.
        </p>

        <div class="chart-desktop">

            <?php foreach ($zanrovi as $zanr => $broj) { 
                $sirina = ($broj / $max) * 100;
            ?>

                <div class="bar-row">
                    <span class="bar-label">
                        <?php echo htmlspecialchars($zanr); ?> (<?php echo $broj; ?>)
                    </span>

                    <div class="bar-track">
                        <div
                            class="bar-fill"
                            style="width: <?php echo $sirina; ?>%; background: #ff7b00;"
                        ></div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </section>
</main>

<footer>
    <p>&copy; 2025. Web programiranje. Sva prava pridržana.</p>
</footer>

</body>
</html>