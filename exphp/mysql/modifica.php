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

$sql = "UPDATE persone SET cognome='Doe2' WHERE cognome='Doe'";

if ($conn->query($sql) === TRUE) {
    echo "Righe modificate correttamente";
} else {
    echo "Errore nell'aggiornamento: " . $conn->error;
}

$conn->close();
