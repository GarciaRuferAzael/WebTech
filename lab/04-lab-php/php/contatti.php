<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Blog TW - Contatti";
$templateParams["nome"] = "contatti-table.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["contatti"] = $dbh->getContacts();

require("template/base.php");
?>