<?php
namespace Controllers;

use Models\Player as PlayerModel;
use Models\Game as GameModel;

class Player
{
    private $playerModel = null;
    private $gameModel = null;

    public function __construct()
    {
        $this->playerModel = new PlayerModel();
        $this->gameModel = new GameModel();
    }

    public function register()
    {
        $view = 'views/game.php';
        $_SESSION['errors'] = [];

        if (empty($_POST['email'])) {
            $_SESSION['email'] = '';
            $this->gameModel->initGame();
        } else {
            $_SESSION['email'] = $_POST['email'];
            if ($this->playerModel->is_validEmail($_POST['email'])) {
                $this->gameModel->initGame();
            } else {
                $_SESSION['errors'] = [
                    'email' => $_POST['email'] . ' ne semble pas être une adresse email valide',
                ];
                $view = 'views/player.php';
            }
        }

        return compact('view');
    }

}