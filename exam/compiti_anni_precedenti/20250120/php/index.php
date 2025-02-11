<?php
$conn = new mysqli("localhost", "root", "", "db_libreria");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!isset($_POST["titolo"], $_POST["autore"])){
    echo "errore";
} else {
    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
}

?>