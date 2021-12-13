<?php

namespace App\Core\Processes;

use App\Core\Interfaces\IProcess;
use App\Events\ElonMaskTweet;
use App\Entities\Player;
use Exception;

class GameProcess implements IProcess {
    private $players = [];
    private $minPlayersOnGame = 2;

    public function __construct(array $players) {
        if (!empty($players) && count ($players) >= $this->minPlayersOnGame) {
            foreach($players as $player) {
                throw_if(!($player instanceof Player), new Exception("All players must be instance of App\Entities\PLayer"));
                $this->players[] = $player;
            }
        } else {
            throw new Exception("Players must be of total count >= $this->minPlayersOnGame");
        }
    }

    public function run() {
        
    }

}