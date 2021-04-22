<?php
class panier
{
public $_db;
public $_lastinsertid;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
    }

    public function dbconnect(){
    $db = new PDO("mysql:host=localhost; dbname=boutique", 'root', '');
    $this->_db = $db;
    }

    public function total(){
        $total=0;
        $ids = array_keys($_SESSION['panier']);
            if(empty($ids)){
                $produits = array();
            }else{
                $produits = $this->requete('SELECT id_article, prix_article FROM article WHERE id_article IN ('.implode(',',$ids).')');
            }
        foreach ($produits as $produit){
            $total += $produit->prix_article * $_SESSION['panier'][$produit->id_article];
        }
        return $total;
    }

    public function requete($_requete, $_data = array()){
        $db = $this->_db;
        $requete = $db->prepare("$_requete");
        $requete->execute($_data);
        return $requete->fetchall(PDO::FETCH_OBJ);
    }

    public function add($_produit_id){
        if(isset($_SESSION['panier'][$_produit_id])){
            $_SESSION['panier'][$_produit_id]++;
        }else{
        $_SESSION['panier'][$_produit_id] = 1;
        }
    }

    public function del($_produit_id){
        unset($_SESSION['panier'][$_produit_id]);
    }

    public function finaliserCommande($_id_user, $_prix_total, $_nom, $_prenom, $_pays, $_ville, $_cp, $_tel, $_adresse, $_email){
        $db = $this->_db;
        $requete = "INSERT INTO commande (`id_utilisateur`, `prix_total`, `Nom`, `prenom`, `pays`, `ville`, `cp`, `telephone`, `adresse`, `email`) VALUES ('$_id_user', '$_prix_total', '$_nom', '$_prenom', '$_pays', '$_ville', '$_cp', '$_tel', '$_adresse', '$_email')";
        $db->query($requete);
        $this->_lastinsertid = $db->lastInsertId();
    }

    public function afficheridlast(){
        echo $this->_lastinsertid;
    }
    
    public function finaliserCommandedetail($_id_produit, $_quantite){
        $db = $this->_db;
        $id_commande = $this->_lastinsertid; 
        $requete2 = "INSERT INTO `detailcommande`(`id_commande`, `id_produit`, `quantite`, `id_payer`) VALUES ('$id_commande', '$_id_produit', '$_quantite', '0')";
        $db->query($requete2);
    }

    public function paiementaccepter(){
        $db = $this->_db;
        $query = $db->prepare("SELECT MAX(id) FROM commande");
        $query->execute();
        $resultat = $query->fetchAll();
        foreach ($resultat as $key){
            $requete = "UPDATE `detailcommande` SET `id_payer`= 1 WHERE id_commande = $key[0]";
            $db->query($requete);
        }
    }

    public function affichercommandepass(){
        $db = $this->_db;
        $requete = $db->prepare("SELECT * FROM detailcommande INNER JOIN commande on detailcommande.id_commande = commande.id INNER JOIN article on detailcommande.id_produit = article.id_article INNER JOIN utilisateurs on commande.id_utilisateur = utilisateurs.id");
        $requete->execute();
        $resultat = $requete->fetchall();
        
        foreach ($resultat as $key) {
            echo "<tr>";
            echo "<td class='tdpetit'>".$key['id_payer']."</td>";
            echo "<td class='tdpetit'>".$key['id_commande']."</td>";
            echo "<td class='tdpetit'>".$key['quantite']."</td>";
            echo "<td class='tdmoyen'>".$key['prix_total']. '.OO €' ."</td>";
            echo "<td class='tdpetit'>".$key['Nom']."</td>";
            echo "<td class='tdpetit'>".$key['prenom']."</td>";
            echo "<td class='tdpetit'>".$key['pays']."</td>";
            echo "<td class='tdpetit'>".$key['ville']."</td>";
            echo "<td class='tdpetit'>".$key['cp']."</td>";
            echo "<td class='tdpetit'>".$key['telephone']."</td>";
            echo "<td class='tdgrand'>".$key['adresse']."</td>";
            echo "<td class='tdgrand'>".$key['email']."</td>";
            echo "<td class='tdgrand'>".$key['nom_article']."</td>";
            echo "<td class='tdpetit'>".$key['login']."</td>";
            echo "</tr>";
        }
    }

    // public function affichercommandepassuser($_id_user){
    //     $db = $this->_db;
    //     $requete = $db->prepare("SELECT * FROM detailcommande INNER JOIN commande on detailcommande.id_commande = commande.id INNER JOIN article on detailcommande.id_produit = article.id_article INNER JOIN utilisateurs on commande.id_utilisateur = utilisateurs.id WHERE utilisateurs.id = 35");
    //     $requete->execute();
    //     $resultat = $requete->fetchall();
        
    //     foreach ($resultat as $key) {
    //         echo "<tr>";
    //         echo "<td class='tdpetit'>".$key['id_payer']."</td>";
    //         echo "<td class='tdpetit'>".$key['id_commande']."</td>";
    //         echo "<td class='tdpetit'>".$key['quantite']."</td>";
    //         echo "<td class='tdmoyen'>".$key['prix_total']. '.OO €' ."</td>";
    //         echo "<td class='tdpetit'>".$key['Nom']."</td>";
    //         echo "<td class='tdpetit'>".$key['prenom']."</td>";
    //         echo "<td class='tdpetit'>".$key['pays']."</td>";
    //         echo "<td class='tdpetit'>".$key['ville']."</td>";
    //         echo "<td class='tdpetit'>".$key['cp']."</td>";
    //         echo "<td class='tdpetit'>".$key['telephone']."</td>";
    //         echo "<td class='tdgrand'>".$key['adresse']."</td>";
    //         echo "<td class='tdgrand'>".$key['email']."</td>";
    //         echo "<td class='tdgrand'>".$key['nom_article']."</td>";
    //         echo "<td class='tdpetit'>".$key['login']."</td>";
    //         echo "</tr>";
    //     }
    // }

}
?>