<?php

namespace App\Core\Processes;

use App\Core\Interfaces\IProcess;

class GameProcess implements IProcess {

    public function run() {
        echo "Start the game";
    }

}