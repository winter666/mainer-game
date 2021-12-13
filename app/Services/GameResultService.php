<?php

namespace App\Services;

use App\Entities\Game\GameProgress;

class GameResultService {
    private $players;
    private $event_type;
    private $event;

    public function __construct($players, array $gameProgress)
    {
        $this->players = $players;
    }

    // private function parseGameProgress($gameProgress) {

    // }

    public function getPlayers() {
        return $this->players;
    }

    public function getEventType() {
        return $this->event_type;
    }

    public function getEventResults() {
        return $this->event;
    }

    public function getResult() {
        $scores = [];
        $players = [];
        // TODO: привести к удобному формату
        foreach ($this->players as $player) {
            $scores [$player->name] = $player->getScoreList();
            $players[] = $player->name;
        }

        return $scores;
    }
}