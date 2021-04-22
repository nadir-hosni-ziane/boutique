<?php include 'header.php';?>
<?php $user->acces_connect(); ?>
    <section class = 'caserouge'>
        <div class = 'titrecaserouge'>
            Mon profil - Modification
        </div>
        <hr>
    </section>
        <section class = 'centrer2'>
            <section class = 'caseinfobase'>
                <section class = 'caseerreur'>
                </section>
                <h3 class = 'titreconnexioninscription'>Modifier informations </h3>
                <div class = 'casemodif'>
                    <img class = 'logouser2' src="images-boutique/man-user">
                    <section class = 'formulaire'>
                        <form action ='' method = 'post'>
                            <label class='lbl' for = "nom">Nom : </label>
                            <input class='inpt' type = 'text' name ='nom'><br>
                            <label class='lbl' for = "prenom">Prenom : </label>
                            <input class='inpt' type = 'text' name ='prenom'>
                    </section>
                </div>
                    <section class = 'caseerreur'>
                        <?php 
                        if(isset($_POST['submitmodifprofil'])){
                            $user->modifinfo($_POST['nom'], $_POST['prenom']);
                        }
                        ?>
                    </section>
                            <input type = 'submit' name = 'submitmodifprofil' value = 'Modifier les info' class = 'buttonprofil'>
                        </form>
            </section>
            <hr class = 'connexionsepareinscription'>
            <section class = 'casemodifbase'>
                <h3 class = 'titreconnexioninscription'>Modifier le mot de passe </h3>
                <div class = 'casemodif'>
                    <img class = 'logouser2' src="images-boutique/password">
                    <section class = 'formulaire'>
                        <form action ='' method = 'post'>
                            <label class='lbl' for = "ancienpass">Ancien MDP: </label>
                            <input class='inpt' type = 'password' name ='ancienpass'><br>
                            <label class='lbl' for = "newpass">Nouveau MDP : </label>
                            <input class='inpt' type = 'password' name ='newpass' ><br>
                            <label class='lbl' for = "newpass2">Confirmer : </label>
                            <input class='inpt' type = 'password' name ='newpass2' >
                    </section>
                </div>
                    <section class = 'caseerreur'>
                        <?php
                            if(isset($_POST['submitmodifpassword'])){
                            $user->modifpassword($_POST['ancienpass'], $_POST['newpass'], $_POST['newpass2']);
                            }
                        ?>
                    </section>
                            <input type = 'submit' name = 'submitmodifpassword' value = 'Modifier MDP' class = 'buttonconnexion'><br>
                        </form> 
            </section> 
        </section>       
<?php include 'footer.php';?>
</body>
</html>