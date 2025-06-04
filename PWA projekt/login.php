<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM korisnici WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: administrator.php");
        exit;
    } else {
        $errorMsg = "Netočno ime i/ili lozinka";
    }

}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
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
                    <a href="administrator.php" class="active">Administrator</a>
                    <a href="unos.php">Dodaj Vijest</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="container">
        <section class="mt-5">
                <div class="card p-4 login_registracija_form">
                    <h2 class="mb-3 text-center">Log In</h2>

                    <?php 
                        if (!empty($errorMsg)) {
                            echo $errorMsg ;
                        }
                    ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Korisničko ime</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lozinka</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </form>

                    <p class="text-center mt-3">Nemaš račun? <a href="registracija.php">Registriraj se</a></p>
                </div>
        </section>
    </main>

    <!-- Podnožje -->
    <footer>
        <p>Maks Bunoza (0246116072) - mbunoza@tvz.hr - 2025.</p>
    </footer>

</body>
</html>

