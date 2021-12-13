<?php

namespace App\Services;

use App\Core\Processes\GameProcess;
use App\Entities\Round;
use App\Events\ElonMaskTweet;
use App\Events\HackerAttack;

class EventInGameService {
    private const ELON_MASK_TWEET_EVENT = 'ELON_MASK_TWEET_EVENT';
    private const HACKER_ATTACK_EVENT = 'HACKER_ATTACK_EVENT';
    private static $allow_events = [
        self::ELON_MASK_TWEET_EVENT,
        self::HACKER_ATTACK_EVENT
    ];

    private $event_type = '';
    private $event_result = 0;
    private $game_round = null;

    public function __construct(Round $gameRound) {
        $this->game_round = $gameRound;
    }

    public function setRandomEvent() {
        $randomKey = rand(0, (count(self::$allow_events) - 1));
        $this->event_type = self::$allow_events[$randomKey];
    }

    public function callEvent() {
        switch($this->event_type) {
            case self::ELON_MASK_TWEET_EVENT:
                $this->event_result = event(new ElonMaskTweet, $this->game_round, true);
                break;
            case self::HACKER_ATTACK_EVENT:
                $this->event_result = event(new HackerAttack, $this->game_round, true);
                break;
        }
    }

    public function getCurrentEventType() {
        return $this->event_type;
    }

    public function getEventResult() {
        return $this->event_result;
    }



}