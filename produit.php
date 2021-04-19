<?php include 'header.php';?>

<section class = 'caserouge'>
    <div class = 'titrecaserouge'>
            Produits
    </div>
    <hr>
</section>
<section class = 'centrer_produit'>
    <?php $user->afficherarticle($_GET['id']); ?> 
</section>
<div class = 'marge_footer2'>
    .
</div>
<?php include 'footer.php' ?>
</body>
</html>