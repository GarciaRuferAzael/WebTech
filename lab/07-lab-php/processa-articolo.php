<?php
require_once "bootstrap.php";

if(!isUserLoggedIn()){
    header("location: login.php");
}

if($_POST["action"] == 1){
    //inserimento
    $titoloarticolo = $_POST["titoloarticolo"];
    $testoarticolo = $_POST["testoarticolo"];
    $anteprimaarticolo = $_POST["anteprimaarticolo"];
    $dataarticolo = date("Y-m-d");
    $autore = $_SESSION["idautore"];

    $categorie = $dbh->getCategories();
    $categorie_inserite = array();
    foreach($categorie as $categoria){
        if(isset($_POST["categoria_".$categoria["idcategoria"]])){
            array_push($categorie_inserite, $categoria["idcategoria"]);
        }
    }

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgarticolo"]);
    if ($result != 0) {
        $imgarticolo = $msg;
        $idarticolo = $dbh->insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
        if($idarticolo != false){
            foreach($categorie_inserite as $categoria){
                $ris = $dbh->insertCategoryOfArticle($idarticolo, $categoria);
            }
            $msg = "Inserimento avvenuto correttamente";
        } else {
            $msg = "Errore in inserimento";
        }
    }

    //header("location: login.php?formmsg=".$msg);
    echo $msg;
}

var_dump($_POST);

$msg = "Qlc";
//tornare su login.php
?>