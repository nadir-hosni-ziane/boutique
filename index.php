    <?php include 'header.php';?>
        <main>
            <div class="iphone-red">
                <div class="arrivage">
                    <h1 class="titre-acceuil-1">
                        iPhone 12 Arrivage
                    </h1>
                    <button class="butt-acceuil-1">En profiter</button>
                </div>
            </div>
            <section class='caserouge-index'>
                <div class='titrecaserouge-index'>
                    Nos derniers produits
                </div>
                <hr class="sous-ligne-titre">
                <section class="bloc-phare">
                    <?php $user->dernier_produit(); ?>
                    </div>
                </section>
            </section>
            <h2 class="bienvenue">
                Bienvenue sur Recon
            </h2>
            <section class="section-qualité">
                <div class="qualité">
                    <img class="picto-quali" src="images-boutique/usine.png" alt="logo d'usine">
                    <h3 class="sous-titre">
                        Meilleure offre disponible
                    </h3>
                    <h4 class="sous-sous-titre">
                        Sélectionné par notre <br>algorithme qualité-prix.
                    </h4>
                </div>
                <div class="qualité">
                    <img class="picto-quali" src="images-boutique/custom.png" alt="logo d'usine">
                    <h3 class="sous-titre">
                        Service épatant
                    </h3>
                    <h4 class="sous-sous-titre">
                        Expérience d'achat sécurisée.<br> S.A.V aux petits soins.
                    </h4>
                </div>
            </section>
            <section class="section-qualité">
                <div class="qualité">
                    <img class="picto-quali" src="images-boutique/jumelle.png" alt="logo d'usine">
                    <h3 class="sous-titre">
                        Qualité garantie
                    </h3>
                    <h4 class="sous-sous-titre">
                        Nos marchands partenaires sont<br> contrôlés en continu.
                    </h4>
                </div>
                <div class="qualité">
                    <img class="picto-quali" src="images-boutique/fleur.png" alt="logo d'usine">
                    <h3 class="sous-titre">
                        Impact positif
                    </h3>
                    <h4 class="sous-sous-titre">
                        Une alternative au neuf,<br> joyeuse et élégante.
                    </h4>
                </div>
            </section>
            <h5 class="bienvenue1">
                Catégories
            </h5>
            <div class="catégories">
                <a href="">
                    <div class="catégorie">
                        <p class="cat-tipo">
                            iPhones
                        </p>
                    </div>
                </a>
                <a href="">
                    <div class="catégorie1">
                        <p class="cat-tipo">
                            iPad
                        </p>
                    </div>
                </a>
            </div>
            <div class="catégories1">
                <a href="">
                    <div class="catégorie2">
                        <p class="cat-tipo1">
                            Accessoires
                        </p>
                    </div>
                </a>
            </div>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>