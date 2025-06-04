<?php
session_start();

require 'db.php';

$sql = "SELECT * FROM vijesti ORDER BY id DESC";
$stmt = $pdo->query($sql);
$vijesti = $stmt->fetchAll();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $newsId = intval($_POST['id']);
    $stmt = $pdo->prepare("DELETE FROM vijesti WHERE id = :id");
    $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: administrator.php");
}

?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator</title>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="container py-3">
        <div class="header_logo_frame">
            <img src="img/Stern_Logo.svg.png" class="header_logo" alt="logo">
        </div>
        <div class="header_links_frame">
            <h1 class="stern_title">stern</h1>
            <!-- Navigacija -->
            <nav>
                <a href="index.php">Home</a>
                <a href="politik.php">Politik</a>
                <a href="gesundheit.php">Gesundheit</a>
                <a href="spas.php" >Spaß</a>
                <a href="administrator.php" class="active">Administrator</a>
                <a href="unos.php">Dodaj Vijest</a>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        <h2 class="fw-bold mb-4">Administrator</h2>


        <section class="mt-4">
            <h2 class="fw-bold">POLITIK</h2>
            <div class="row">
                <?php foreach ($vijesti as $vijest): ?>
                    <?php if ($vijest['kategorija'] === 'politika'): ?>
                        <article class="clanak_box col-lg-4 col-md-6 col-sm-12 mb-5">
                            <a href="clanak.php?id=<?= $vijest['id'] ?>">
                                <img src="<?= htmlspecialchars($vijest['slika']) ?>" class="img-fluid" alt="Slika vijesti">
                                <h5><?= htmlspecialchars($vijest['naslov']) ?></h5>
                                <p>ID vijesti: <?= $vijest['id'] ?></p>
                                <p>Datum: <?= date('d.m.Y', strtotime($vijest['datum'])) ?></p>
                            </a>
                            <a href="uredi vijest.php?id=<?= $vijest['id'] ?>" class="btn mt-3 gumb_edit">Uredi</a>
                            <form method="POST" action="administrator.php" class="d-inline">
                                <input type="hidden" name="id" value="<?= $vijest['id'] ?>">
                                <button type="submit" name="delete" class="btn gumb_izbrisi">Izbriši</button>
                            </form>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mt-4">
            <h2 class="fw-bold">GESUNDHEIT</h2>
            <div class="row">
                <?php foreach ($vijesti as $vijest): ?>
                    <?php if ($vijest['kategorija'] === 'zdravlje'): ?>
                        <article class="clanak_box col-lg-4 col-md-6 col-sm-12 mb-5">
                            <a href="clanak.php?id=<?= $vijest['id'] ?>">
                                <img src="<?= htmlspecialchars($vijest['slika']) ?>" class="img-fluid" alt="Slika vijesti">
                                <h5><?= htmlspecialchars($vijest['naslov']) ?></h5>
                                <p>ID vijesti: <?= $vijest['id'] ?></p>
                                <p>Datum: <?= date('d.m.Y', strtotime($vijest['datum'])) ?></p>
                            </a>
                            <a href="uredi vijest.php?id=<?= $vijest['id'] ?>" class="btn mt-3 gumb_edit">Uredi</a>
                            <form method="POST" action="administrator.php" class="d-inline">
                                <input type="hidden" name="id" value="<?= $vijest['id'] ?>">
                                <button type="submit" name="delete" class="btn gumb_izbrisi">Izbriši</button>
                            </form>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mt-4">
            <h2 class="fw-bold">SPAß</h2>
            <div class="row">
                <?php foreach ($vijesti as $vijest): ?>
                    <?php if ($vijest['kategorija'] === 'zabava'): ?>
                        <article class="clanak_box col-lg-4 col-md-6 col-sm-12 mb-5">
                            <a href="clanak.php?id=<?= $vijest['id'] ?>">
                                <img src="<?= htmlspecialchars($vijest['slika']) ?>" class="img-fluid" alt="Slika vijesti">
                                <h5><?= htmlspecialchars($vijest['naslov']) ?></h5>
                                <p>ID vijesti: <?= $vijest['id'] ?></p>
                                <p>Datum: <?= date('d.m.Y', strtotime($vijest['datum'])) ?></p>
                            </a>
                            <a href="uredi vijest.php?id=<?= $vijest['id'] ?>" class="btn mt-3 gumb_edit">Uredi</a>
                            <form method="POST" action="administrator.php" class="d-inline">
                                <input type="hidden" name="id" value="<?= $vijest['id'] ?>">
                                <button type="submit" name="delete" class="btn gumb_izbrisi">Izbriši</button>
                            </form>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mt-4">
            <h2 class="fw-bold">VERWALTUNG</h2>
            <div class="row">
                <?php foreach ($vijesti as $vijest): ?>
                    <?php if ($vijest['kategorija'] === 'administracija'): ?>
                        <article class="clanak_box col-lg-4 col-md-6 col-sm-12 mb-5">
                            <a href="clanak.php?id=<?= $vijest['id'] ?>">
                                <img src="<?= htmlspecialchars($vijest['slika']) ?>" class="img-fluid" alt="Slika vijesti">
                                <h5><?= htmlspecialchars($vijest['naslov']) ?></h5>
                                <p>ID vijesti: <?= $vijest['id'] ?></p>
                                <p>Datum: <?= date('d.m.Y', strtotime($vijest['datum'])) ?></p>
                            </a>
                            <a href="uredi vijest.php?id=<?= $vijest['id'] ?>" class="btn mt-3 gumb_edit">Uredi</a>
                            <form method="POST" action="administrator.php" class="d-inline">
                                <input type="hidden" name="id" value="<?= $vijest['id'] ?>">
                                <button type="submit" name="delete" class="btn gumb_izbrisi">Izbriši</button>
                            </form>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>Maks Bunoza (0246116072) - mbunoza@tvz.hr - 2025.</p>
    </footer>
</body>
</html>