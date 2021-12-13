<?php

require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Core\Processes\GameProcess;
use App\Events\ElonMaskTweet;

(new GameProcess)->run();
event(new ElonMaskTweet, "Tweet");