<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Articolo";
$templateParams["nome"] = "articolo-id.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["articolo"] = $dbh->getPostById($_GET["id"]);

require("template/base.php");
?>