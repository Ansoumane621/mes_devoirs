<?php
session_start();
$sms='';$nom=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
$email=$pass='';
if(isset($_POST['btn_envoiyer'])){
    if(empty($_POST['email'])){
        $email='veuillez renseigner le champs email';
    }
    if(empty($_POST['pass'])){
        $pass='veuillez renseigner le champs mot de passe';
    }
    else{

        if($_POST['email']==='ansoumaneconde512@gmail.com' && $_POST['pass']==='621670812'){
        
            $_SESSION['islogin']=true;
            $_SESSION['email']=$nom;
            header('location: ./session.php');
        }
        else {$sms='vos identifiant sont incorrect';}
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
       <style>
         body{
            background-color: seashell;
        }
        div{
                
          margin-bottom:5px;
        }
        section{
            margin:auto;
            width:50%;
            background-color: aliceblue;
            padding:10px;
            border-radius: 10px;
        }
        input,textarea{
            width: 350px;
            height: 35px;
            border-radius: 7px;
            outline:none;
            resize:none;
            border:1px solid grey;
            align-items:center;
            justify-content:center;
           
        }
        form{
            margin:auto;
            justify-content: center;
            align-items: center;
            text-align:center;
        }
        p{
            text-align: center;
            font-size: 2rem;
            text-transform: uppercase;
            color:red;
        }
        button{
            height:2.8rem;
            width:7rem;
            border-radius: 7px;
            resize:none;
            border:1px solid grey;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<body>
    <section class="contenaire">
        <p>se connter</p>
        <p style=color:skyblue><?php echo $sms;?></p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data" class="for">
            <div class="matricule">
                <input type="text" name="email" placeholder="Email"></br>
                <span style="color:red;text-align:center"><?php echo $email; ?></span>
            </div>
            <div class="nom">
                <input type="text" name="pass" placeholder="mot de passe"></br>
                <span style="color:red;text-align:center"><?php echo $pass; ?></span>
            </div>
           
            <div class="btn">
                <button class="" name="btn_envoiyer" type="submit">Se connecter</button>
           
            </div>
        </form>
       
    </section>
</body>
</html>