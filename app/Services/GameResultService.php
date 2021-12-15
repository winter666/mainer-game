<?php

namespace App\Services;

use App\Entities\Game\GameProgress;

class GameResultService {
    private $players;
    private $game_progress_array;
    private $event_type;
    private $event;

    private $result = [];

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
        return $this->result;
    }

    public function serializeResult() {
        $scores = [];
        $log = [];
        $list = [];
        $players = [];
        $game_progress = $this->game_progress_array;

        foreach ($this->players as $player) {
            $scoresTmp [] = [
                'player' => $player->name,
                'score' => $player->getScore()
            ];
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

        $scores = $this->setScoreRaiting($scoresTmp);
        $this->result = compact('players', 'scores', 'log', 'list', 'game_progress');

        return $this;
    }

    public function serializeResultTable() {
        $tableHeads = ["Round #"];
        $tableBody = [];
        foreach($this->result['players'] as $player) {
            $tableHeads[] = $player;
        }

        foreach($this->game_progress_array as $step) {
            $tableBody[] = ["round" => $step->getRoundNum()];
            $key = array_key_last($tableBody);
            foreach($step->getRoundData() as $roundData) {
                $tableBody[$key]["players_data"][] = [
                    "player" => $roundData['player']->name, 
                    "score" => $roundData['nominal']
                ];
            }
        }

        return [
            't_heads' => $tableHeads,
            't_body' => $tableBody
        ];
    }

    private function setScoreRaiting($scores) {
        arr_sort($scores, 'score', "DESC");
        foreach($scores as $key => $score) {
            $scores[$key]['raiting'] = $key + 1;
        }

        return $scores;
    }

}