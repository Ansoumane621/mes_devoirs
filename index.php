<?php
//inclusion de la page de connextion
require_once './connect.php';
//les variable de contrôle des erreurs et d'affichage
$message='';$t="";
$cod=$des=$q=$p="";
$desig=$quantite=$code=$prix="";
$errordesig=$errorquantite=$errorcode=$errorprix="";
$errordes=$errorq=$errorcod=$errorp="";
//on vérifie si notre button d'enregistrement a été soumis d'une action ou pas et ont contrôle les champs
if(isset($_POST['btn']) ){
    $desig=htmlspecialchars(strip_tags($_POST['designation']));
    $quantite=htmlspecialchars(strip_tags($_POST['quantite']));
    $code=htmlspecialchars(strip_tags($_POST['code']));
    $prix=htmlspecialchars(strip_tags($_POST['prix']));
    //le try en cas de doublons de la clé ont evite les erreurs 
    try{
        $req=("SELECT * FROM produit ");
        $requet=$con->prepare($req);
        $requet->execute();
        foreach($requet as $re){
            if($re['code']===$code)
            {$message="ce code est déja dans la base veuillez le changer";}
            else{
                     if(empty($_POST['designation'])){
                             $errordesig="veuilles remplier ce champ";
                    }
                    if(empty($_POST['quantite'])){
                             $errorquantite="veuilles remplier ce champ";
                    }
                    if(empty($_POST['code'])){
                             $errorcode="veuilles remplier ce champ";
                    }
                    if(empty($_POST['prix'])){
                            $errorprix="veuilles remplier ce champ";
                        }
                    else{
           
                            $requet=("INSERT INTO `produit`(code,designation,quatite,prix)
                            VALUES(?,?,?,?)");
                            $requete=$con->prepare($requet);
                            $requete->execute(array($code,$desig,$quantite,$prix));
             
                         } 
            }
        }
    }catch(PDOException $error){
      $t=die("veuilez changer le code  de se produit car il existe déja dans la  base de  donnée: ");
      header('Location: index.php');
    }
    
   
}
//on récupére ici id sur laquelle ont n'as cliquez ou pouvoir supprimer un produit
if(isset($_GET['id1'])){
    $id=$_GET['id1'];
    $req=("SELECT * FROM produit WHERE code=?");
    $requet=$con->prepare($req);
    $requet->execute(array($id));
    foreach($requet as $re){
        $cod=$re['code'];
        $des=$re['designation'];
        $p=$re['prix'];
        $q=$re['quatite'];
    }
   
}
//on vérifier si le button de modification a été soumis sur une action pourvoir valider notre modification
if(isset($_POST['btn_mod']) ){
  
    if(empty($_POST['designation'])){
        $errordes="veuilles remplier ce champ";
    }
    if(empty($_POST['quantite'])){
        $errorq="veuilles remplier ce champ";
    }
   
    if(empty($_POST['prix'])){
        $errorp="veuilles remplier ce champ";
    }
    else{
      
        $desig=htmlspecialchars(strip_tags($_POST['designation']));
        $quantite=htmlspecialchars(strip_tags($_POST['quantite']));
        $code=htmlspecialchars(strip_tags($_POST['code']));
        $prix=htmlspecialchars(strip_tags($_POST['prix']));
        $requet=$con->prepare("UPDATE produit SET designation= ?,quatite= ?,prix= ? WHERE code=?");
        $requet->execute(array($desig,$quantite,$prix,$code));  
        
    } 
}
?>
<!-- notre partie html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog des produits</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        section{
            background-color:slategray;
        }
  #sup{
    text-decoration: none;
    text-align: center;
    font-weight: bold;
    background-color: red;
    color:white;
    padding:5px 20px;
  }
  #mod{
    text-decoration: none;
    text-align: center;
    font-weight: bold;
    background-color: green;
    color:white;
    padding:5px 20px;
  }
    </style>
</head>
<body>
    <header>
        <nav>
            <span>menu</span>
            <ul>
                <li><a href="#">deconnexion</a> </li>

            </ul>
        </nav>
    </header>
    <!--notre section qui renfermer tous le contenue des actions effectuer dans la base de donné-->
    <section>
    <div class="formulaire">
        <h1>bienvenue sur la page d'enregistrement des articles</h1>
        <!--notre formulaire d'enregistrement des articles-->
        <div class="form">
            <form id="f"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" multiple enctype="multipart/form-data">
            <p class="caption">enregistrer un produit</p>
            <div>
                <label for="code">code</label>
                <input type="text" name="code"><br/>
                <span style="color:red"><?php echo $errorcode .' '. $message ?></span>
            </div>
            <div>
                <label for="designation">Designation</label>
                <input type="text" name="designation"><br/>
                <p style="color:red"><?php echo $errordesig ?></p>
            </div>

            <div>
                <label for="quantité">Quantité</label>
                <input type="number" name="quantite" min=0 max=500><br/>
                <span style="color:red"><?php echo $errorquantite ?></span>
            </div>
            <div>
                <label for="prix">Prix</label>
                <input type="float" name="prix"><br/>
                <p style="color:red"><?php echo $errorprix ?></p>
            </div>
            <button type="submit" name="btn">enregistrer</button>
            </form>
            <!--notre formulaire de modification des articles en cliquant sur le button mod sur la liste des artilces-->
              <form class="f2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" multiple enctype="multipart/form-data">
            <p class="caption">modifier un produit</p>
              <div>
                <label for="code">code</label>
                <input type="text" name="code" value="<?php echo $cod ?>" placeholder="la clé ne doit pas être modifier"><br/>
              
            </div>
            <div>
                <label for="designation">Designation</label>
                <input type="text" name="designation" value="<?php echo $des ?>"><br/>
                <span style="color:red"><?php echo $errordes ?></span>
            </div>

            <div>
                <label for="quantité">Quantité</label>
                <input type="number" name="quantite" value="<?php echo $q ?>" min=0 max=500><br/>
                <span style="color:red"><?php echo $errorq ?></span>
            </div>
            <div>
                <label for="prix">Prix</label>
                <input type="float" name="prix" value="<?php echo $p ?>"><br/>
                <span style="color:red"><?php echo $errorp ?></span>
            </div>
            <button type="submit" name="btn_mod">Modifier</button>
            </form>
        </div>
</div>
<!--notre liste des articles et les button de suppression et de modification-->
    <div class="liste">
      
        <h1>liste des articles enregistrer</h1>
        <table border="0.5">
            <tr>
            <th>Code</th>
            <th>Designation</th>
            <th>Quantite</th>
            <th>Prix</th>
            <th>supprimer</th>
             <th>modifier</th>
            </tr>
            <?php 
            $req=$con->query("SELECT * FROM produit");
            foreach($req as $resultat):?>
          <tr>
            <td><?php echo $resultat['code'] ?></td>
            <td><?php echo $resultat['designation'] ?></td>
            <td><?php echo $resultat['quatite'] ?></td>
            <td><?php echo $resultat['prix'] ?></td>
            <td><a id='sup' href="supprimer.php?id=<?php echo $resultat['code'] ;?>">Sup</a></td>
            <td><a id='mod' href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>?id1=<?php echo $resultat['code'] ;?>">mod</a></td>
          </tr>
          <?php endforeach?>
        </table>
</div>
    </section>
    <!--fin de la section-->
    
</body>
</html>