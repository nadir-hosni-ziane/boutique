
<?php include 'header.php';?>
<main>
    <div class="contact1">
        <div class="arrivage">
            <h1 class="titre-contact">
                Contactez nous
            </h1>
        </div>
    </div>
    <div class="banière-noir">
        <div class='titrecasenoir'>
            On vous écoutes
        </div>
        <hr class="sous-ligne-titre1">
        <div class="wrapper">
            <form method="POST" action="" class="form">
                <input type="text" name="name" id="name" class="name formEntry" placeholder="Nom" />
                <input type="text" name="email" id="email" class="email formEntry" placeholder="E-mail" />
                <textarea name="message" class="message formEntry" placeholder="Message"></textarea>
                <button type="submit" name="submit" id="submit" class="submit formEntry">Envoyer</button>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    if($_POST['name'] != null && $_POST['email'] != null && $_POST['message'] != null){
                    $user->envoieMail($_POST['name'], $_POST['email'], $_POST['message']);
                    }
                }
            ?>
        </div>
    </div>
    <section class='caserouge-contact'>
        <div class='titrecaserouge-contact'>
            Nos coordonnées
        </div>
    </section>
    <section class="coordonnées">
            <div class="coordonnées-gauche">
                E-mail : contact@recon.com<br><br>
                Adresse : 8 rue d'hozier, 13002 Marseille<br><br>
                Lundi à Vendredi – 9:00 à 18:00 h<br>
                Samedi – 10:00 à 13:00 h
            </div>
                <div class="coordonnées-séparation">
                </div>
            <div class="coordonnées-droite">
                Joignez-nous :
                    <p class="numéro">
                        07 82 24 09 82
                    </p>
            </div>
    </section>
</main>
<?php include 'footer.php';?>
</body>
</html>