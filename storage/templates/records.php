<div class="records">
    <div>
        <?= template('tables.result', compact('players', 'table')); ?>
    </div>
    <div>
        <?= template('tables.total', compact('scores')) ?>
    </div>
</div>