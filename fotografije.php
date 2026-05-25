<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$korisnik_id = $_SESSION['korisnik_id'];
$poruka = "";

/* UPLOAD SLIKE */
if (isset($_POST['upload'])) {
    $opis = mysqli_real_escape_string($conn, trim($_POST['opis']));

    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === 0) {
        $naziv = $_FILES['slika']['name'];
        $tmp = $_FILES['slika']['tmp_name'];
        $velicina = $_FILES['slika']['size'];
        $tip = $_FILES['slika']['type'];

        $dozvoljeni_tipovi = ['image/jpeg', 'image/png'];

        if (!in_array($tip, $dozvoljeni_tipovi)) {
            $poruka = "Dozvoljene su samo JPEG i PNG slike.";
        } elseif ($velicina > 5 * 1024 * 1024) {
            $poruka = "Slika ne smije biti veća od 5MB.";
        } else {
            $novo_ime = time() . "_" . basename($naziv);
            $putanja = "public/uploads/" . $novo_ime;

            if (move_uploaded_file($tmp, $putanja)) {
                $sql = "INSERT INTO slike (naziv_datoteke, opis, putanja, korisnik_id)
                        VALUES ('$novo_ime', '$opis', '$putanja', $korisnik_id)";

                mysqli_query($conn, $sql);
                $poruka = "Slika je uspješno dodana.";
            } else {
                $poruka = "Greška pri spremanju slike.";
            }
        }
    } else {
        $poruka = "Morate odabrati sliku.";
    }
}

/* OCJENJIVANJE */
if (isset($_POST['ocijeni'])) {
    $slika_id = (int) $_POST['slika_id'];
    $ocjena = (int) $_POST['ocjena'];

    if ($ocjena >= 1 && $ocjena <= 5) {
        $sql = "INSERT INTO ocjene_slika (slika_id, korisnik_id, ocjena)
                VALUES ($slika_id, $korisnik_id, $ocjena)
                ON DUPLICATE KEY UPDATE 
                ocjena = $ocjena,
                vrijeme_ocjene = CURRENT_TIMESTAMP";

        mysqli_query($conn, $sql);
        $poruka = "Ocjena je spremljena.";
    }
}

$sql = "SELECT slike.*,
        AVG(ocjene_slika.ocjena) AS prosjek
        FROM slike
        LEFT JOIN ocjene_slika ON slike.id = ocjene_slika.slika_id
        GROUP BY slike.id
        ORDER BY slike.datum_dodavanja DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Fotografije</title>
    <link rel="stylesheet" href="public/style.css">

    <style>
        .galerija-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .slika-card {
            background: white;
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
            text-align: center;
        }

        .slika-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .upload-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        input, select, textarea, button {
            padding: 8px;
            margin: 6px 0;
        }

        .poruka {
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
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
    <h2>Ocjenjivanje fotografija</h2>

    <p class="poruka"><?php echo $poruka; ?></p>

    <div class="upload-box">
        <h3>Dodaj novu sliku</h3>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="slika" accept="image/jpeg,image/png" required><br>

            <textarea name="opis" placeholder="Opis slike"></textarea><br>

            <button type="submit" name="upload">
                Upload slike
            </button>
        </form>
    </div>

    <div class="galerija-grid">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="slika-card">
                <img src="<?php echo $row['putanja']; ?>" alt="<?php echo htmlspecialchars($row['opis']); ?>">

                <p><?php echo htmlspecialchars($row['opis']); ?></p>

                <p>
                    Prosječna ocjena:
                    <strong>
                        <?php
                        if ($row['prosjek']) {
                            echo number_format($row['prosjek'], 1);
                        } else {
                            echo "Nema ocjena";
                        }
                        ?>
                    </strong>
                </p>

                <form method="POST">
                    <input type="hidden" name="slika_id" value="<?php echo $row['id']; ?>">

                    <select name="ocjena" required>
                        <option value="">Ocijeni</option>
                        <option value="1">1 ⭐</option>
                        <option value="2">2 ⭐⭐</option>
                        <option value="3">3 ⭐⭐⭐</option>
                        <option value="4">4 ⭐⭐⭐⭐</option>
                        <option value="5">5 ⭐⭐⭐⭐⭐</option>
                    </select>

                    <button type="submit" name="ocijeni">
                        Spremi ocjenu
                    </button>
                </form>
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