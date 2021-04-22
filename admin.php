<?php include 'header.php';?>
<?php
$db = new PDO("mysql:host=localhost; dbname=boutique", 'root', '');
$requete = $db->prepare('SELECT id, nom_categorie FROM categorie WHERE 1');
$requete->execute();
$resultat = $requete->fetchall();
$requete2 = $db->prepare('SELECT * FROM article WHERE 1 ORDER BY nom_article ASC');
$requete2->execute();
$resultat2 = $requete2->fetchall();
?>
<section class='caserouge'>
    <div class='titrecaserouge'>
        Admin
    </div>
    <hr>
</section>
<section class='casenoire'>
    <div class='titrecaserouge'>
        Ajouter un article
    </div>
</section>
    <section class='centrer_element'>
        <section class='casebase'>
            <section class='add_article'>
                <form action='' method='post'>
                    <label class='lbladmin' for='imagearticle'>Images : </label>
                    <input class='inptadmin3' type='file' name='imagearticle' accept="image/png, image/jpeg"><br>
                    <label class='lbladmin' for='nomarticle' class='description'>Nom :</label>
                    <input class='inptadmin' type='text' id='nomarticle' name='nomarticle'><br>
                    <label for='prixarticle' class='lbladmin'>Prix € :</label>
                    <input class='inptadmin2' type='number' id='prixarticle' name='prixarticle'> <br>
                    <label class='lbladmin' for="descriptionarticle" class='description'>Description :</label>
                    <textarea class='inptadmin' id="descriptionarticle" name="descriptionarticle" maxlenght="368" rows="5" cols="33">
                    </textarea><br>
                    <label for='categorie_select' class='lbladmin'>Catégories :</label>
                    <select class='inptadmin' name="categorie">
                        <?php
                        foreach ($resultat as $key) {
                        $id = $key['id'];
                        $nom = $key['nom_categorie'];
                        echo "<option value='$id'>$nom</option>";
                        } ?>
                    </select><br>
            </section>
                    <input type='submit' name='submit_add_article' value='Ajouter article' class='buttonadmin'>
                </form>
            <section class='caseerreur'>
                <?php
                if(isset($_POST['submit_add_article']))
                {
                $user->ajouterarticle($_POST['nomarticle'], $_POST['descriptionarticle'], $_POST['imagearticle'], $_POST['categorie'],$_POST['prixarticle']); 
                }
                ?>
            </section>
        </section>
    </section>
        <section class='casenoire'>
            <div class='titrecaserouge'>
                Ajouter une catégorie
            </div>
        </section>
    <section class='centrer_element'>
        <section class='casebase2'>
            <div class='box1'>
                <h3 class='titreconnexioninscription'> Ajouter catégorie</h3>
                <section class='form_add_categorie'>
                    <form action='' method='POST'>
                        <label class='lbl3' for='addcategorie'>Nom de la catégorie :</label>
                        <input class='inpt3' id='addcategorie' type='text' name='addcategorie'><br>
                </section>
                        <input type='submit' name='submit_add_categorie' value='Ajouter catégorie' class='buttonadmin'>
                    </form>
                <section class='caseerreur'>
                    <?php
                    if(isset($_POST['submit_add_categorie'])) 
                    {
                    $user->newcategorie($_POST['addcategorie']);
                    }
                    ?>
                </section>
            </div>
        </section>
        <div class='box2'>
            <h3 class='titreconnexioninscription'> Supprimer catégorie</h3>
            <section class='form_add_categorie'>
                <form action='' method='post'>
                    <label for='categorie_select' class='lbladmin'>Nom de la catégories :</label>
                    <select class='inptadmin' name="categorie2">
                        <?php
                            foreach ($resultat as $key){
                                $id = $key['id'];
                                $nom = $key['nom_categorie'];
                                echo "<option value='$id'>$nom</option>";
                            }
                        ?>
                    </select><br>
            </section>
                <input type='submit' name='delete_categorie' value='Supprimer la catégories' class='buttonadmin'>
                <input type='submit' name='delete_categorie_article' value='Supprimer la catégories et ses articles' class='buttonadmin3'>
            </form>
        </div>
        <section class='caseerreur'>
            <?php 
            if(isset($_POST['delete_categorie_article'])){       
            $user->delete_categorie_and_article($_POST['categorie2']);
            echo "La catégorie ainsi que ses articles ont bien été supprimer";
            }
                if(isset($_POST['delete_categorie'])){       
                $user->delete_categorie($_POST['categorie2']);
                echo "La catégorie a bien été supprimer";
                }
            ?>
        </section>
    </section>
    <section class='casenoire'>
        <div class='titrecaserouge'>
            Supprimer un article
        </div>
    </section>
        <section class = 'center_table'>
                <table class = 'tableau1'>
                    <thead>
                        <tr>
                            <th class = 'th1'><h3>ID<h3></th>
                            <th class = 'th1'><h3>nom de l'article<h3></th>
                            <th class = 'th1'><h3>Prix<h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $user->afficherbaseproduit()
                        ?>
                    </tbody>
                </table>
            </section>
    <section class='centrer_element'>
        <section class='casebase3'>
            <section class='form_add_categorie'>
                <form action='' method='post'>
                    <label class='lbl3' for='supp_article'>ID de l'article :</label>
                    <select class='inptadmin' name="supp_article">
                        <?php
                            foreach ($resultat2 as $key2) {
                            $id2 = $key2['id_article'];
                            $nom2 = $key2['nom_article'];
                            echo "<option value='$id2'>$id2</option>";
                            }
                        ?>
                    </select><br>
            </section>
                <?php 
                    if(isset($_POST['delete_article'])){
                        $user->delete_article($_POST['supp_article']);
                    }
                ?>
                    <input type='submit' name='delete_article' value='Supprimer' class='buttonadmin'>
                </form>
        </section>
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
                <form action="" method="POST" >
                    <section class = 'form_droit'>
                        <label class='lbl3' for="changementdroit" >Droit</label>
                        <select class ='select2' name="changementdroit" id="changementdroit" >
                            <option value="1" >Membres</option>
                            <option value="2">Modérateur</option>
                            <option value="3">Admin</option>
                        </select><br>
                        <label  class='lbl4' for="changement">Id de l'utilisateur</label><br>
                        <input type ='number' id = 'changement' name = 'changement' class='inpt4' ><br>
                    </section>
                    <div class = 'msg_centrer'>
                        <?php
                            if(isset($_POST['validerlechangement'])){
                            $user->changementdedroit($_POST['changementdroit'], $_POST['changement']);
                            }
                        ?>
                    </div>
                        <input type ='submit' id='validerlechangement' name = 'validerlechangement' value='Changer droit' class = 'buttonadmin3'>
                </form>
        </section>
    </section>
    <section class = 'casenoire'>
        <div class = 'titrecaserouge'>
            Liste des commandes
        </div>
    </section>
        <table class = 'tableau2'>
            <thead>
                <tr>
                    <th class = 'th2'><p class="detailcommande">payer 0/1<p></th>
                    <th class = 'th2'><p class="detailcommande">N° Commande<p></th>
                    <th class = 'th2'><p class="detailcommande">Quantité<p></th>
                    <th class = 'th2'><p class="detailcommande">prix total<p></th>
                    <th class = 'th2'><p class="detailcommande">Nom<p></th>
                    <th class = 'th2'><p class="detailcommande">Prénom<p></th>
                    <th class = 'th2'><p class="detailcommande">Pays<p></th>
                    <th class = 'th2'><p class="detailcommande">Ville<p></th>
                    <th class = 'th2'><p class="detailcommande">C-P<p></th>
                    <th class = 'th2'><p class="detailcommande">tèl<p></th>
                    <th class = 'th2'><p class="detailcommande">adresse<p></th>
                    <th class = 'th2'><p class="detailcommande">e-mail<p></th>
                    <th class = 'th2'><p class="detailcommande">nom article<p></th>
                    <th class = 'th2'><p class="detailcommande">login user<p></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $panier->affichercommandepass();
                ?>
            </tbody>
        </table>
<?php include 'footer.php'?>
</body>
</html>