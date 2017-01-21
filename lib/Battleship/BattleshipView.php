<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 3:14 PM
 */

namespace Battleship;


class BattleshipView
{
    /** Constructor
     * @param $battlefield Battleship object */
    public function __construct(Battleship $battleship) {
        $this->battleship = $battleship;
    }

    public function getGame(){
        $name = $this->battleship->getName();
        $size = 6;
        $html = <<<HTML
<form id="gameform" action="post/game.php" method="POST">
    <fieldset>
        <p>$name's Battleship</p>
HTML;
			$html .= '<table><caption></caption>';

            $grid = $this->battleship->getGrid();
        	for ($r = 0; $r < $size; $r++) {
                $html .= "<tr>";
            	for ($c = 0; $c < $size; $c++) {

                    if ($grid[$r][$c]->isHit()){

                        if (  ($grid[$r][$c]->getType() == Tile::BATTLESHIP_TOP && $grid[$r+1][$c]->isHit() && $grid[$r+2][$c]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::BATTLESHIP_MID && $grid[$r-1][$c]->isHit() && $grid[$r+1][$c]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::BATTLESHIP_BOT && $grid[$r-1][$c]->isHit() && $grid[$r-2][$c]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::PATROL_BOAT)
                            || ($grid[$r][$c]->getType() == Tile::CRUISER_LEFT && $grid[$r][$c+1]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::CRUISER_RIGHT && $grid[$r][$c-1]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::CRUISER_TOP && $grid[$r+1][$c]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::CRUISER_BOT && $grid[$r-1][$c]->isHit())
                            || ($grid[$r][$c]->getType() == Tile::WATER)
                            )
                        {
                            $tile = $grid[$r][$c];
                            $image = $tile->getImage();
                            $html .= <<<HTML
<td><img src=images/$image.png alt="Hit"></td>
HTML;
                        }
                        else{
                            $html .= <<<HTML
<td><img src=images/peg.png alt="Hit"></td>
HTML;
                        }
                    }
                    else{
                        if ($this->battleship->isGameOver()){
                            $html .= <<<HTML
<td>&nbsp;</td>
HTML;
                        }
                        else {
                            $html .= <<<HTML
<td><button name="tile" value="$r,$c">&nbsp;</button></td>
HTML;
                        }
                    }
            }

        $html .= '<td>' . $grid[$r][6] . '</td></tr>';
        }

        $html .= "<tr>";
        for ($c = 0; $c < $size; $c++) {
            $html .= '<td>' . $grid[6][$c] . '</td>';
        }
        $html .= "</tr></table>";

        if ($this->battleship->getShots() > 0) {
            $html .= "<p>After " . $this->battleship->getShots() . " shots";

            $last = $this->battleship->getLastHit();
            $tile = $grid[$last[0]][$last[1]];
            $r = $last[0];
            $c = $last[1];

            // Water
            if ($tile->getType() == Tile::WATER){
                $html .= ", splash";
            }

            // Patrol Boat
            else if ($tile->getType() == Tile::PATROL_BOAT){
                $html .= " you sunk my patrol boat";
            }

            // Battleship Top
            else if (($tile->getType() == Tile::BATTLESHIP_TOP)){
                if ($grid[$r+1][$c]->isHit() && $grid[$r+2][$c]->isHit()) {
                    $html .= " you have sunk my battleship";
                }
                else{
                    $html .= " you have a hit";
                }
            }
            // Battleship Mid
            else if (($tile->getType() == Tile::BATTLESHIP_MID)){
                if ($grid[$r-1][$c]->isHit() && $grid[$r+1][$c]->isHit()) {
                    $html .= " you have sunk my battleship";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            // Battleship Bot
            else if (($tile->getType() == Tile::BATTLESHIP_BOT)){
                if ($grid[$r-1][$c]->isHit() && $grid[$r-2][$c]->isHit()) {
                    $html .= " you have sunk my battleship";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            // Cruise Top
            else if (($tile->getType() == Tile::CRUISER_TOP)){
                if ($grid[$r+1][$c]->isHit()) {
                    $html .= " you have sunk my cruiser";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            // Cruise Bot
            else if (($tile->getType() == Tile::CRUISER_BOT)){
                if ($grid[$r-1][$c]->isHit()) {
                    $html .= " you have sunk my cruiser";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            // Cruise Left
            else if (($tile->getType() == Tile::CRUISER_LEFT)){
                if ($grid[$r][$c+1]->isHit()) {
                    $html .= " you have sunk my cruiser";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            // Cruise Right
            else if (($tile->getType() == Tile::CRUISER_RIGHT)){
                if ($grid[$r][$c-1]->isHit()) {
                    $html .= " you have sunk my cruiser";
                }
                else{
                    $html .= " you have a hit";
                }
            }

            $html .= "</p>";
        }

        if ($this->battleship->isGameOver()) {
            $html .= "<p>Game Over!</p>";
        }


    $html .= <<<HTML
<p><input type="submit" name="giveup" value="Give Up"></p>
<p><input type="submit" name="newgame" value="New Game"></p>

</fieldset>
</form>
HTML;

    return $html;
    }


    private $battleship;	// Battleship object

}