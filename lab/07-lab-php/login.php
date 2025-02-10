<?php
require_once 'bootstrap.php';

//controllo se utente sta facendo login
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password";
    } else {
        //login andato a buon fine
        registerLoggedUser($login_result[0]);
    }
}

//controllo se l'utente è gia precedentemente loggato
if(isUserLoggedIn()){
    //utente loggato
    $templateParams["titolo"] = "Blog TW - Admin";
    $templateParams["nome"] = "login-home.php";
    $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);

    if(isset($_GET["formmsg"])){
        $templateParams["formmsg"] = $_GET["formmsg"];
    }
} else {
    //utente non loggato
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";

    
}

$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require 'template/base.php';
?>