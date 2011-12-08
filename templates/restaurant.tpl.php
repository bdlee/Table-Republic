<div class="restaurantName"><?= $restaurant->name ?></div>
<div class="restaurantDescription"><?= $restaurant->description ?></div>
<div class="tables">
    <? foreach($restaurant->getTables() as $table): ?>
    <div class="table">
    <pre><? print_r($table) ?></pre>
    </div>
    <? endforeach; ?>
</div>
