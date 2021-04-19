
<?php include 'header.php';?>
<section class = 'caserouge'>
    <div class = 'titrecaserouge'>
        Connexion - Inscription
    </div>
    <hr>
</section>
    <section class = 'caseconnexioninscription'>
        <section class = 'caseconnexionbase'>
            <h3 class = 'titreconnexioninscription'>Déjà inscrit ? </h3>
            <br>
                <div class = 'caseconnexion'>
                    <form action = '' method="post">
                        <label class='lbl' for="login">Login : </label>
                        <input class='inpt'  type = 'text' name = 'login' > <br>
                        <label class='lbl' for="password">Mot de passe : </label>
                        <input class='inpt'  type = 'password' name = 'password'> <br>
                </div>
                    <section class = 'caseerreur'>
                        <?php 
                            if (isset($_POST['submitconnexion'])) {
                            $user->connexion($_POST['login'],$_POST['password']);} 
                        ?>
                    </section>
                        <input type = 'submit' name = 'submitconnexion' value = 'Connexion' class = 'buttonconnexion'>
                    </form>
        </section>
            <hr class = 'connexionsepareinscription'>
        <section class = 'caseinscriptionbase'>
            <h3 class = 'titreconnexioninscription'> Pas encore membre ? </h3>
            <div class = 'caseinscription'>
                <form action = '' method = 'post'>
                    <label class='lbl' for = "email">Email : </label> 
                    <input class='inpt' type = 'email' name ='email' ><br>
                    <label class='lbl' for = "indentifiant">Identifiant : </label>
                    <input class='inpt' type = 'text' name ='identifiant' ><br>
                    <label class='lbl' for = "nom">Nom : </label>
                    <input class='inpt' type = 'text' name ='nom'><br>
                    <label class='lbl' for = "prenom">Prenom : </label>
                    <input  class='inpt' type = 'text' name ='prenom' ><br>
                    <label class='lbl' for="password2">Mot de passe : </label>
                    <input class='inpt' type = 'password' name = 'password2'> <br>
                    <label class='lbl' for="confirmpassword">Confirmer mot de passe : </label>
                    <input class='inpt' type = 'password' name = 'confirmpassword'> <br>
            </div>
                <section class = 'caseerreur'>
                    <?php 
                        if (isset($_POST['submitinscription'])) {
                        $user->inscription($_POST['email'],$_POST['identifiant'],$_POST['nom'],$_POST['prenom'],$_POST['password2'], $_POST['confirmpassword']);} 
                        ?>
                </section>
                    <input type = 'submit' name = "submitinscription" value = 'Inscription' class = 'buttonconnexion'>
                </form>
        </section>
    </section>
<?php include 'footer.php';?>
</body>
</html>