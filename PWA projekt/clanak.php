<?php
require 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM vijesti WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$vijest = $stmt->fetch();
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $vijest['naslov'] ?></title>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Zaglavlje --> 
    <header class="py-3 h-auto container">
        <div>
            <div class="header_logo_frame">
                <img src="img/Stern_Logo.svg.png" class="header_logo" alt="logo">
            </div>
            <div class="header_links_frame">
                <h1 class="stern_title">stern</h1>
                <!-- Navigacija -->
                <nav>
                <a href="index.php">Home</a>
                    <a href="politik.php">Politik</a>
                    <a href="gesundheit.php" >Gesundheit</a>
                    <a href="gesundheit.php">Spaß</a>
                    <a href="spas.php">Administrator</a>
                    <a href="unos.php">Dodaj Vijest</a>
                </nav>
            </div>
        </div>
    </header>


    <!-- Main -->
    <main class="container my-4">
        <article>
            <div class="naslov_datum_blok">
                <h2><strong><?= ($vijest['naslov']) ?></strong></h2>
                <p><?= date("d.m.Y", strtotime($vijest['datum'])) ?></p>
            </div>

            <p><?= $vijest['kratki_sadrzaj'] ?> </p>

            <img src="<?= $vijest['slika'] ?>" width="100%" alt="img" />

            <br>

            <p><?= $vijest['sadrzaj'] ?></p>
        </article>
    </main>
    

    <!-- Podnožje -->
    <footer>
        <p>Maks Bunoza (0246116072) - mbunoza@tvz.hr - 2025.</p>
    </footer>
</body>
</html>


