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
    $log = $res['log'];
    $list = $res['list'];
    $gameProgress = $res['game_progress'];
    $table = GameResultService::serializeResultTable($gameProgress);

    ob_start();
    ?>
        <style>
            body {
                background-color: black;
                color: #ffffff;
            }
        </style>
        <table  width="500">
            <thead>
                <tr>
                    <th>Round №</th>
                    <?php foreach ($players as $player): ?>
                        <th> <?= $player; ?> </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                <?php foreach ($table as $round => $data): ?>        
                    <tr>
                        <td><?= $round; ?></td>
                        <?php foreach ($data as $key => $tableD): ?>
                            <td><?= $key ?>: <?= $tableD ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    <?php
    $html = ob_get_clean();
} else {
    die();
}
?>
<?= $html; ?>
