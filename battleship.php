<?php
require __DIR__ . '/lib/battleship.inc.php';
$view = new Battleship\BattleshipView($battleship);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery-2.2.3.min.js"></script>
    <link href="battleship.css" type="text/css" rel="stylesheet" />
    <title>Battleship</title>
</head>
<body>
<?php
	echo $view->getGame();
?>

</body>
</html>