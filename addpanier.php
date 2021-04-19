<?php 
require 'header.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $produit = $panier->requete('SELECT * FROM article WHERE id_article = :id', array('id' => $_GET['id']));
    // var_dump($produit);
    if(empty($produit)){
        die("<section class = 'add_panier_msg'><section class = 'case_add_panier'>Ce produit n'existe pas</section></section>");
    }
    $panier->add($produit[0]->id_article);
    die("<section class = 'add_panier_msg'><section class = 'case_add_panier'>" . 'Produit Ajouté . . .   <a href="javascript:history.back()">Retourner au catalogue</a>' . "</section></section>");
}else{
    die("<section class = 'add_panier_msg'><section class = 'case_add_panier'>Il n'y a pas de produit sélectionné sur le panier</section></section>");
}
?>
</section>
<?php include 'footer.php';?>