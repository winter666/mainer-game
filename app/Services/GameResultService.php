<?php

namespace App\Services;

use App\Entities\Game\GameProgress;

class GameResultService {
    private $players;
    private $game_progress_array;
    private $event = null;
    private $results = [];

    public function __construct($players, array $gameProgress)
    {
        $this->players = $players;
        $this->game_progress_array = $gameProgress;
    }

    public function getPlayers() {
        return $this->players;
    }

    public function getEventResults() {
        return $this->event;
    }

    public function getResults() {
        return $this->results;
    }

    public function serializeResult() {
        $this->setResults();
        $this->setEventDiffs();
        return $this;
    }

    private function setResults() {
        $scores = [];
        $players = [];

        foreach ($this->players as $player) {
            $scoresTmp [] = [
                'player' => $player->name,
                'score' => $player->getScore()
            ];
            $players[] = $player->name;
        }

        $scores = $this->setScoreRaiting($scoresTmp);
        $this->results = compact('players', 'scores');
    }

    private function setEventDiffs() {
        $data = [];
        foreach ($this->game_progress_array as $gameProgress) {
            foreach($gameProgress->getRoundData() as $roundData) {
                if ($roundData['diff'] === 0) 
                    continue;

                $key = array_key_last($data);
                if ($data[$key] && $data[$key]['round'] === $roundData['round']) {
                    $data[$key]['nominal'] += $roundData['diff'];
                } else {
                    $data[] = [
                        'round' => $roundData['round'],
                        "type" => $roundData['event_type'],
                        'name' => EventInGameService::HUMAN_REDABLE_EVENT_NAMES[$roundData['event_type']],
                        'nominal' => $roundData['diff'],
                    ];
                }
            }
        }

        if (count($data)) {
            $this->event = $data;
        }
    }

    public function getResultTable() {
        $tableHeads = ["Round #"];
        $tableBody = [];
        foreach($this->results['players'] as $player) {
            $tableHeads[] = $player;
        }

        foreach($this->game_progress_array as $step) {
            $tableBody[] = ["round" => $step->getRoundNum()];
            $key = array_key_last($tableBody);
            foreach($step->getRoundData() as $roundData) {
                $tableBody[$key]["players_data"][] = [
                    "player" => $roundData['player']->name, 
                    "origin_score" => $roundData['origin_nominal'],
                    "event_score" => $roundData['event_nominal']
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