<?php

namespace App\Providers;

use App\Events\ElonMaskTweet;
use App\Events\HackerAttack;
use App\Listeners\ElonMaskEventListener;
use App\Listeners\HackerAttackEventListener;

class EventProvider {

    public static function callStack() {
        return [
            ElonMaskTweet::class => ElonMaskEventListener::class,
            HackerAttack::class => HackerAttackEventListener::class
        ];
    }
}