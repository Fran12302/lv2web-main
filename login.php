<?php
session_start();
include("includes/db.php");

$poruka = "";

if (isset($_POST['login'])) {
    $korisnicko_ime = trim($_POST['korisnicko_ime']);
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $korisnik = mysqli_fetch_assoc($result);

        if (password_verify($lozinka, $korisnik['lozinka'])) {
            $_SESSION['korisnik_id'] = $korisnik['id'];
            $_SESSION['korisnicko_ime'] = $korisnik['korisnicko_ime'];
            $_SESSION['uloga'] = $korisnik['uloga'];

            header("Location: filmovi.php");
            exit();
        } else {
            $poruka = "Pogrešna lozinka.";
        }
    } else {
        $poruka = "Korisnik ne postoji.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>

<header>
    <h1>Moja web stranica o filmovima</h1>
</header>

<main class="content">
    <section>
        <h2>Prijava korisnika</h2>

        <p><?php echo $poruka; ?></p>

        <form method="POST">
            <input type="text" name="korisnicko_ime" placeholder="Korisničko ime" required><br><br>
            <input type="password" name="lozinka" placeholder="Lozinka" required><br><br>

            <button type="submit" name="login">Prijavi se</button>
        </form>

        <br>
        <a href="registracija.php">Nemaš račun? Registriraj se</a>
    </section>
</main>

<footer>
    <p>&copy; 2025. Web programiranje. Sva prava pridržana.</p>
</footer>

</body>
</html>