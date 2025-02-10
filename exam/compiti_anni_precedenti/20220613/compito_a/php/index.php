<?php

$servername = "localhost:3306";
$username = "root";
$password = "password";
$db = "esami";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function check_valid($str)
{
    if (strlen($str) != 81) {
        return false;
    }

    for ($i = 0; $i < 9; $i++) {
        $row = [];
        $col = [];

        for ($j = 0; $j < 9; $j++) {
            // row check
            $row_idx = $i * 9 + $j;
            $n = $str[$row_idx];
            if ($n != '0' && in_array($n, $row)) {
                return false;
            }
            $row[] = $n;

            // col check
            $col_idx = $j * 9 + $i;
            $n = $str[$col_idx];
            if ($n != '0' &&  in_array($n, $col)) {
                return false;
            }

            $col[] = $n;
        }
    }

    // Subgrid check
    for ($i = 0; $i < 9; $i += 3) {
        for ($j = 0; $j < 9; $j += 3) {
            $square = [];
            for ($k = 0; $k < 3; $k++) {
                for ($l = 0; $l < 3; $l++) {
                    $n = $str[($i + $k) * 9 + ($j + $l)];
                    if ($n !== '0') {
                        if (isset($square[$n])) return false;
                        $square[$n] = true;
                    }
                }
            }
        }
    }

    return true;
}

function check_solution($str)
{
    if (str_contains($str, '0')) return false;
    return check_valid($str);
}

function generate_random_init()
{
    $init = "";
    $random_pos = [];
    $pos = 0;
    for ($i = 0; $i < 9; $i++) {
        $pos = random_int(0, 8) + 9 * $i;
        $random_pos[] = $pos;
    }

    for ($i = 0; $i < 81; $i++) {
        if (in_array($i, $random_pos)) {
            $number = random_int(1, 9);
            $init .= (string) $number;
        } else {
            $init .= "0";
        }
    }
    return $init;
}

function echo_json($array)
{
    header("Content-type:application/json");
    echo json_encode($array);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // create new initial state
    $init = "";
    while (!check_valid($init)) $init = generate_random_init();

    // create game
    $sql = $conn->prepare("INSERT INTO sudoku (statoiniziale) VALUES (?)");
    $sql->bind_param('s', $init);
    if (!$sql->execute()) {
        die("Failed to create new game");
    }

    $id = $sql->insert_id;
    setcookie("game_id", $id);


    header("Content-type:application/json");
    echo_json(["init" => $init]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["sol"])) die("Provide a solution");
    $sol = $_POST["sol"];

    $sql = $conn->prepare("SELECT statoiniziale FROM sudoku WHERE id = ?");
    $sql->bind_param("i", $_COOKIE["game_id"]);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows < 1) die("Failed to retrive previous game");
    $init = $result->fetch_row()[0];

    if (strlen($sol) != 81) {
        echo_json(["valid" => false]);
        die();
    }

    // check init correspond
    for ($i = 0; $i < strlen($init); $i++) {
        if ($init[$i] != '0' && $init[$i] != $sol[$i]) {
            echo_json(["valid" => false]);
            die();
        }
    }

    echo_json(["valid" => check_solution($sol)]);
}
