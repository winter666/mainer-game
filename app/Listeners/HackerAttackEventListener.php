<?php

namespace App\Listeners;

use App\Core\Listener;
use App\Interfaces\IListener;
use App\Services\Actions\Steal;

class HackerAttackEventListener extends Listener  implements IListener {

    public function handle() {
        return [
            'coefficient' => 2,
            'action' => Steal::class
        ];
    }
}