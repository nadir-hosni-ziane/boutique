<?php
session_start();
include("fonctions.php");
include("panier.class.php");
$panier = new panier();
$user = new boutique();
$panier->dbconnect();
$user->dbconnect();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="boutique.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
        </style>
    </head>
<body>
<header>
    <div class = 'titre'>
        <?php
        if(isset($_SESSION['login'])){
            echo "<a href='profil.php'><img class = 'logouser' src='images-boutique/man-user'></a>";

        }elseif(!isset($_SESSION['login'])){
            echo "<a href='connexion.php'><img class = 'logouser' src='images-boutique/man-user'></a>";
        }
        ?>
        <H1 class = 'titreheader'>Recon</H1>
    </div>
    <nav>
        <a href="recherche.php"><img class = 'logorecherche' src="images-boutique/recherche.png"></a>
        <li><a href = 'admin.php'>Admin</a></li>
        <li><a href = 'index.php'>Accueil</a></li>
        <?php $user->affichercategorie(); ?>
    </nav>
        <a href="panier.php"><img class = 'logopanier' src="images-boutique/panier.png"></a>
</header>