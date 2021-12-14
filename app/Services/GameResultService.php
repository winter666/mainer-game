<?php

namespace App\Services;

use App\Entities\Game\GameProgress;

class GameResultService {
    private $players;
    private $game_progress_array;
    private $event_type;
    private $event;

    public function __construct($players, array $gameProgress)
    {
        $this->players = $players;
        $this->game_progress_array = $gameProgress;
    }

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
        return $this->serializeResult();
    }

    public function serializeResult() {
        $scores = [];
        $log = [];
        $list = [];
        $players = [];
        $game_progress = $this->game_progress_array;

        foreach ($this->players as $player) {
            $scores [$player->name] = $player->getScore();
            $players[] = $player->name;
            $log = array_merge($log, array_map(function($score) use ($player) {
                return [
                    "player" => $player->name,
                    "score" => $score
                ];
            }, $player->getScoreList()));
            
            $list = array_map(function($score) use ($player) {
                return [
                    $player->name => $score 
                ];
            }, $player->getScoreList());
        }

        return compact('players', 'scores', 'log', 'list', 'game_progress');
    }

    public static function serializeResultTable(array $gameProgress) {
        $tableDs = [];
        foreach($gameProgress as $step) {
            $tableDs[$step->getRoundNum()] = array_map(function($roundData) {
                return $roundData['nominal'];
            }, $step->getRoundData());
        }

        return $tableDs;
    }
}