<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 11:30 AM
 */
require '../lib/battleship.inc.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";


$controller = new \Battleship\BattleshipController($battleship, $_POST);
header("location: " . $controller->getPage());
