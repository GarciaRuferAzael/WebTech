<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezione";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM persone WHERE cognome='Doe2'";

if ($conn->query($sql) === TRUE) {
    echo "Righe cancellate correttamente";
} else {
    echo "Errore nella cancellazione: " . $conn->error;
}


$conn->close();
