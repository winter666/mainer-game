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