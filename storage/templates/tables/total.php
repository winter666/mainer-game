<h2>Total Score</h2>

<table  width="500">
    <thead>
        <tr>
            <th>Raiting</th>
            <th>Name</th>
            <th>Total Score</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php foreach ($scores as $score): ?>        
            <tr>
                <td><?= $score['raiting'] ?></td>
                <td><?= $score['player'] ?></td>
                <td><?= $score['score'] ?></td>
            </tr>
        <?php endforeach; ?>    
    </tbody>
</table>