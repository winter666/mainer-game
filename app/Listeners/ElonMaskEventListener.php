<?php

namespace App\Listeners;

use App\Core\Listener;
use App\Interfaces\IListener;

class ElonMaskEventListener extends Listener implements IListener {

    public function handle() {
        echo $this->data;
    }
}