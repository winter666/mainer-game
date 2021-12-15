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
    private $event_periods = [];
    private $event_service;
    private $event_action;
    private $min_players_on_game = 2;
    private $max_players_on_game = 4;
    private $round;

    private $game_process_steps = [];

    public function __construct(array $players, array $eventPeriods = []) {
        $this->event_periods = $eventPeriods;

        if (!empty($players) && (count ($players) >= $this->min_players_on_game && count($players) <= $this->max_players_on_game)) {
            foreach($players as $player) {
                throw_if(!($player instanceof Player), new Exception("All players must be instance of App\Entities\PLayer"));
                foreach($this->players as $internalPlayer) {
                    throw_if($internalPlayer->name == $player->name, new \Exception("Player name must be a unique value"));
                }

                $this->players[] = $player;
            }
        } else {
            throw new Exception("Players total count must equals or greater than $this->min_players_on_game, or equals or lesser than $this->max_players_on_game");
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
        $this->round->init();

        while($this->round->getCurrent() <= self::ROUNDS) {
            $this->OneTik();
            $this->round->up();
        }

        $locker->unlock();
        return $this->showResults();
    }

    private function OneTik() {
        $gameProgress = new GameProgress();
        if (in_array($this->round->getCurrent(), $this->event_periods)) {
            $this->event_service->setRandomEvent();
            $this->event_service->callEvent();
            $this->event_action = $this->event_service->getEventResult();
        }
        
        foreach($this->players as $player) {
            $gameProgress->setEventType($this->event_service->getCurrentEventType());
            $nominal = $this->getNominal($gameProgress, $player);
            $player->countScore($nominal);
        }

        $this->game_process_steps[] = $gameProgress;
    }

    private function getNominal(GameProgress $gameProgress, Player $player) {
        $originNominal = rand(1, 1000);
        $postEventNominal = 0;
        $diff = 0;
        if (in_array($this->round->getCurrent(), $this->event_periods)) {
            $actionClass = $this->event_action;
            $actionObject = new $actionClass();
            $postEventNominal = $actionObject->process($originNominal);
            $diff = $actionObject->getDiff();
        }

        $gameProgress->pushGameData($this->round->getCurrent(), $player, $originNominal, $postEventNominal, $diff, $this->event_data['action']);
        return ($postEventNominal > 0) ? $postEventNominal : $originNominal;
    }

    private function showResults() {
        $service = new GameResultService($this->players, $this->game_process_steps);
        return $service->serializeResult();
    }

}