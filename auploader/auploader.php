<?php
//variable de controle 
$message=$error=$echec1=$echec='';
//on déclare un tableau dont les clé sont les le nom des extension désiré et les valeurs sont les type de image
$array_extension=[
    "jpg"=>"image/jpeg",
    "jpeg"=>"image/jpeg",
    "png"=>"image/png"
];
if(isset($_POST['btnfile'])){
if($_FILES['image']){
    //ont récupére les caractéristique de notre image
$filename=$_FILES['image']['name'];
$filesize=$_FILES['image']['size'];
$filetmp_image=$_FILES['image']['tmp_name'];
$filetype=$_FILES['image']['type'];
if(isset($_POST['btnfile']) && !empty($filename)){
    //ont récupére l'extension de notre fichier selection 
$extension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
//ont vérifie si l'extension de notre image existe dans notre tableau d'extension
if(!array_key_exists($extension,$array_extension) || !in_array($filetype,$array_extension))
{
    $echec="extension de ce fichier ou le type n\est pas autorisé";
}
else{
    //cripter le nom du fichier a chaque envoie de ce meme fichier aura un nom different
    $newname=md5(uniqid());
//on génere un le chemin complet du fichier
$newfilename= __DIR__ ."/../upload/$newname.$extension";
if(!move_uploaded_file($_FILES['image']['tmp_name'],$newfilename)){
    $echec1="echec d'envoie du fichier";
}
else{
    $message="Envoie du fichier bien reçu!";
}
}
}
else{
    $error="aucun fichier n'as été choisie";
}
}
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!--inclusion de notre entete de page-->
    <?php require_once '../file/header2.php' ?>
    <form class="f3" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">choisir votre image</label>
            <input type="file" multiple name="image">
        </div>
        <!--affichage des variable de controle s'il ne sont pas vide-->
        <span style="color:red;"><?php echo $message .' '. $error .' '. $echec .' '. $echec1; ?></span><br/>
        <button type="submit" name="btnfile">
        envoyer
        </button>
     
</form>
</body>
</html>
