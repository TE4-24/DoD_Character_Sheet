<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['Cname'])) {
    $characterName = $_POST['Cname'];
    echo "<script>console.log('Received character name: " . $characterName . "');</script>";
} else {
    echo "<script>console.log('No character name provided');</script>";
}
?>