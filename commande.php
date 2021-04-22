<section class = 'casenoire'>
    <div class = 'titrecaserouge'>
        Mes commandes 
    </div>
</section>
<section class = 'centrer'>
    <table class = 'tableau2'>
        <thead> 
            <tr>
                <th class ='th2'><p class="detailcommande">N° Commande<p></th>
                <th class ='th2'><p class="detailcommande">Quantité<p></th>
                <th class ='th2'><p class="detailcommande">Prix total<p></th>
                <th class ='th2'><p class="detailcommande">Nom<p></th>
                <th class ='th2'><p class="detailcommande">Prénom<p></th>
                <th class ='th2'><p class="detailcommande">Pays<p></th>
                <th class ='th2'><p class="detailcommande">Ville<p></th>
                <th class ='th2'><p class="detailcommande">C-P<p></th>
                <th class ='th2'><p class="detailcommande">Tèl<p></th>
                <th class ='th2'><p class="detailcommande">Adresse<p></th>
                <th class ='th2'><p class="detailcommande">E-mail<p></th>
                <th class ='th2'><p class="detailcommande">Nom article<p></th>
                <th class ='th2'><p class="detailcommande">Produit<p></th>
                <th class ='th2'><p class="detailcommande">Date<p></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $user->mes_commandes();
            ?>
        </tbody>
    </table>
</section>