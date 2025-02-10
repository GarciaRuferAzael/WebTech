<?php

$hostname = "localhost:3306";
$username = "root";
$password = "password";
$database = "giugno";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($_GET["A"]) || empty($_GET["B"])) {
    die("Missing paramaters A, B!");
}

$A = (int) $_GET["A"];
$B = (int) $_GET["B"];

if ($A <= 0 || $B <= 0) {
    die("A, B are not valid");
}

$sql = "SELECT DISTINCT insieme FROM insiemi";
$result = $conn->query($sql);

$insiemi = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $insiemi[] = (int) $row['insieme'];
    }
}

if (!in_array($A, $insiemi) || !in_array($B, $insiemi)) {
    die("Insiemi non validi");
}

if (empty($_GET["O"]) || !in_array($_GET["O"], ["i", "u"])) {
    die("O non valida");
}
$O = $_GET["O"];

$sql = $conn->prepare("SELECT valore FROM insiemi WHERE insieme = ?");
$sql->bind_param("i", $A);
$sql->execute();
$result = $sql->get_result();

$numeri_A = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $numeri_A[] = (int) $row['valore'];
    }
}

$sql = $conn->prepare("SELECT valore FROM insiemi WHERE insieme = ?");
$sql->bind_param("i", $B);
$sql->execute();
$result = $sql->get_result();

$numeri_B = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $numeri_B[] = (int) $row['valore'];
    }
}

$numeri_O = $O === "u" ? array_unique(array_merge($numeri_A, $numeri_B)) : array_intersect($numeri_A, $numeri_B);

$new = max([$A, $B]) + 1;

// create new insieme
foreach($numeri_O as $num) {
    $sql = $conn->prepare("INSERT INTO insiemi (valore, insieme) VALUES (?, ?)");
    $sql->bind_param("ii", $num, $new);

    if(!$sql->execute()) {
        die("failed to execute query");
    }
}