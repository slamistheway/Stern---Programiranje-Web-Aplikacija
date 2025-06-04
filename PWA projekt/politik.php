<?php

require 'db.php';

$sql = "SELECT * FROM vijesti WHERE kategorija = 'politika' AND arhiviraj = 0 ORDER BY id DESC";
$stmt = $pdo->query($sql);
$vijesti = $stmt->fetchAll();

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Politik</title>
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
                    <a href="index.php" >Home</a>
                    <a href="politik.php" class="active">Politik</a>
                    <a href="gesundheit.php">Gesundheit</a>
                    <a href="spas.php" >Spaß</a>
                    <a href="administrator.php">Administrator</a>
                    <a href="unos.php">Dodaj Vijest</a>
                </nav>
            </div>
        </div>
    </header>



    <!-- Main -->
    <main class="container">
        <section class="mt-4">
            <h2 class="fw-bold">POLITIK ></h2>
            <div class="row">
                <?php foreach ($vijesti as $vijest): ?>
                    <?php if ($vijest['kategorija'] === 'politika'): ?>
                        <article class="clanak_box col-lg-4 col-md-6 col-sm-12 mb-5">
                            <a href="clanak.php?id=<?= $vijest['id'] ?>">
                                <img src="<?= $vijest['slika'] ?>" class="img-fluid" alt="Slika vijesti">
                                <h5><?= $vijest['naslov'] ?></h5>
                            </a>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>


    <!-- Podnožje -->
    <footer>
        <p>Maks Bunoza (0246116072) - mbunoza@tvz.hr - 2025.</p>
    </footer>

</body>
</html>