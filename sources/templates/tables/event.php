<div class="event_result">
    <h2>Event Results</h2> 
    <?php foreach ($event as $eventItem): ?>
        <div class="event_result__data">
            <div class="event_result__data_name"><?= $eventItem['name']; ?></div>
            <div class="event_result__data_total"><?= $eventItem['nominal']; ?> on round <?= $eventItem['round']; ?></div>
        </div>
    <?php endforeach; ?>
</div>