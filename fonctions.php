<?php

class boutique
{
private $_link;
private $_id;
private $_id_utilisateur;
private $_id_sujet;
public $_login;
public $_password;


/// Fonction pour se connecter a la base de données.

public function dbconnect()
{
    $db = new PDO("mysql:host=localhost; dbname=boutique", 'root', '');
    $this->_db = $db;
}



/// Fonction qui permet de se deconnecter.

public function deconnect()
{
    echo 'Vous allez être déconnecter ! ';
    header("refresh: 2; url=connexion.php");
    session_destroy();
    
}



/// Fonction qui permet de s'inscrire

public function inscription($email, $login, $nom, $prenom, $motdepasse, $confirm)
{
    $db = $this->_db;
    $msg = '';

    $nom = htmlspecialchars($nom);
    $login = htmlspecialchars($login);
    $prenom = htmlspecialchars($prenom);
    $email = htmlspecialchars($email);
    $motdepasse = htmlspecialchars($motdepasse);
    $confirm = htmlspecialchars($confirm);
    $droit = 1;

    $_nom = trim($nom);
    $_login = trim($login);
    $_prenom = trim($prenom);
    $_email = trim($email);
    $_motdepasse = trim($motdepasse);
    $cryptage = password_hash($_motdepasse, PASSWORD_BCRYPT);
    $_confirm = trim($confirm);

    $loginexistant = "SELECT `login` FROM utilisateurs WHERE login = '$_login'";
    $verification = $db->query($loginexistant);
    $emailexistant = "SELECT `email` FROM utilisateurs WHERE email = '$_email'";
    $verification2 = $db->query($emailexistant);




    if(!empty($_prenom) && !empty($_email) && !empty($_login) && !empty($_nom) && !empty($_motdepasse) && !empty($_confirm)){
        if($verification2->fetch(PDO::FETCH_ASSOC) == 0 ){
            if($verification->fetch(PDO::FETCH_ASSOC) == 0 ){
                if($motdepasse == $confirm){
                    $requete = "INSERT INTO `utilisateurs` (`email`, `login`, `nom`, `prenom`, `password`, `id_droit`) VALUES ('$_email', '$_login', '$_nom', '$_prenom', '$cryptage', '$droit')";
                    $db->query($requete);
                    $msg = 'Bienvenue ! ';
                }else{
                    $msg ='Les mots de passe ne correspondent pas';
                }
        
            }else{
                $msg = 'Cette identifiant éxiste déjà';
            }
        }else{
            $msg = 'Cette email est déja utilisé';
        }
    }else{
        $msg = "Remplissez tout les champs ! ";
    }
echo $msg ; 
}





/// Fonction qui permet de se connecter.

public function connexion($login, $password)
{
    
    $db = $this->_db;

    $msg = "";

    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);

    $_login = trim($login);
    $_password = trim($password);

    $requete = $db->prepare("SELECT * FROM utilisateurs WHERE login = '$_login'");
    $requete->execute();

    $verification = $requete->RowCount();

    if(!empty($_login) && !empty($_password)){
            if($verification == 1){
                $info = $requete->fetch();
                if( $_password == password_verify($_password, $info['password'])){
                    $_SESSION['login'] = $info['login'];
                    $_SESSION['password'] = $info['password'];
                    $_SESSION['nom'] = $info['nom'];
                    $_SESSION['prenom'] = $info['prenom'];
                    $_SESSION['email'] = $info['email'];
                    $_SESSION['id'] = $info['id'];
                    $_SESSION['id_droit'] = $info['id_droit'];
                    
                    $msg = "Connexion établie !";
                    header("refresh: 1; url=profil.php");
                }else{
                $msg = "Mauvais mot de passe ! ";
                }
            }else{
            $msg = "Cette identifiant n'existe pas ! ";
            }
    }else{
    $msg = "Remplissez tout les champs !";
    }
    echo $msg;
}


/// Fonction qui permet de modifier ses informations 
        

public function modifinfo($nom, $prenom)
{
    if(!empty($nom) && !empty($prenom)){
        $db = $this->_db;
        $id = $_SESSION['id'];
        $requete = $db->prepare("UPDATE utilisateurs SET nom='$nom' , prenom='$prenom' WHERE id=$id");
        $requete->execute();
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $msg = 'Informations mise a jours ! ';
    }else{
    $msg =  'Veuillez remplir les champs';
    }

echo $msg;

}



/// Fonction qui permet de modifier son mot de passe


