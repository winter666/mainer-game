<?php

namespace App\Entities;

use App\Core\Processes\GameProcess;
use App\Entities\Player;

class Game {
    public $players = [];

    public function withPlayer(string $playerName) {
        $this->players[] = new Player($playerName);
        return $this;
    }

    public function start() {
        (new GameProcess($this->players))->run();
    }
}