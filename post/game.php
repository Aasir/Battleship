<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 9:55 PM
 */

require '../lib/battleship.inc.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

//print_r(explode(",", $_POST['tile']));


$controller = new \Battleship\BattleshipController($battleship, $_POST);
header("location: " . $controller->getPage());