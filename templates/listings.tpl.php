
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
      <span>Seats:</span> 20-30 people<br />
      <span>Stands:</span> 40-60 people
      <a href="#">view table</a>
     </div>
     <!-- end capacity column -->
     <!-- Cuisine -->
     <div class="cuisine">
      <strong>Cuisine:</strong> American<br />
      <strong>Price:</strong> $$$
      <a href="#">view menu</a>
     </div>
     <!-- end Cuisine -->
     <!-- special -->
     <div class="special">
      <strong>Special Features:</strong><br />
      Good for Holiday Parties<br />
      Good for Birthdays<br />
      Private Room Available<br />
      No Minimum Charge
     </div>
     <!-- end special -->
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
     <div class="note">Lorem Ipsum: Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</div>
    </div>
    <!-- end photos object -->
    <form action="#" method="post">
     <!-- detail block -->
     <div class="detail">
      <!-- available block -->
      <div class="available">
       <strong>Available Tables (choose one):</strong><br />
       <div class="privateroom">
        <b>Private Room</b>
        <input type="radio" name="typeroom" id="place20_1" value="private20" /><label for="place20_1">Seated: 24-50 Guests</label>
        <input type="radio" name="typeroom" id="place70_1" value="private70" /><label for="place70_1">Standing: 70 Guests</label>
       </div>
       <div class="mainroom">
        <b>Main Room</b>
        <input type="radio" name="typeroom" id="place12_1" value="main12" /><label for="place12_1">Seated: 12-20 Guests</label>
        <input type="radio" name="typeroom" id="place40_1" value="main40" /><label for="place40_1">Standing: 40 Guests</label>
       </div>
      </div>
      <!-- end available block -->
      <!-- block date and guest-->
      <div class="dateguest">
       <div class="dateparty">
        Your Party Date: <br />
        <span>December 28, 2011</span>
       </div>
       <div class="guest">
        Number in Party:
        <span>14 Guests</span>
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
     <div class="bottomitem"><a href="#" class="showdetails" onclick="showDetail(this);return false;">view details</a><input type="submit" value="reserve now" /></div>
     <!-- end bottom block -->
    </form>
   </div>
   <!-- end item result-->
<? endforeach; ?>
	 </div>
 	<!-- end result items -->
  <!-- page list bottom -->
  <div class="pages">
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
   <span class="pagesort">
    <select onchange="selectChange(this);">
     <option value="1">Price High to Low</option>
     <option value="2">Price Low to High</option>
    </select>
   </span>
   <span>Sort By</span>
  </div>
  <!-- end page list bottom -->
 </div>
 <!-- page list top -->
 <div class="pages toppages">
 	<div class="wrap">
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
   <span class="pagesort">
    <select onchange="selectChange(this);">
     <option value="1">Price High to Low</option>
     <option value="2">Price Low to High</option>
    </select>
   </span>
   <span>Sort By</span>
  </div>
 </div>
 <!-- end page list top -->
</section>
<!-- end content -->

<script type="text/javascript">
// <![CDATA[

function initRestaurant() {
}

Event.onDOMReady(function() {
    initRestaurant();
});

// ]]>
</script>

