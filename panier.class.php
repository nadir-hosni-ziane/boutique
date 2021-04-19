<?php
class panier
{
public $_db;

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
}
?>