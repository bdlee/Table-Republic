<?
    $this->display('header');
?>
<div class="sideNav">
    This is a side nav
</div>
<div class="results">
<? foreach($restaurants as $r): ?>
<a href="/restaurant.php?id=<?= $r->getId(); ?>">
<div class="restaurant">
    <div class="name"><?= $r->name; ?></div>
    <div class="tables" style="display:none;">
        <div class="tblbackground"></div>
        <div class="content">
        <? $tables = $r->getTables();
            foreach($tables as $i => $tbl): ?>
            <div class="tbl" <?= ($i < 3) ? '' : 'style="display:none;"'; ?>>
                <?= $tbl->getDisplayDate() ?><br />
                <?= $tbl->getDisplayTime() ?>
            </div>
        <? endforeach ?>
        </div>
    </div>
    <div class="background" style="background-image:url('/assets/<?= $r->getId(); ?>/banner.jpg');"></div>
    <div class="clear"></div>
</div>
</a>
<? endforeach; ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
// <![CDATA[
        
var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var Connect = YAHOO.util.Connect;

function initRestaurant() {
}

Event.onDOMReady(function() {
    initRestaurant();
});

// ]]>
</script>


<?
    $this->display('footer');
?>