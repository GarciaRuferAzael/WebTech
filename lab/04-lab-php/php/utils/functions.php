<?php
function isActive($pagename){
    //nome dell'url che stiamo attualmente visitando
    if(basename($_SERVER["PHP_SELF"])==$pagename){
        echo " class='active' ";
    }
}

function getIdFromName($name){
    return preg_replace("/[^a-z]/",'',strtolower($name));
}



?>