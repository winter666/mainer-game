<div class="records">
    <div>
        <?= template('tables.result', compact('table')); ?>
    </div>
    <div>
        <?= template('tables.total', compact('scores')); ?>
    </div>
    <?php if (!is_null($event)): ?>
        <div>
            <?= template('tables.event', compact('event')); ?>
        </div>
    <?php endif; ?>    
</div>