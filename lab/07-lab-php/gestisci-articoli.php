<?php
require_once "bootstrap.php";

if(!isUserLoggedIn()){
    header("location: login.php");
}

$templateParams["nome"] = "admin-form.php";
$templateParams["titolo"] = "Blog TW - Gestisci Articoli";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoliCasuali"] = $dbh->getRandomPosts(2);

$templateParams["azione"] = $_GET["action"];

require "template/base.php";
?>