<?php

namespace App\Listeners;

use App\Core\Listener;
use App\Interfaces\IListener;
use App\Services\Actions\Decrease;
use App\Services\Actions\Increase;

class ElonMaskEventListener extends Listener implements IListener {

    public function handle() {
        $modificator = ($this->data->getCurrent() % 2 == 0) ? Increase::class : Decrease::class;

        return [
            'coefficient' => 10,
            'action' => $modificator
        ];
    }
}