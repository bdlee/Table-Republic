<?
function pagelist() {
    /*
    <span class="listpage">
    <a href="#" class="go_page">&lt;</a>
    <a href="#" class="go_page">1</a>
    <a href="#" class="go_page">2</a>
    <a href="#" class="go_page">3</a>
    <b class="active">4</b>
    <a href="#" class="go_page">5</a>
    <b class="more">...</b>
    <a href="#" class="go_page">10</a>
    <a href="#" class="go_page">20</a>
    <a href="#" class="go_page">&gt;</a>
   </span>
   <span>Showing 3 of 20 results</span>
    */
?>
   <span class="pagesort">
    <select onchange="selectChange(this);">
     <option value="1">Price High to Low</option>
     <option value="2">Price Low to High</option>
    </select>
   </span>
   <span>Sort By</span>
<?
}
?>
<!-- content -->
<section>
	<div class="wrap">
 	<!-- result items -->
 	<div class="resultitems">
<? foreach($restaurants as $i => $r): ?>
   <!-- item result-->
   <div class="item">
    <h2 class="name"><?= $r->name; ?></h2>
    <!-- information -->
    <div class="information">
     <!-- map column -->
     <div class="map">
      <a href="#"><img src="images/map.jpg" /></a>
      <address>
       <strong>Neighborhood:</strong><br>
       <?= $r->address1; ?><br>
       <?= empty($r->address2) ? '' : $r->address2.'<br>'; ?>
       <?= "{$r->city}, {$r->state} {$r->zip} "; ?>
       <a href="#">view map</a>
      </address>
     </div>
     <!-- end map column -->
     <!-- capacity column -->
     <div class="capacity">
      <strong>Guest Capacity:</strong><br />
      <span>Seats:</span> <?= $r->getMinSeatCapacity(); ?>-<?= $r->getMaxSeatCapacity(); ?> people<br />
      <span>Stands:</span> <?= $r->getMinStandCapacity(); ?>-<?= $r->getMaxStandCapacity(); ?> people
      <a href="#">view table</a>
     </div>
     <!-- end capacity column -->
     <!-- Cuisine -->
     <div class="cuisine">
      <strong>Cuisine:</strong> <?= $r->cuisine; ?><br />
      <strong>Price:</strong> <?= $r->price; ?>
      <a href="#">view menu</a>
     </div>
     <!-- end Cuisine -->
     <?
        $features = $r->getFeatures();
        if(!empty($features)):
     ?>
     <!-- special -->
     <div class="special">
      <strong>Special Features:</strong><br />
      <?
        if(count($features) > 4) {
            $features = array_slice($features, 0, 4);
            echo implode("<br />", $features);
            echo '<br /><a href="#">more</a>';
        } else {
            echo implode("<br />", $features);
        }
      ?>
     </div>
     <!-- end special -->
     <? endif; ?>
    </div>
    <!-- end information -->
    <div class="sharelink"><a href="#"></a></div>
    <!-- photos object -->
    <div class="objectphotos">
     <ul>
      <li>
       <img class="preview" src="/includes/images/test_small_image.gif" width="85" height="48" />
       <img class="bigimage" src="/includes/images/test_bigimage.gif" width="963" height="360" />
      </li>
      <li>
       <img class="preview" src="/includes/images/test_small_image.gif" width="85" height="48" />
       <img class="bigimage" src="/includes/images/test_bigimage.gif" width="963" height="360" />
      </li>
      <li>
       <img class="preview" src="/includes/images/test_small_image.gif" width="85" height="48" />
       <img class="bigimage" src="/includes/images/test_bigimage.gif" width="963" height="360" />
      </li>
      <li>
       <img class="preview" src="/includes/images/test_small_image.gif" width="85" height="48" />
       <img class="bigimage" src="/includes/images/test_bigimage.gif" width="963" height="360" />
      </li>
     </ul>
     <? $banner = $r->getBanner();
     if(!empty($banner)): ?>
     <div class="note"><?= $banner ?></div>
     <? endif; ?>
    </div>
    <!-- end photos object -->
    <form action="#" method="post">
     <!-- detail block -->
     <div class="detail">
      <!-- available block -->
      <div class="available">
       <strong>Available Tables (choose one):</strong><br />
        <? 
            $tables = $r->getTables($searchCriteria);
            foreach($tables as $i => $tbl): 
                $class = ($i % 2 == 0) ? 'roomleft' : 'roomright';
        ?>
            <div class="<?= $class ?>">
                <b><?= $tbl->name ?></b>
                <? if(!empty($tbl->tableMin) && !empty($tbl->tableMax)): ?>
                <input type="radio" name="<?= $r->getId() ;?>"  value="<?= $tbl->getId() ;?>" /><label>Seated: <?= $tbl->tableMin; ?>-<?= $tbl->tableMax; ?> Guests</label>
                <? endif; ?>
                <? if(!empty($tbl->standingMin) && !empty($tbl->standingMax)): ?>
                <input type="radio" name="<?= $r->getId(); ?>"  value="<?= $tbl->getId(); ?>" /><label>Standing: <?= $tbl->standingMin; ?>-<?= $tbl->standingMax; ?> Guests</label>
                <? endif; ?>
            </div>
        <? endforeach ?>
      </div>
      <!-- end available block -->
      <!-- block date and guest-->
      <div class="dateguest">
       <div class="dateparty">
        Your Party Date: <br />
        <span><?= $searchfields['display_date']; ?></span>
       </div>
       <div class="guest">
        Number in Party:
        <span><?= $searchfields['num']; ?> Guests</span>
       </div>
      </div>
      <!-- block date and guest-->
      <!-- party time -->
      <div class="partytime">
       Select Your Party Time:<br />
       <input type="radio" name="timeparty" id="time6_1" value="6" /><label for="time6_1">6pm - 9pm</label>
       <input type="radio" name="timeparty" id="time9_1" value="9" /><label for="time9_1">9pm - 12pm</label>
       <input type="radio" name="timeparty" id="timeother_1" value="0" /><label for="timeother_1">Other</label>
      </div>
      <!-- end party time -->
      <div class="cls"></div>
     </div>
     <!-- end detail block -->
     <!-- bottom block -->
     <div class="bottomitem">
        <a href="/restaurant.php?id=<?= $r->getId() . '&' . $_SERVER['QUERY_STRING']; ?>" class="showdetails">view details</a>
        <a href="#" class="reservenow" onclick="showDetail(this);return false;">reserve now</a>
     </div>
     <!-- end bottom block -->
    </form>
   </div>
   <!-- end item result-->
<? endforeach; ?>
	 </div>
 	<!-- end result items -->
  <!-- page list bottom -->
  <div class="pages">
   <? pagelist() ?>
  </div>
  <!-- end page list bottom -->
 </div>
 <!-- page list top -->
 <div class="pages toppages">
 	<div class="wrap">
   <? pagelist() ?>
  </div>
 </div>
 <!-- end page list top -->
</section>
<!-- end content -->

<script type="text/javascript">
// <![CDATA[
(function() {

function initRestaurant() {
}

Event.onDOMReady(function() {
    initRestaurant();
});

})();
// ]]>
</script>

