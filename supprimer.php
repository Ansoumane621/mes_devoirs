<?php
//inclusion de la page de connexion 
require_once 'connect.php';
//ont vérifier si id sur laquelle ont n'as cliquez existe
if(isset($_GET['id'])){
    //on récupére
   $id=$_GET['id'];
   $req=('DELETE FROM produit WHERE code=?');
   $requet=$con->prepare($req);
    $requet->execute(array($id));
    header('Location: index.php');
}
