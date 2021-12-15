<?php

require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Core\Log;
use App\Services\GameResultService;
use App\Services\GameService;

try {
$gameResult = GameService::init()
    ->withPLayer('Rick')
    ->withPLayer('Morty')
    ->withPlayer('Summer')
    ->start();
} catch(\Exception $e) {
    Log::print($e->getMessage());
}
if ($gameResult) {
    $res = $gameResult->getResult();
    $players = $res['players'];
    $scores = $res['scores'];
    $gameProgress = $res['game_progress'];
    $table = $gameResult->serializeResultTable();

    echo template('main', compact('players', 'table', 'scores'));
} else {
    echo template('somethings-wrong');
}
