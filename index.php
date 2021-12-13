<?php

require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Services\GameService;

$res = GameService::init()
    ->withPLayer('Test 1')
    ->withPLayer('Test 2')
    ->withPlayer('Test 3')
    ->start();

// echo "<table>";
// echo "<thead>";
// foreach($res as $player => $val) {
//     echo "<th>$player</th>";
// }
// echo"</thead>";
// echo "<tbody>";
// foreach($res as $player) {
//     echo "<tr>";
//     foreach ($player as $score) {
//         echo "<td>$score</td>";
//     }
//     echo "</tr>";
// }
// echo "</tbody>";
// echo "</table>";
?>

<table>
    <thead>
        <?php foreach ($res as $player => $val): ?>
            <th> <?= $player; ?> </th>
        <?php endforeach; ?>
    </thead>
    <tbody>
        <?php foreach ($res as $player => $val): ?>
            <tr>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

