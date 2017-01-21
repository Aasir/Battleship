<?php
/**
 * Created by PhpStorm.
 * User: Aasir
 * Date: 4/26/16
 * Time: 2:40 PM
 */

namespace Battleship;


class BattleshipController
{
    private $page = "../battleship.php";
    private $reset = false;
    private $model;
    private $game;

    /**
     * Constructor
     * @param SteampunkedModel $model The SteampunkedModel object
     * @param $post $_POST array
     */
    public function __construct(Battleship $model, $post){
        $this->model = $model;

        // New Game
        if (isset($post['name']) && isset($post['game'])){
            $this->model->setName($post['name']);

            $this->model->buildGrid();

            // Game 1
            if ($post['game'] == 1) {
                $this->model->addShip(0, 0, 3, 1, 0);
                $this->model->addShip(4, 0, 1, 0, 0);
                $this->model->addShip(2, 3, 2, 1, 0);
                $this->model->addShip(5, 2, 1, 0, 0);
                $this->model->addShip(1, 5, 1, 0, 0);
                $this->model->addShip(3, 5, 2, 1, 0);
            }
            // Game 2
            else{
                $this->model->addShip(0, 0, 3, 1, 0);
                $this->model->addShip(4, 0, 1, 0, 0);
                $this->model->addShip(0, 2, 2, 0, 1);
                $this->model->addShip(2, 2, 1, 0, 0);
                $this->model->addShip(4, 4, 2, 1, 0);
                $this->model->addShip(0, 5, 1, 0, 0);
            }
            // Fill rest with water
            $this->model->fillGrid();
        }

        else if (isset($post['tile'])){
            $index = explode(",", $post['tile']);
            $this->model->setLastHit($index);
            $grid = $this->model->getGrid();
            $grid[$index[0]][$index[1]]->setHit(true);
            $shots = $this->model->getShots();
            $this->model->setShots(++$shots);

            if ($grid[$index[0]][$index[1]]->ifShip()) {
                $shipsLeft = $this->model->getShipsLeft();
                --$shipsLeft;
                $this->model->setShipsLeft($shipsLeft);
            }

            if ($this->model->getShipsLeft() == 0){
                $this->model->setGameOver(true);
            }
        }

        else if (isset($post['giveup'])){
            $this->model->endGame();
        }

        else if (isset($post['newgame'])){
            $this->page = "../";
        }

    }

    /**
     * Get the next page to redirect to
     * @return page
     */
    public function getPage() {
        return $this->page;
    }
}