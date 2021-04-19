
<?php include 'header.php';?>
<main>
<section class = 'caserouge'>
        <div class = 'caserougepanier'>
            Trouve ton bonheur
        </div>
        <hr class="line-case">
</section>
    <form class="form-recherche" method="POST" action="">
    <input class="input-recherche" type="search" name="recherche" id="recherche" placeholder="rechercher">
    <input class="label-recherche" type="submit" value="Valider">
    </form>
    <section class = 'caseerreur'>
            <?php
                if(isset($_POST['recherche'])){
                    $user->recherche($_POST['recherche']);

                }
            ?>
    </section>
    <div class = 'marge_footer2'>
    .
    </div>
</main>
<?php include 'footer.php';?>
</body>
</html>
