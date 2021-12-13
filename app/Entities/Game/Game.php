<?php

namespace App\Entities\Game;

use App\Core\Processes\GameProcess;
use App\Entities\Player;

class Game {
    public $players = [];
    public $event_period = 0;

    public function start() {
        return (new GameProcess($this->players, $this->event_period))->run();
    }

    public function withPlayer(string $playerName) {
        $this->players[] = new Player($playerName);
        return $this;
    }

    public function withEventPeriod(int $period) {
        $this->event_period = $period;
    }

}