<?php
session_start();
if (!isset($_SESSION['count'])) {
    echo "count non esiste";
}
else {
    echo $_SESSION['count'];
}
?>