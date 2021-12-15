<?php

namespace App\Entities\Game;

use App\Entities\Player;

class GameProgress {
    private $event_type;
    private $round_data;
    private $round_number;

    public function setEventType($eventType) {
        $this->event_type = $eventType;
    }

    public function pushGameData(
        int $roundNum, 
        Player $player, 
        int $originNominal, 
        int $eventNominal = 0, 
        ?int $diff = 0, 
        ?string $eventAction = 'None'
        ) {
        $this->round_number = $roundNum;
        $this->round_data[$player->name] = [
            'round' => $roundNum,
            'player' => $player,
            'origin_nominal' => $originNominal,
            'event_nominal' => $eventNominal,
            'event_type' => $this->event_type,
            'diff' => $diff,
            'action' => $eventAction
        ];
    }

    public function getRoundData() {
        return $this->round_data;
    }

    public function getRoundNum() {
        return $this->round_number;
    }
}