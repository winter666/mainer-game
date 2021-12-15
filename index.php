<?php

require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Services\GameResultService;
use App\Services\GameService;

$res = GameService::init()
    ->withPLayer('Rick')
    ->withPLayer('Morty')
    ->withPlayer('Pickless')
    ->start();

if ($res) {
    $players = $res['players'];
    $scores = $res['scores'];
    $gameProgress = $res['game_progress'];
    $table = GameResultService::serializeResultTable($gameProgress);

    echo template('main', compact('players', 'table', 'scores'));
    
} else {
    die();
}
