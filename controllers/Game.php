<?php
namespace Controllers;

use Models\Player as PlayerModel;
use Models\Game as GameModel;

class Game
{
    private $GameModel = null;
    private $PlayerModel = null;

    public function __construct()
    {
        $this->GameModel = new GameModel();
        $this->PlayerModel = new PlayerModel();
    }

    public function init()
    {
        $_SESSION['email'] = $_SESSION['email']??'';

        return ['view' => 'views/player.php'];
    }

    public function play()
    {
        if ($this->GameModel->is_letter($_POST['triedLetter'])) {
            $this->GameModel->increaseAttempt();
            $triedLetter = $_POST['triedLetter'];
        } else {
            header('Location: http://cours.app/pendu/errors/error_main.php');
            exit;
        }

        $this->GameModel->updateTriedLettersString($triedLetter);
        $this->GameModel->updateLettersArray($triedLetter);

        if (! $this->GameModel->is_letterInWord($triedLetter)) {
            $this->GameModel->increaseTrials();
        } else {
            $_SESSION['wordFound'] =  $this->GameModel->is_wordFound();
        }

        $this->GameModel->updateRemainingTrials();

        $gamesCount = $gamesWon = '';
        if ($_SESSION['email']) {
            if ($_SESSION['wordFound'] || !$_SESSION['remainingTrials']) {
                $this->GameModel->saveGame();
                $gamesCount =  $this->PlayerModel->getGamesCount();
                if ($gamesCount) {
                    $gamesWon =  $this->PlayerModel->getGamesWon();
                }
            }
        }

        $view = 'views/game.php';

        return compact('view', 'gamesCount', 'gamesWon');
    }

}
