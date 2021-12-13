<?php

namespace App\Core\Processes;

use App\Core\Interfaces\IProcess;
use App\Core\Locker;
use App\Entities\Game\GameProgress;
use App\Services\GameResultService;
use App\Entities\Player;
use App\Entities\Round;
use App\Services\EventInGameService;
use Exception;

class GameProcess implements IProcess {
    private const LOCK_FILE_NAME = "game_process";
    private const ROUNDS = 365;
    private $players = [];
    private $event_start_on = 0;
    private $event_service;
    private $event_data = [];
    private $min_players_on_game = 2;
    private $round;

    private $game_process_steps = [];

    public function __construct(array $players, int $eventDotStart = 0) {
        $this->event_start_on = $eventDotStart;

        if (!empty($players) && count ($players) >= $this->min_players_on_game) {
            foreach($players as $player) {
                throw_if(!($player instanceof Player), new Exception("All players must be instance of App\Entities\PLayer"));
                $this->players[] = $player;
            }
        } else {
            throw new Exception("Players must be of total count >= $this->min_players_on_game");
        }

        $this->round = new Round();
    }

    public function run() {
        $locker = new Locker(self::LOCK_FILE_NAME);
        if ($locker->isLock()) {
            throw new Exception("Game already started");       
        }

        $locker->lock();
        $this->event_service = new EventInGameService($this->round);
        $this->event_service->setRandomEvent();
        while($this->round->getCurrent() != self::ROUNDS) {
            $this->OneTik();
            $this->round->up();
        }

        $locker->unlock();
        return $this->showResults();
    }

    private function OneTik() {
        if ($this->event_start_on === $this->round->getCurrent()) {
            $this->event_service->callEvent();
            $this->event_data = $this->event_service->getEventResult();
        }
        
        foreach($this->players as $player) {
            $gameProgress = new GameProgress($player);
            $gameProgress->setEventType($this->event_service->getCurrentEventType());
            $nominal = $this->getNominal($gameProgress);
            $player->countScore($nominal);
        }
    }

    private function getNominal(GameProgress $gameProgress) {
        $nominal = rand(1, 1000);
        $diff = 0;
        if ($this->event_start_on === $this->round->getCurrent()) {
            $actionClass = $this->event_data['action'];
            $actionObject = new $actionClass();
            $nominal = $actionObject->process($nominal);
            $diff = $actionObject->getDiff();
        }

        $gameProgress->pushGameData($nominal, $this->event_data['coefficient'], $diff, $this->event_data['action']);
        return $nominal;
    }

    private function showResults() {
        $service = new GameResultService($this->players, $this->game_process_steps);
        $service->getResult();
        return $service->getResult();
    }

}