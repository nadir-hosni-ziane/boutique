<?php 
require 'header.php';
    $user->acces_connect();
    $panier->paiementaccepter();
    unset($_SESSION['panier']);
echo  "<section class = 'add_panier_msg'><section class = 'case_add_panier'>" . 'Paiement réussi . . .   <a href="index.php">Retourner vers le site</a>' . "</section></section>";


?>
</section>
<?php include 'footer.php';?>