public function modifpassword($ancienpass, $newpass, $newpassconfirm)
{

    $db = $this->_db;
    $id = $_SESSION['id'];
    $password = $_SESSION['password'];
    $verif = password_verify($ancienpass, $password);

    if(!empty($ancienpass) && !empty($newpass) && !empty($newpassconfirm)){
        if($ancienpass == $verif){
            if($newpass == $newpassconfirm){
                $pass2 = password_hash($newpass, PASSWORD_BCRYPT);
                $requete = $db->prepare("UPDATE utilisateurs SET password='$pass2' WHERE id=$id");
                $requete->execute();
                $msg =  'Mot de passe changer';
            }else{
            $msg = 'Les mots de passes ne correspondent pas';
            }
        }else{
        $msg =  'Le mot de passe entrée n\'est pas le bon';
        }
    }else{
    $msg = 'Veuillez remplir les champs';
    }
    echo $msg;

}



/// Fonction qui donne acces qu'au utilisateur connecté.



public function acces_connect()
{
    if(!isset($_SESSION['login'])){
    echo "<body><section class = 'add_panier_msg'><section class = 'case_add_panier'>Tu dois être connecté pour acceder a cette page <br> Redirection en cours ...</section></section>";
    include 'footer.php';
    echo '</body>';
    header("refresh: 3; url=connexion.php");
    exit;
    }
}



/// Fonction qui donne acces qu'aux admin




public function acces_admin()
{
    if($_SESSION['id_droit'] !=3){
        echo "<body><section class = 'add_panier_msg'><section class = 'case_add_panier'>Tu dois être admin pour acceder a cette page <br> Redirection en cours ...</section></section>";
    include 'footer.php';
    echo '</body>';
    header("refresh: 3; url=index.php");
    exit;
    }
}



/// Fonction qui permet de modifier les droits 




public function changementdedroit($_id_droit, $_id_utilisateur)
{
    $db = $this->_db;
    $verif = "SELECT id FROM utilisateurs WHERE id = '$_id_utilisateur'";
    $requete = $db->query($verif);

    if(!empty($_id_droit) && (!empty($_id_utilisateur))){
        if ($requete->fetch(PDO::FETCH_ASSOC) == 0) {
            $msg = 'Cette id n\'existe pas';
        }else{
            $query = $db->prepare("UPDATE utilisateurs SET id_droit = '$_id_droit' WHERE id = $_id_utilisateur");
            $query->execute();
            
            if($_id_droit == 3){
                $msg = 'L\'utilisateur est passé admin !';
            }elseif($_id_droit == 2){
                $msg = 'L\'utilisateur est passé modérateur !';
            }else{
            $msg = 'L\'utilisateur est passé membre !';
            }
        }
    }else{ 
    $msg =  'Remplissez les champs !';
    header("refresh: 2");
    }
    echo $msg;
}



/// Fonction qui permet d'afficher la liste des utilisateurs



public function afficherbasededonner()
{  
    $db = $this->_db;
    $requete = $db->prepare('SELECT id, login, id_droit FROM utilisateurs WHERE 1');
    $requete->execute();
    $resultat = $requete->fetchall();
                     
    foreach ($resultat as $key) {
        echo "<tr>";
        echo "<td>".$key['id']."</td>";
        echo "<td>".$key['login']."</td>";
        echo "<td>".$key['id_droit']."</td>";
        echo "</tr>";
    }
}



/// Fonction qui permet d'afficher la liste des produits



public function afficherbaseproduit()
{  
    $db = $this->_db;
    $requete = $db->prepare('SELECT id_article, nom_article, prix_article FROM article WHERE 1');
    $requete->execute();
    $resultat = $requete->fetchall();
                     
    foreach ($resultat as $key) {
        echo "<tr>";
        echo "<td>".$key['id_article']."</td>";
        echo "<td>".$key['nom_article']."</td>";
        echo "<td>".number_format($key['prix_article'],2,',',' ').' €'."</td>";
        echo "</tr>";
    }
}

/// Fonction qui permet de crée une nouvelle catégorie.



public function newcategorie($name_categorie)
{
    $db = $this->_db;

    if(!empty($name_categorie)){
        $requete = "INSERT INTO `categorie` (`nom_categorie`) VALUES ('$name_categorie')";
        $db->query($requete);
        $msg = 'Nouvelle catégorie ajouter';
        header("refresh: 2; url=admin.php");
    }else{
        $msg = 'Veuillez remplir le champ';
    }

    echo $msg;
}



// Fonction qui permet de supprimer une categorie avec ses articles



public function delete_categorie_and_article($id)
{
    $db = $this->_db;
    $requete = "DELETE FROM `categorie` WHERE id='$id'";
    $requete2 = "DELETE FROM article WHERE id_categorie='$id'";
    $db->query($requete);
    $db->query($requete2);
}



