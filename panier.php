<?php include 'header.php';?>
<?php 
if(isset($_GET['del'])){
    $panier->del($_GET['del']);
}
?>
<main>
<section class = 'caserouge'>
<div class = 'caserougepanier'>
    Mon panier
</div>
<hr class="line-case">
</section>
    <?php
        if($panier->total() != 0){
            include 'cadreinfo.php';
        }
    ?>
    <div class="tab-skill">
        <table>
            <tr>
                <th class="th4">
                    <p class="nom-thead">
                        Produit(s)
                    </p>
                </th>
                <th class="th4">
                    <p class="nom-thead">
                        Quantité
                    </p>
                </th>
                <th class="th2">
                    <p class="nom-thead">
                        Description
                    </p>
                </th>
                <th class="th4">
                    <p class="nom-thead">
                        Prix
                    </p>
                </th>
                <th class="th5">
                    <p class="nom-thead">
                        Supprimer
                    </p>
                </th>
            </tr>
            <?php 
            $ids = array_keys($_SESSION['panier']);
            if(empty($ids)){
                $produits = array();
            }else{
                $produits = $panier->requete('SELECT * FROM article WHERE id_article IN ('.implode(',',$ids).')');
            }
            foreach($produits as $produit):
            ?>
            <?php
            if(isset($_POST['validercommande'])){
                if(isset($_SESSION['id'])){
                    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pays']) && !empty($_POST['ville']) && !empty($_POST['cp']) && !empty($_POST['phone']) && !empty($_POST['adresse']) && !empty($_POST['email'])){
                        $prix = $panier->total();
                        $panier->finaliserCommande($_SESSION['id'], $prix, $_POST['nom'], $_POST['prenom'], $_POST['pays'], $_POST['ville'], $_POST['cp'], $_POST['phone'], $_POST['adresse'], $_POST['email']);
                        foreach($_SESSION['panier'] as $key => $value) {
                            for ($i=0; $i < 1; $i++) { 
                                $panier->finaliserCommandedetail($key, $value);
                            }
                        }
                        header("location:paiement.php");
                    }else{
                        echo"<script language=\"javascript\">";
                        echo"alert('remplissez tout les champs')";
                        echo"</script>";
                    }
                }else{
                    header("location:connexion.php");
                }
            }
            ?>
            <tr>
                <td class="td4">
                    <img class = 'img_panier' src="images-boutique/<?= $produit->image_article?>" alt="image du produit">
                </td>
                <td class="td4">
                    <?= $_SESSION['panier'][$produit->id_article]; ?>
                </td>
                <td class="td2">
                    <?= $produit->description_article ?>
                </td>
                <td class="td4">
                    <?= number_format($produit->prix_article,2,',',' ')?> €
                </td>
                <td class="td5">
                    <a href="panier.php?del=<?=$produit->id_article?>"><img src="images-boutique/delete.png" alt="logo poubelle pour supprimer article"></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
    <section class="bas-panier">
        <table class="total-price">
                <tr>
                    <th class="th3">
                        <p class="nom-thead">
                            Coût total :
                        </p>
                    </th>
                    <th class="th3">
                        <p class="nom-thead">
                            <?= number_format($panier->total(),2,',',' ')?> €
                        </p>
                    </th>
                </tr>
        </table>
            <?php
                if($panier->total() != 0){
                    echo '<input type="submit" name="validercommande" class="butt-valider-commande" value="Valider commande">';
                }
            ?>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>