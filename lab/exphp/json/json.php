<?php
//header('Content-Type: application/json');

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

$sql = "SELECT id, nome, cognome, anno_nascita FROM persone WHERE id=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "0 results";
}
$conn->close();