// Fonction qui permet de supprimer seulement la categorie



public function delete_categorie($id)
{
    $db = $this->_db;

    $requete2 = "DELETE FROM `categorie` WHERE id='$id'";
    $db->query($requete2);
}

// Fonction qui permet de supprimer un article
public function delete_article($id)
{
    $db = $this->_db;

    $requete2 = "DELETE FROM article WHERE id_article='$id'";
    $db->query($requete2);
}


/// Fonction qui permet d'afficher les catégories 

public function affichercategorie()
{  
    $db = $this->_db;
    $requete = $db->prepare('SELECT id, nom_categorie FROM categorie ORDER BY id ASC');
    $requete->execute();
    $resultat = $requete->fetchall();
     
    foreach ($resultat as $key) {
        $id = $key['id'];
        echo "<li>"."<a href='produit.php?id=$id'>".$key['nom_categorie']. '</a>' . "</li>";
    }
}



/// Fonction qui permet d'ajouter un article 



public function ajouterarticle($nomarticle, $descriptionarticle, $imagearticle, $categorie, $prix)
{
    $db = $this->_db;

    if(!empty($nomarticle) && !empty($descriptionarticle) && !empty($imagearticle) && !empty($categorie) && !empty($prix)){
    $requete = "INSERT INTO `article` (`nom_article`, `description_article`, `image_article`, `id_categorie`, `prix_article`) VALUES ('$nomarticle', '$descriptionarticle', '$imagearticle', '$categorie', '$prix')";
    $db->query($requete);
    $msg = 'Article ajouter';
    }else {
    $msg =  'Veuillez remplir tout les champs ';
    }
        
    echo $msg;
}



/// Fonction qui permet d'afficher un seul article 

public function afficherarticleseul($id)
{
    $db = $this->_db;
    $requete = $db->prepare("SELECT * FROM article WHERE id_article='$id'");
    $requete->execute();
    $resultat = $requete->fetchall();

    foreach ($resultat as $key) {

    $description = $key['description_article'];
    $prix = number_format($key['prix_article'],2,',',' ');
    $nom = $key['nom_article'];
    $image = $key['image_article'];
    $id2= $key['id_article'];
        
    echo "<section class = 'case_produit_back'>
            <div class = 'photo'>
                <img class = 'image' src = 'images-boutique/$image'>
            </div>
            <div class = 'titre2'>
                <h3 class = 'titre_product'>$nom</h3>
                <div class = 'description'>
                    $description
                </div>
                <p class ='didi'>$prix €</p>
                <a href='addpanier.php?id=$id2'>
                <input type='submit' class ='add' value ='Ajouter au panier'>
                </a>
            </div>
            </section>";
    }

}



/// Fonction qui permet d'afficher un article selon sa catégorie.



public function afficherarticle($id)
{
    
$db = $this->_db;
$requete = $db->prepare("SELECT * FROM article INNER JOIN categorie ON  categorie.id = article.id_categorie WHERE id_categorie='$id'");
$requete->execute();
$resultat = $requete->fetchall();


    foreach ($resultat as $key) {

    $nomcategorie = $key['nom_categorie'];
    $description = $key['description_article'];
    $prix = number_format($key['prix_article'],2,',',' ');
    $nom = $key['nom_article'];
    $image = $key['image_article'];
    $id2= $key['id_article'];
    

    echo "<section class = 'case_base_produit'>
            <section class = 'case_produit'>
                <section class = 'display_arrow'>
                    <div class = 'boximg'>
                        <img class = 'size_picture2' src = 'images-boutique/$image'>
                        </div>
                    <div class = 'description_article'>
                        <h2>$nom</h2><br>
                        $description
                    </div>
                    <section class = 'case_prix'>
                        Prix (€) : $prix 
                    </section>
                </section>
            </section>
            <section class = 'case_produit3'>
                <div class = 'deletation'>";
                    echo "<a href='produitselect.php?idproduct=$id2'>";
                    echo "<input type='image' src='images-boutique/eye' />";
                    echo "</a>
                </div>
            </section>
            <section class = 'case_produit2'>
            <div class = 'deletation'>
                <a href='addpanier.php?id=$id2'>
                <input type='image' src='images-boutique/basket-plus' />
                </a>
            </div>
            </section>
        </section>
        </section>";
    }
}



// Fonction qui permet de supprimer un article.



public function supp_article($id)
{
    $db = $this->_db;
    $requete10 =$db->prepare("DELETE FROM article WHERE id_article='$id'");
    $requete10->execute();
}



