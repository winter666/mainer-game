<?php

namespace App\Entities\Game;

use App\Entities\Player;

class GameProgress {
    private $event_type;
    private $game_data;
    private $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function setEventType($eventType) {
        $this->event_type = $eventType;
    }

    public function pushGameData($originNominal, $coefficient = 0, $diff = 0, $eventAction = 'None') {
        $this->game_data[] = [
            'player' => $this->player,
            'nominal' => $originNominal,
            'coefficient' => $coefficient,
            'diff' => $diff,
            'action' => $eventAction
        ];
    }
}