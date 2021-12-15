<?php

namespace App\Entities\Game;

use App\Core\Log;
use App\Core\Processes\GameProcess;
use App\Entities\Player;

class Game {
    public $players = [];
    public $event_periods = [];

    public function start() {
        try {
            return (new GameProcess($this->players, $this->event_periods))->run();
        } catch(\Exception $e) {
            Log::print($e->getMessage());
        }
        return null;
    }

    public function withPlayer(string $playerName) {
        $this->players[] = new Player($playerName);
        return $this;
    }

    public function withEventPeriod(int $period) {
        $this->event_periods[] = $period;
        return $this;
    }

}