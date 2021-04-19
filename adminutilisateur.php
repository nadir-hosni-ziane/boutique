
<?php include 'header.php';?>
<section class = 'caserouge'>
    <div class = 'titrecaserouge'>
        Admin
    </div>
    <hr>
</section>
    <section class = 'casenoire'>
        <div class = 'titrecaserouge'>
            Liste des utilisateurs
        </div>
    </section>
        <section class = 'center_table'>
            <table class = 'tableau1'>
                <thead> 
                    <tr>
                        <th class = 'th1'><h3>ID<h3></th>
                        <th class = 'th1'><h3>Login<h3></th>
                        <th class = 'th1'><h3>Accès<h3></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $user->afficherbasededonner()
                    ?>
                </tbody>
            </table>
        </section>
    <section class = 'centrer_element'>
        <section class = 'casebase'>
            <h3 class = 'titreconnexioninscription'> Gerer les droits </h3>
                <section class = 'form_droit'>
                    <form action="" method="POST" >
                        <label class='lbl3' for="changementdroit" >Droit</label>
                        <select class ='select2' name="changementdroit" id="changementdroit" >
                            <option value="1" >Membres</option>
                            <option value="2">Modérateur</option>
                            <option value="3">Admin</option>
                        </select><br>
                        <label  class='lbl4' for="changement">Id de l'utilisateur</label><br>
                        <input type ='number' id = 'changement' name = 'changement' class='inpt4' ><br>
                    </form>
                </section>
                    <div class = 'msg_centrer'>
                        <?php             
                            if(isset($_POST['validerlechangement'])){
                            $user->changementdedroit($_POST['changementdroit'], $_POST['changement']);
                            }
                        ?>
                    </div>
                <form action='' method='post'>
                    <input type ='submit' id='validerlechangement' name = 'validerlechangement' value='Changer droit' class = 'buttonadmin3'>
                </form>
        </section>    
    </section>
<?php include 'footer.php'; ?>
</body>
</html>