

<?php include 'header.php';?>
<section class = 'caserouge'>
    <div class = 'titrecaserouge'>
        Mon profil
    </div>
    <hr>
</section>
    <section class = 'centrer'>
        <section class = 'caseprofil'>
            <section class = 'caseerreur'>
                <?php $user->accesconnect(); ?>
            </section>
            <div class = 'caseprofil2'>
                <img class = 'logouser2' src="images-boutique/man-user"><br>
                <section class = "info">
                    <div class = "gauche">
                        <p class = 'indication'>
                        Identifiant :<br>
                        <br>
                        E-mail :<br>
                        <br>
                        Nom :<br>
                        <br>
                        Prenom : 
                        </p>
                    </div>
                    <div class = "droite">
                        <?php echo $_SESSION['login'];?><br>
                        <br>
                        <?php echo $_SESSION['email'];?><br>
                        <br>
                        <?php echo $_SESSION['nom'];?><br>
                        <br>
                        <?php echo $_SESSION['prenom'];?>
                    </div>
                </section>
            </div>
            <section class = 'caseerreur'>
                <?php
                    if(isset($_POST['submitdeconnexion'])){
                    $user->deconnect();
                    }
                ?>
            </section>
                <a href = 'modifprofil.php'><button class ='buttonprofil'>Modifier mon profil</button></a>
            <form action ='' method='post'>
                <input type = 'submit' name = 'submitdeconnexion' value = 'Deconnexion' class = 'buttonprofil2'>
            </form>
        </section>
    </section>
    <?php include 'footer.php';?>
</body>
</html>