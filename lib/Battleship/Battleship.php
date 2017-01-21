<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 2:07 PM
 */

namespace Battleship;


class Battleship
{
    //Player Name
    private $name = "player 1";
    private $shots = 0;
    private $shipsLeft = 10;

    /**
     * @return int
     */
    public function getShipsLeft()
    {
        return $this->shipsLeft;
    }

    /**
     * @param int $shipsLeft
     */
    public function setShipsLeft($shipsLeft)
    {
        $this->shipsLeft = $shipsLeft;
    }


    public function __construct($seed = NULL) {
        if ($seed === null) {
            $seed = time();
        }
        srand($seed);
    }

    public function clearGame(){
        $this->setShots(0);
        $this->setGameOver(false);
        $this->setShipsLeft(10);
    }


    public function buildGrid(){
        $this->clearGame();
        // Init Tile Array
        for ($r=0; $r < $this->gridSize; $r++){
            for ($c=0; $c < $this->gridSize; $c++){
                $this->grid[$r][$c] = null;
            }
        }
        // Init Count Array
        for ($r=0; $r < $this->gridSize; $r++){
            $this->grid[$r][6] = 0;
            $this->grid[6][$r] = 0;
        }
    }

    public function endGame(){
        for ($r=0; $r < $this->gridSize; $r++){
            for ($c=0; $c < $this->gridSize; $c++){
                $this->grid[$r][$c]->setHit(true);
            }
        }
    }

    public function fillGrid(){
        // Filling null Times with Water Tiles
        for ($r=0; $r < $this->gridSize; $r++){
            for ($c=0; $c < $this->gridSize; $c++){
                if ($this->grid[$r][$c] == null){
                    $this->grid[$r][$c] = new Tile(Tile::WATER);
                }
            }
        }
    }

    public function addShip($row, $col, $len, $l_or, $r_or){
        // Battleship
        if ($len == 3){
            $this->grid[$row][$col] = new Tile(Tile::BATTLESHIP_TOP);
            $this->grid[$row][6]++;
            $this->grid[6][$col]++;

            $this->grid[$row+1][$col] = new Tile(Tile::BATTLESHIP_MID);
            $this->grid[$row+1][6]++;
            $this->grid[6][$col]++;

            $this->grid[$row+2][$col] = new Tile(Tile::BATTLESHIP_BOT);
            $this->grid[$row+2][6]++;
            $this->grid[6][$col]++;
        }

        // Patrol Boat
        else if ($len == 1){
            $this->grid[$row][$col] = new Tile(Tile::PATROL_BOAT);
            $this->grid[$row][6]++;
            $this->grid[6][$col]++;
        }

        // Cruiser
        else if ($len == 2){
            // Down
            if ($l_or == 1 && $r_or == 0){
                $this->grid[$row][$col] = new Tile(Tile::CRUISER_TOP);
                $this->grid[$row][6]++;
                $this->grid[6][$col]++;

                $this->grid[$row+1][$col] = new Tile(Tile::CRUISER_BOT);
                $this->grid[$row+1][6]++;
                $this->grid[6][$col]++;
            }
            // Right
            else if ($l_or == 0 && $r_or == 1){
                $this->grid[$row][$col] = new Tile(Tile::CRUISER_LEFT);
                $this->grid[$row][6]++;
                $this->grid[6][$col]++;

                $this->grid[$row][$col+1] = new Tile(Tile::CRUISER_RIGHT);
                $this->grid[$row][6]++;
                $this->grid[6][$col+1]++;
            }
        }
    }



    /**
     * @return int
     */
    public function getShots()
    {
        return $this->shots;
    }

    /**
     * @param int $shots
     */
    public function setShots($shots)
    {
        $this->shots = $shots;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param mixed $grid
     */
    public function setGrid($grid)
    {
        $this->grid = $grid;
    }

    // GameOver Variable
    private $gameOver = false;

    /**
     * @return boolean
     */
    public function isGameOver()
    {
        return $this->gameOver;
    }

    /**
     * @param boolean $gameOver
     */
    public function setGameOver($gameOver)
    {
        $this->gameOver = $gameOver;
    }


    //Grid Size
    private $gridSize = 6;

    // Grid Object
    private $grid;

    private $lastHit;

    /**
     * @return mixed
     */
    public function getLastHit()
    {
        return $this->lastHit;
    }

    /**
     * @param mixed $lastHit
     */
    public function setLastHit($lastHit)
    {
        $this->lastHit = $lastHit;
    }



}