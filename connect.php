<?php
//declaration des const de connexion
define("dbhost","localhost");
define("dbuser","root");
define("dbpass","");
define("dbname","articles");
$dsn=('mysql:host='.dbhost. ";dbname=".dbname);
try{
    //le connexion au base de donnée
    $con=new PDO($dsn,dbuser,dbpass);
    $con->exec('SET NAMES utf8');
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die('Erreur:'.$e->getMessage());
}
