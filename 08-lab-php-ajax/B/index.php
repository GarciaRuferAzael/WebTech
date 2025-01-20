<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Blog TW - Home";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

if(!isset($_GET["page"])){
    $_GET["page"] = "home";
}
switch($_GET["page"]){
    case "home":
        //Home Template
        $templateParams["nome"] = "lista-articoli.php";
        $templateParams["articoli"] = $dbh->getPosts(2);
        break;
    case "archivio":
        $templateParams["nome"] = "lista-articoli.php";
        $templateParams["articoli"] = $dbh->getPosts();
        break;
    case "contatti":
        $templateParams["nome"] = "contatti.php";
        $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "login":
        if(isset($_POST["username"]) && isset($_POST["password"])){
            $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
            if(count($login_result)==0){
                //Login fallito
                $templateParams["errorelogin"] = "Errore! Controllare username o password!";
            }
            else{
                registerLoggedUser($login_result[0]);
            }
        }
        
        if(isUserLoggedIn()){
            $templateParams["titolo"] = "Blog TW - Admin";
            $templateParams["nome"] = "login-home.php";
            $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
            if(isset($_GET["formmsg"])){
                $templateParams["formmsg"] = $_GET["formmsg"];
            }
        }
        else{
            $templateParams["titolo"] = "Blog TW - Login";
            $templateParams["nome"] = "login-form.php";
        }
        break;
    default:
        $templateParams["nome"] = "lista-articoli.php";
        $templateParams["articoli"] = $dbh->getPosts(2);
}

require 'template/base.php';
?>