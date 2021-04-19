<?php include 'header.php';?>
<?php 
$id = $_GET['id_article'];
$user->supp_article($id); 
?>
<h1>ARTICLE SUPPRIMER</H1>
<?php include 'footer.php';?>
    </body>
    </html>