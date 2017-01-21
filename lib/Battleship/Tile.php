<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 2:10 PM
 */

namespace Battleship;


class Tile
{
    // Constants for Tile Image
    const WATER = 0;
    const BATTLESHIP_TOP = 1;
    const BATTLESHIP_MID = 2;
    const BATTLESHIP_BOT = 3;
    const CRUISER_TOP = 4;
    const CRUISER_BOT = 5;
    const CRUISER_LEFT = 6;
    const CRUISER_RIGHT = 7;
    const PATROL_BOAT = 8;


    // Image Links
    const SHIP_TOP = "top";
    const SHIP_BOT = "bottom";
    const SHIP_MID = "middle";
    const SHIP_LEFT = "left";
    const SHIP_RIGHT = "right";
    const IMG_WATER = "water";
    const BOAT_IMG = "single";
    const BOMB_HIT = "peg";
    const IMG_NULL = "null";


    private $hit = false;

    public function ifShip(){
        return $this->getType() != Tile::WATER;
    }

    /**
     * @return boolean
     */
    public function isHit()
    {
        return $this->hit;
    }

    /**
     * @param boolean $hit
     */
    public function setHit($hit)
    {
        $this->hit = $hit;
    }

    /**
     * Tile constructor.
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function getImage(){
        if ($this->type == self::WATER){
            return self::IMG_WATER;
        }
        else if ($this->type == self::BATTLESHIP_TOP || $this->type == self::CRUISER_TOP){
            return self::SHIP_TOP;
        }
        else if ($this->type == self::BATTLESHIP_MID){
            return self::SHIP_MID;
        }
        else if ($this->type == self::BATTLESHIP_BOT || $this->type == self::CRUISER_BOT){
            return self::SHIP_BOT;
        }
        else if ($this->type == self::CRUISER_LEFT){
            return self::SHIP_LEFT;
        }
        else if ($this->type == self::CRUISER_RIGHT){
            return self::SHIP_RIGHT;
        }
        else if ($this->type == self::PATROL_BOAT){
            return self::BOAT_IMG;
        }
        else{
            // If Shot
            if ($this->hit){
                return self::BOMB_HIT;
            }
            return "";
        }
    }

    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

}