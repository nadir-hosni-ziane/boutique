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
<?php include 'footer.php'; ?>
</body>
</html>