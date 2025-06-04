<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unos Vijesti</title>
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
                    <a href="gesundheit.php">Gesundheit</a>
                    <a href="spas.php" >Spaß</a>
                    <a href="administrator.php">Administrator</a>
                    <a href="unos.php" class="active">Dodaj Vijest</a>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Main -->
    <main class="container my-4">
        <article>
            <h2 class="fw-bold">Dodavanje vijesti</h2>

            <form id="newsForm" name="form" action="skripta.php" method="POST" enctype="multipart/form-data">
                <label for="naslov">Naslov:</label>
                <input type="text" id="naslov" name="naslov">
                <p id="porukaNaslov" class="error_label"></p>

                <label for="kratki_sadrzaj">Kratki sadržaj:</label>
                <textarea id="kratki_sadrzaj" name="kratki_sadrzaj" rows="4"></textarea>
                <p id="porukaKratkiSadrzaj" class="error_label"></p>
    
                <label for="sadrzaj">Sadržaj:</label>
                <textarea id="sadrzaj" name="sadrzaj" rows="20"></textarea>
                <p id="porukaSadrzaj" class="error_label"></p>
    
                <label for="kategorija">Kategorija:</label>
                <select id="kategorija" name="kategorija">
                    <option value="#">Odabir kategorije</option>
                    <option value="politika">Politik</option>
                    <option value="zdravlje">Zdravlje</option>
                    <option value="administracija">Administracija</option>
                    <option value="zabava">Zabava</option>
                </select>
                <p id="proukaKategorija" class="error_label"></p>
    
                <label for="slika">Odaberite sliku:</label>
                <input type="file" id="slika" name="slika" accept="image/*">
                <p id="porukaSlika" class="error_label"></p>
    
                <div class="arhiviraj_row">
                    <label for="arhiviraj">Arhiviraj vijest/nemoj prikazati na naslovnici </label>
                    <input type="checkbox" id="arhiviraj" name="arhiviraj" value="1">
                </div>

                <button type="submit">Prihvati</button>
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

    var poljeSlika = document.getElementById("slika");
    var pphoto = poljeSlika.value;
    if (pphoto.length == 0) {
        slanjeForme = false;
        poljeSlika.style.border = "4px dotted red";
        document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena! <br>";
    } else {
        document.getElementById("porukaSlika").innerHTML = "";
    }

    var poljeCategory = document.getElementById("kategorija");
    if (poljeCategory.value == "#") {
        slanjeForme = false;
        poljeCategory.style.border = "4px dotted red";
        document.getElementById("proukaKategorija").innerHTML = "Kategorija mora biti odabrana! <br>";
    } else {
        document.getElementById("proukaKategorija").innerHTML = "";
    }

    if (slanjeForme == false) {
        event.preventDefault();
    }
}
</script>

</html>
