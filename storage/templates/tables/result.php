<h2>Game Progress</h2>

<table >
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
                    <td>
                        <div>
                            <b>Original nominal:</b> <?= $playersData['origin_score'] ?>
                        </div>
                        <div>
                            <b>After event nominal:</b> <?= $playersData['event_score'] > 0 ? $playersData['event_score'] : "no events happened" ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>    
    </tbody>
</table>