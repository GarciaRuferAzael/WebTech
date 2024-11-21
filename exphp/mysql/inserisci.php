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

$sql = "INSERT INTO persone (nome, cognome, anno_nascita) VALUES ('John', 'Doe', '0')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "Persona aggiunta correttamente con id: " . $last_id;
} else {
    echo "Errore: " . $sql . "<br>" . $conn->error;
}

$conn->close();
