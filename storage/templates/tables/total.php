<h2>Total Score</h2>

<table  width="500">
    <thead>
        <tr>
            <th>Name</th>
            <th>Total Score</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php foreach ($scores as $player => $score): ?>        
            <tr>
                <td><?= $player ?></td>
                <td><?= $score ?></td>
            </tr>
        <?php endforeach; ?>    
    </tbody>
</table>