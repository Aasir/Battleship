<?php

require __DIR__ . "/../vendor/autoload.php";

session_start();

define("BATTLESHIP_SESSION", 'battleship');

if(!isset($_SESSION[BATTLESHIP_SESSION])) {
    $_SESSION[BATTLESHIP_SESSION] = new Battleship\Battleship();
}

$battleship = $_SESSION[BATTLESHIP_SESSION];