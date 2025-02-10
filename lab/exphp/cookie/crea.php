<?php

$nome_cookie = "username";
$valore_cookie = "giovanni.delnevo2@unibo.it";
setcookie($nome_cookie, $valore_cookie, time() + (60 * 60 * 24 * 30), "/");

if(!isset($_COOKIE[$nome_cookie])) {
    echo "Cookie '" . $nome_cookie . "' non settato!";
} else {
    echo "Cookie '" . $nome_cookie . "' settato!<br>";
    echo "Il suo valore è: " . $_COOKIE[$nome_cookie];
}
?>
