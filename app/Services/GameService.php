<?php

namespace App\Services;

use App\Entities\Game\Game;
use App\Entities\Player;

class GameService {

    public static function init() {
        return new Game();
    }

}