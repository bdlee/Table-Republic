
<? /*
<div class="leftSide">
    This is a side nav
</div>
*/ ?>
<div class="results">
<? foreach($restaurants as $r): ?>
<a href="/restaurant.php?id=<?= $r->getId(); ?>">
<div class="restaurant">
    <div class="name"><?= $r->name; ?></div>
    <div class="tables" style="display:none;">
        <div class="tblbackground"></div>
        <div class="content">
        <? $tables = $r->getTables($fields);
            foreach($tables as $i => $tbl): ?>
            <div class="tbl" <?= ($i < 3) ? '' : 'style="display:none;"'; ?>>
                <?= $tbl->getDisplayDate() ?><br />
                <?= $tbl->getDisplayTime() ?>
            </div>
        <? endforeach ?>
        </div>
    </div>
    <div class="background" style="background-image:url('<?= IMG_PATH . '/assets/' .$r->getId(); ?>/banner.jpg');"></div>
    <div class="clear"></div>
</div>
</a>
<? endforeach; ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
// <![CDATA[

function initRestaurant() {
}

Event.onDOMReady(function() {
    initRestaurant();
});

// ]]>
</script>

