window.onload = () => {

    // Variables
    let stripe = Stripe('pk_test_51IhMI8BrNY4z7SFm6R2ws3sOxNRpTTvJh8XM5hCESojjS1Xmn3Way2tzE4hc26x1UkN5lEv3TWrjyuPG9GgzXYX700tggRzdNO', {
        locale: 'fr'
    })
    let elements = stripe.elements()
    let redirect = "/boutique/index.php"


    // Objet de la page 
    let cardHoldername = document.getElementById("card-holdername")
    let cardButton = document.getElementById("card-button")
    let clientSecret = cardButton.dataset.secret;

    // Crée les éléments du formulaire de carte bancaire
    let card = elements.create("card")
    card.mount("#card-elements")

    // On gère la saisie
    card.addEventListener("change", (event) => {
        let displayError = document.getElementById("card-errors")
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    })

    // On gère le paiement 
    cardButton.addEventListener("click", () => {
        stripe.handleCardPayment(
            clientSecret, card, {
                payment_method_data: {
                    billing_details: { name: cardHoldername.value }
                }
            }
        ).then((result) => {
            if (result.error) {
                document.getElementById("errors").innerText = result.error.message
            } else {
                document.location.href = redirect
            }
        })
    })

}