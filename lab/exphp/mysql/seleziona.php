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

$sql = "SELECT id, nome, cognome, anno_nascita FROM persone";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - nome: " . $row["nome"]. " " . $row["cognome"]. " - anno: " . $row["anno_nascita"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
