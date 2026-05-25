<?php
include("includes/db.php");

$poruka = "";

if (isset($_POST['registracija'])) {
    $korisnicko_ime = trim($_POST['korisnicko_ime']);
    $email = trim($_POST['email']);
    $lozinka = $_POST['lozinka'];

    if (empty($korisnicko_ime) || empty($email) || empty($lozinka)) {
        $poruka = "Sva polja su obavezna.";
    } else {
        $hashirana_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);

        $sql = "INSERT INTO korisnici (korisnicko_ime, email, lozinka)
                VALUES ('$korisnicko_ime', '$email', '$hashirana_lozinka')";

        if (mysqli_query($conn, $sql)) {
            $poruka = "Registracija uspješna. Možete se prijaviti.";
        } else {
            $poruka = "Greška: korisničko ime ili email već postoji.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>

<header>
    <h1>Moja web stranica o filmovima</h1>
</header>

<main class="content">
    <section>
        <h2>Registracija korisnika</h2>

        <p><?php echo $poruka; ?></p>

        <form method="POST">
            <input type="text" name="korisnicko_ime" placeholder="Korisničko ime" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="lozinka" placeholder="Lozinka" required><br><br>

            <button type="submit" name="registracija">Registriraj se</button>
        </form>

        <br>
        <a href="login.php">Već imaš račun? Prijavi se</a>
    </section>
</main>

<footer>
    <p>&copy; 2025. Web programiranje. Sva prava pridržana.</p>
</footer>

</body>
</html>