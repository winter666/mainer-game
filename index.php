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
    ->withEventPeriod(rand(1, 365))
    ->withEventPeriod(14)
    ->withEventPeriod(289)
    ->start();
} catch(\Exception $e) {
    Log::print($e->getMessage());
}
if ($gameResult) {
    $res = $gameResult->getResults();
    $players = $res['players'];
    $scores = $res['scores'];
    $table = $gameResult->getResultTable();
    $event = $gameResult->getEventResults();
    echo template('main', compact('players', 'table', 'scores', 'event'));
} else {
    echo template('somethings-wrong');
}
