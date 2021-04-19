
<?php include 'header.php';?>
<?php
require_once('vendor/autoload.php'); 
$prix = $panier->total();

// j'instencie STRIPE

    \Stripe\Stripe::setApiKey('sk_test_51IhMI8BrNY4z7SFmqTURl3rzdvTYp2OYxl7UbllaftdCsUVATqSQvqVK1JLweIpJZkL6i51JjbQqmWtmzw3ClXMJ00FJtPao7C');

    $intent = \Stripe\PaymentIntent::create([
        'amount' => $prix*100,
        'currency' => 'eur'
    ]);
?>
    <main>
        <section class = 'caserouge'>
            <div class = 'caserougeinformation'>
                Paiement
            </div>
            <hr class="line-case">
        </section>
        <div class="position-cadre">
            <div class="cadre-paiement">
                <div class = 'casenoirinformation'>
                    Mes information de paiement
                </div>
                <hr class="line-information">
                <form method="POST" action="">
                    <div class="input-align">
                        <label class="label4" for="card-holdername">Titulaire : </label>
                        <input id="card-holdername" class="input4-1" type='text' name='card-holdername' placeholder="    Titulaire">
                    </div> 
                    <div id="errors"></div> <!-- contiendra les messages d'erreurs de paiements -->
                        <div id="card-elements"></div> <!-- contiendra le formulaire de saisie des info de carte -->
                    <div id="card-errors" role="alert"></div> <!-- contiendra les erreurs relative a la carte -->
                    <!-- <div class="input-align">
                        <label class="label5" for="crédit"> N° carte : </label>
                        <input class="input5" type='tel' name='crédit' inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="  xxxx xxxx xxxx xxxx">
                    </div>
                    <div class="input-align">
                        <label class="label6" for="expire">Expire le: </label>
                        <input class="input6" type='tel' name='expire' inputmode="numeric" maxlength="4" placeholder="  00/00">
                        <label class="label7" for="cvv">CVV : </label>
                        <input class="input7" type='tel' name='cvv' inputmode="numeric" maxlength="3" placeholder="  000">
                    </div> -->
                </form>
            </div>
        </div>
        <button id="card-button" type="button" data-secret="<?= $intent['client_secret']?>" class="butt-valider-info">Valider paiement</button>
    </main>
    <?php include 'footer.php';?>
    </body>
</html>