/// Fonction qui permet d'envoyer un mail.



public function envoieMail($_name, $_email, $_message)
{
    $monMail= 'ziane.nadir13@gmail.com';
    $message= $_message;
    $customMail= $_email;
    $name= $_name;

    mail($monMail, $customMail, $message) or die ("failure");
}



/// Fonction qui permet de faire une recherche



public function recherche($_recherche){
    

$db = $this->_db;


    if(!empty($_recherche)){
        $recherche = htmlspecialchars($_recherche);
        $requete = $db->prepare("SELECT * FROM article WHERE nom_article LIKE '%$recherche%' ORDER BY id_article DESC");
        $requete->execute();
        $resultat = $requete->fetchall();
    
        foreach ($resultat as $key) {
            $description = $key['description_article'];
            $prix = $key['prix_article'];
            $nom = $key['nom_article'];
            $image = $key['image_article'];
            $id2= $key['id_article'];   
            
            echo "<section class = 'case_base_produit'>
            <section class = 'case_produit'>
                <section class = 'display_arrow'>
                    <div class = 'boximg'>
                        <img class = 'size_picture2' src = 'images-boutique/$image'>
                    </div>
                    <div class = 'description_article'>
                        <h2>$nom</h2><br>
                        $description
                    </div>
                    <section class = 'case_prix'>
                        Prix (€) : $prix 
                    </section>
                </section>
            </section>
            <section class = 'case_produit3'>
                <div class = 'deletation'>";
                    echo "<a href='produitselect.php?idproduct=$id2'>";
                    echo "<input type='image' src='images-boutique/eye' />";
                    echo "</a>
                </div>
            </section>
        </section>
        </section> ";
        }
    }else{
        echo "Veuillez remplir le champ svp";
    }

}

public function retour_page_admin()
{
    header("refresh: 4; url=adminproduit.php");
}



public function dernier_produit()
{

$db = $this->_db;
$requete =$db->prepare("SELECT * FROM article  ORDER BY id_article DESC LIMIT 3");
$requete->execute();
$resultat = $requete->fetchall();

    foreach ($resultat as $key) {
        $nom = $key['nom_article'];
        $image = $key['image_article'];
        $id = $key['id_article'];

        echo "<div class='produit-phare'>
        <div class = 'voir_plus'>$nom</div>
        <a href='produitselect.php?idproduct=$id'>
        <img class = 'produit-phare2' src = 'images-boutique/$image' alt='produits mit en avant'>
        </a>
        </div>";
    } 
}


// //////////////////////////////////////////: FONCTION POUR AFFICHER LES PRODUITS COMMANDE PAR L'UTILISATEUR CONNECTE


public function mes_commandes(){
    $db = $this->_db;
    $id = $_SESSION['id'];
    $requete = $db->prepare("SELECT * FROM detailcommande INNER JOIN commande on detailcommande.id_commande = commande.id INNER JOIN article on detailcommande.id_produit = article.id_article INNER JOIN utilisateurs on commande.id_utilisateur = utilisateurs.id WHERE id_utilisateur = '$id'");
    $requete->execute();
    $resultat = $requete->fetchall();

    
    foreach ($resultat as $key) {
        $id_article = $key['id_article'];

        echo "<tr>";
            echo "<td class='tdpetit'>".$key['id_commande']."</td>";
            echo "<td class='tdpetit'>".$key['quantite']."</td>";
            echo "<td class='tdgrand'>".$key['prix_total']. '.OO €' ."</td>";
            echo "<td class='tdpetit'>".$key['nom_commande']."</td>";
            echo "<td class='tdpetit'>".$key['prenom_commande']."</td>";
            echo "<td class='tdpetit'>".$key['pays']."</td>";
            echo "<td class='tdpetit'>".$key['ville']."</td>";
            echo "<td class='tdpetit'>".$key['cp']."</td>";
            echo "<td class='tdpetit'>".$key['telephone']."</td>";
            echo "<td class='tdgrand2'>".$key['adresse']."</td>";
            echo "<td class='tdgrand'>".$key['email_commande']."</td>";
            echo "<td class='tdgrand2'>".$key['nom_article']."</td>";
            echo "<td class='tdmoyen'>" . "<a href='produitselect.php?idproduct=$id_article'>" . "<img class = 'img_panier2' src = 'images-boutique/" .$key['image_article']. "'>" . "</a>" . "</td>";
            echo "<td class='tdgrand2'>".$key['date_commande']."</td>";
            echo "</tr>";

    }
}

}