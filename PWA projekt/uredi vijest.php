<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM vijesti WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $vijest = $stmt->fetch();

    if (!$vijest) {
        echo "Vijest nije pronađena.";
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $naslov = $_POST['naslov'];
    $autor = $_POST['autor'];
    $kratki_sadrzaj = $_POST['kratki_sadrzaj'];
    $sadrzaj = $_POST['sadrzaj'];
    $kategorija = $_POST['kategorija'];

    $slika_putanja = '';
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $ime = $_FILES['slika']['name'];
        $tmp = $_FILES['slika']['tmp_name'];
        $slika_putanja = 'img/' . time() . '_' . basename($ime);
        move_uploaded_file($tmp, $slika_putanja);
    }


    if (isset($_POST['arhiviraj'])) {
        $arhiviraj = 1;
    } else {
        $arhiviraj = 0;
    }


    if ($slika_putanja !== '') {
        $sql = "UPDATE vijesti SET naslov = :naslov, kratki_sadrzaj = :kratki_sadrzaj, sadrzaj = :sadrzaj, kategorija = :kategorija, slika = :slika, arhiviraj = :arhiviraj WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'naslov' => $naslov,
            'kratki_sadrzaj' => $kratki_sadrzaj,
            'sadrzaj' => $sadrzaj,
            'kategorija' => $kategorija,
            'slika' => $slika_putanja,
            'arhiviraj' => $arhiviraj,
            'id' => $id
        ]);
    } else {
        $sql = "UPDATE vijesti SET naslov = :naslov, kratki_sadrzaj = :kratki_sadrzaj, sadrzaj = :sadrzaj, kategorija = :kategorija, arhiviraj = :arhiviraj WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'naslov' => $naslov,
            'kratki_sadrzaj' => $kratki_sadrzaj,
            'sadrzaj' => $sadrzaj,
            'kategorija' => $kategorija,
            'arhiviraj' => $arhiviraj,
            'id' => $id
        ]);
    }



    header("Location: administrator.php");
    exit;
}

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
                        <a href="index.php" class="active">Home</a>
                        <a href="politik.php">Politik</a>
                        <a href="gesundheit.php">Gesundheit</a>
                        <a href="spas.php" >Spaß</a>
                        <a href="administrator.php">Administrator</a>
                        <a href="unos.php">Dodaj Vijest</a>
                    </nav>
                </div>
            </div>
    </header>


     <!-- Main -->
     <main class="container my-4">
        <article>
            <h2 class="fw-bold">Dodavanje vijesti</h2>

            <form id="newsForm" name="form" action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $vijest['id'] ?>">

                <label for="naslov">Naslov:</label>
                <input type="text" id="naslov" name="naslov" class="form-control" value="<?= $vijest['naslov'] ?>" required>
                <p id="porukaNaslov" class="error_label"></p>

                <label for="kratki_sadrzaj">Kratki sadržaj:</label>
                <textarea id="kratki_sadrzaj" name="kratki_sadrzaj" rows="4" class="form-control" required><?= $vijest['kratki_sadrzaj'] ?></textarea>
                <p id="porukaKratkiSadrzaj" class="error_label"></p>
    
                <label for="sadrzaj">Sadržaj:</label>
                <textarea id="sadrzaj" name="sadrzaj" rows="20" class="form-control" required><?= $vijest['sadrzaj'] ?></textarea>
                <p id="porukaSadrzaj" class="error_label"></p>
    
                <label for="kategorija">Kategorija:</label>
                <select id="kategorija" name="kategorija" class="form-control" required>
                    <option value="politika" <?= $vijest['kategorija'] == 'politika' ? 'selected' : '' ?>>Politik</option>
                    <option value="zdravlje" <?= $vijest['kategorija'] == 'zdravlje' ? 'selected' : '' ?>>Zdravlje</option>
                    <option value="administracija" <?= $vijest['kategorija'] == 'administracija' ? 'selected' : '' ?>>Administracija</option>
                    <option value="zabava" <?= $vijest['kategorija'] == 'zabava' ? 'selected' : '' ?>>Zabava</option>
                </select>
                <p id="porukaKategorija" class="error_label"></p>
    

                <label for="slika">Odaberite novu sliku:</label>
                <input type="file" id="slika" name="slika">
                    <br><img src="<?= $vijest['slika'] ?>" alt="img"  width="50%">
                <p id="porukaSlika" class="error_label"></p>
    

                <div class="arhiviraj_row">
                    <label for="arhiviraj">Arhiviraj vijest/nemoj prikazati na naslovnici </label>
                    <input type="checkbox" id="arhiviraj" name="arhiviraj" value="1" <?= $vijest['arhiviraj'] ? 'checked' : '' ?>>
                </div>

                <button type="submit">Spremi</button>
            </form>
        </article>
    </main>




    <!-- Podnožje -->
    <footer>
        <p>Maks Bunoza (0246116072) - mbunoza@tvz.hr - 2025.</p>
    </footer>


</body>



<script>
document.getElementById("newsForm").onsubmit = function(event) {
    var slanjeForme = true;

    var poljeTitle = document.getElementById("naslov");
    var title = poljeTitle.value;
    if (title.length < 5 || title.length > 80) {
        slanjeForme = false;
        poljeTitle.style.border = "4px dotted red";
        document.getElementById("porukaNaslov").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova! <br>";
    } else {
        document.getElementById("porukaNaslov").innerHTML = "";
    }

    var poljeAbout = document.getElementById("kratki_sadrzaj");
    var about = poljeAbout.value;
    if (about.length < 10 || about.length > 200) {
        slanjeForme = false;
        poljeAbout.style.border = "4px dotted red";
        document.getElementById("porukaKratkiSadrzaj").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova! <br>";
    } else {
        document.getElementById("porukaKratkiSadrzaj").innerHTML = "";
    }


    var poljeContent = document.getElementById("sadrzaj");
    var content = poljeContent.value;
    if (content.length == 0) {
        slanjeForme = false;
        poljeContent.style.border = "4px dotted red";
        document.getElementById("porukaSadrzaj").innerHTML = "Sadržaj mora biti unesen! <br>";
    } else {
        document.getElementById("porukaSadrzaj").innerHTML = "";
    }


    var poljeCategory = document.getElementById("kategorija");
    if (poljeCategory.value == "#") {
        slanjeForme = false;
        poljeCategory.style.border = "4px dotted red";
        document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana! <br>";
    } else {
        document.getElementById("porukaKategorija").innerHTML = "";
    }

    if (slanjeForme == false) {
        event.preventDefault();
    }
}
</script>


</html>
