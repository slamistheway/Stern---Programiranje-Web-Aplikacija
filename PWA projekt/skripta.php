<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naslov = $_POST['naslov'];
    $kratki_sadrzaj = $_POST['kratki_sadrzaj'];
    $sadrzaj = $_POST['sadrzaj'];
    $kategorija = $_POST['kategorija'];

    $slika_putanja = "";
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $ime = $_FILES['slika']['name'];
        $tmp = $_FILES['slika']['tmp_name'];
        $slika_putanja = 'img/' . time() . '_' . basename($ime);
        move_uploaded_file($tmp, $slika_putanja);
    }else{
        echo "Slanje slike nije uspjelo";
    }


    if (isset($_POST['arhiviraj'])) {
        $arhiviraj = 1;
    } else {
        $arhiviraj = 0;
    }
    
    $datum = date('Y-m-d');


    $sql = "INSERT INTO vijesti (naslov, kratki_sadrzaj, sadrzaj, kategorija, slika, arhiviraj, datum)
            VALUES (:naslov, :kratki_sadrzaj, :sadrzaj, :kategorija, :slika, :arhiviraj, :datum)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'naslov' => $naslov,
        'kratki_sadrzaj' => $kratki_sadrzaj,
        'sadrzaj' => $sadrzaj,
        'kategorija' => $kategorija,
        'slika' => $slika_putanja,
        'arhiviraj' => $arhiviraj,
        'datum' => $datum
    ]);

    header("Location: administrator.php");
    exit;
} else {
    echo "Neispravan zahtjev";
}
?>
