<?php

require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Core\Log;
use App\Services\GameResultService;
use App\Services\GameService;

try {
$res = GameService::init()
    ->withPLayer('Rick')
    ->withPLayer('Morty')
    ->withPlayer('Summer')
    ->start();
} catch(\Exception $e) {
    Log::print($e->getMessage());
}
if ($res) {
    $players = $res['players'];
    $scores = $res['scores'];
    $gameProgress = $res['game_progress'];
    $table = GameResultService::serializeResultTable($gameProgress);

    echo template('main', compact('players', 'table', 'scores'));
} else {
    echo template('somethings-wrong');
}
