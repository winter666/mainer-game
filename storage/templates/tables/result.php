<h2>Game Progress</h2>

<table  width="500">
    <thead>
        <tr>
            <?php foreach ($table['t_heads'] as $tHead): ?>
                <th> <?= $tHead; ?> </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php foreach ($table['t_body'] as $tBody): ?>        
            <tr>
                <td><?= $tBody['round'] ?></td>
                <?php foreach ($tBody['players_data'] as $playersData): ?>
                    <td><?= $playersData['player'] ?>: <?= $playersData['score'] ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>    
    </tbody>
</table>