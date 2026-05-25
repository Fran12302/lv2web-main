<?php
session_start();

include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$jeAdmin = isset($_SESSION['uloga']) && $_SESSION['uloga'] === 'admin';

$zanr = $_GET['zanr'] ?? "";
$godina_od = $_GET['godina_od'] ?? "";
$godina_do = $_GET['godina_do'] ?? "";
$drzava = $_GET['drzava'] ?? "";
$sort = $_GET['sort'] ?? "";

$sql = "SELECT * FROM filmovi WHERE 1=1";

if ($zanr != "") {
    $sql .= " AND Zanr LIKE '%$zanr%'";
}

if ($godina_od != "") {
    $sql .= " AND Godina >= $godina_od";
}

if ($godina_do != "") {
    $sql .= " AND Godina <= $godina_do";
}

if ($drzava != "") {
    $sql .= " AND Zemlja_porijekla LIKE '%$drzava%'";
}

if ($sort == "ocjena_desc") {
    $sql .= " ORDER BY Ocjena DESC";
}
elseif ($sort == "ocjena_asc") {
    $sql .= " ORDER BY Ocjena ASC";
}
elseif ($sort == "godina_desc") {
    $sql .= " ORDER BY Godina DESC";
}
elseif ($sort == "godina_asc") {
    $sql .= " ORDER BY Godina ASC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP videoteka</title>
    <link rel="stylesheet" href="public/style.css">
</head>

<body>

<header>
    <h1>Moja web stranica o filmovima</h1>
</header>

<input type="checkbox" id="menu-toggle" class="menu-toggle">
<label for="menu-toggle" class="menu-btn">☰ Menu</label>

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

<h2>PHP videoteka</h2>

<p>
    Prijavljeni korisnik:
    <strong><?php echo $_SESSION['korisnicko_ime']; ?></strong>

    <?php if ($jeAdmin) { ?>
        <strong>(admin)</strong>
    <?php } ?>
</p>

<?php if ($jeAdmin) { ?>
    <a class="button-link" href="dodaj_film.php">
        Dodaj novi film
    </a>
<?php } ?>

<a class="button-link" href="moja_videoteka.php">
    Moja videoteka
</a>

<a class="button-link" href="logout.php">
    Odjava
</a>

<br><br>

<div id="filteri">

<form method="GET">

    <input
        type="text"
        name="zanr"
        placeholder="Žanr"
        value="<?php echo htmlspecialchars($zanr); ?>"
    >

    <input
        type="number"
        name="godina_od"
        placeholder="Godina od"
        value="<?php echo htmlspecialchars($godina_od); ?>"
    >

    <input
        type="number"
        name="godina_do"
        placeholder="Godina do"
        value="<?php echo htmlspecialchars($godina_do); ?>"
    >

    <input
        type="text"
        name="drzava"
        placeholder="Država"
        value="<?php echo htmlspecialchars($drzava); ?>"
    >

    <select name="sort">
        <option value="">Bez sortiranja</option>

        <option value="ocjena_desc" <?php if ($sort === "ocjena_desc") echo "selected"; ?>>
            Ocjena silazno
        </option>

        <option value="ocjena_asc" <?php if ($sort === "ocjena_asc") echo "selected"; ?>>
            Ocjena uzlazno
        </option>

        <option value="godina_desc" <?php if ($sort === "godina_desc") echo "selected"; ?>>
            Godina silazno
        </option>

        <option value="godina_asc" <?php if ($sort === "godina_asc") echo "selected"; ?>>
            Godina uzlazno
        </option>
    </select>

    <button type="submit">
        Filtriraj
    </button>

    <a class="button-link" href="filmovi.php">
        Reset
    </a>

</form>

</div>

<br>

<div class="data-container">

<article class="table-section">

<table>

    <thead>
    <tr>
        <th>ID</th>
        <th>Naslov</th>
        <th>Žanr</th>
        <th>Godina</th>
        <th>Trajanje</th>
        <th>Režiser</th>
        <th>Država</th>
        <th>Ocjena</th>
        <th>Akcija</th>
    </tr>
    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['Naslov']; ?></td>

            <td><?php echo $row['Zanr']; ?></td>

            <td><?php echo $row['Godina']; ?></td>

            <td><?php echo $row['Trajanje_min']; ?> min</td>

            <td><?php echo $row['Rezisery']; ?></td>

            <td><?php echo $row['Zemlja_porijekla']; ?></td>

            <td><?php echo $row['Ocjena']; ?></td>

            <td>
                <?php if ($jeAdmin) { ?>

                    <a href="uredi_film.php?id=<?php echo $row['id']; ?>">
                        Uredi
                    </a>

                    |

                    <a
                        href="obrisi_film.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Jeste li sigurni?');"
                    >
                        Obriši
                    </a>

                    |

                <?php } ?>

                <a href="dodaj_u_videoteku.php?film_id=<?php echo $row['id']; ?>">
                    Dodaj u videoteku
                </a>
            </td>
        </tr>

    <?php } ?>

    </tbody>

</table>

</article>

</div>

</section>

</main>

<footer>
    <p>&copy; 2025. Web programiranje. Sva prava pridržana.</p>
</footer>

</body>
</html>