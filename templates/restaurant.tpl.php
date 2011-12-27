
<!-- content -->
<section>
	<div id="top" class="wrap">
   <!-- item -->
   <div class="item">
    <? /*
    <div class="objectnavigation">
     <a href="#" class="prevnextobject">&lt; previous</a><a href="#" class="prevnextobject">next &gt;</a><br />
     <span>2. balthazar</span>
    </div>
    */ ?>
    <h1><?= $restaurant->name; ?></h1>
    <!-- information -->
    <div class="infomation">
     <!-- map column -->
     <div class="map">
      <a href="#"><img src="<?= IMG_PATH ?>/map.jpg" /></a>
      <address>
       <?= $restaurant->address1; ?><br>
       <?= empty($restaurant->address2) ? '' : $restaurant->address2.'<br>'; ?>
       <?= "{$restaurant->city}, {$restaurant->state} {$restaurant->zip} "; ?><br />
       (212) 374-1135 
       <a href="#">view map</a>
      </address>
     </div>
     <!-- end map column -->
     <!-- capacity column -->
     <div class="capacity">
      <strong>Guest Capacity:</strong><br />
      <span>Seats:</span> <?= $restaurant->getMinSeatCapacity(); ?>-<?= $restaurant->getMaxSeatCapacity(); ?> people<br />
      <span>Stands:</span> <?= $restaurant->getMinStandCapacity(); ?>-<?= $restaurant->getMaxStandCapacity(); ?> people
      <a href="#">view table</a>
     </div>
     <!-- end capacity column -->
     <!-- Cuisine -->
     <div class="cuisine">
      <strong>Cuisine:</strong> <?= $restaurant->cuisine; ?><br />
      <strong>Price:</strong> <?= $restaurant->price; ?>
      <a href="#">view menu</a>
     </div>
     <!-- end Cuisine -->
     <?
        $features = $restaurant->getFeatures();
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
        <a href="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/banner.jpg" rel="lightbox[group]"><img class="preview" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/banner.jpg" width="85" height="48" /></a>
       <img class="bigimage" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/banner.jpg" width="963" height="360" />
      </li>
      <li>
       <a href="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/big_image_demo2.jpg" rel="lightbox[group]"><img class="preview" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_small_image.gif" width="85" height="48" /></a>
       <img class="bigimage" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="963" height="360" />
      </li>
      <li>
       <a href="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/big_image_demo3.jpg" rel="lightbox[group]"><img class="preview" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_small_image.gif" width="85" height="48" /></a>
       <img class="bigimage" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="963" height="360" />
      </li>
      <li>
       <a href="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/big_image_demo4.jpg" rel="lightbox[group]"><img class="preview" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_small_image.gif" width="85" height="48" /></a>
       <img class="bigimage" src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="963" height="360" />
      </li>
     </ul>
     <? $banner = $restaurant->getBanner();
     if(!empty($banner)): ?>
     <div class="note"><?= $banner ?></div>
     <? endif; ?>
    </div>
    <!-- end photos object -->
    <form action="#" method="post">
     <!-- detail block -->
     <div class="detail">
     	<h2>make your group reservation</h2>
      <!-- available block -->
      <div class="available">
       <strong>Available Tables (choose one):</strong><br />
        <? 
            $tables = $restaurant->getTables($searchCriteria);
            foreach($tables as $i => $tbl): 
                $class = ($i % 2 == 0) ? 'roomleft' : 'roomright';
        ?>
            <div class="<?= $class ?>">
                <b><?= $tbl->name ?></b>
                <? if(!empty($tbl->tableMin) && !empty($tbl->tableMax)): ?>
                <input type="radio" name="<?= $restaurant->getId() ;?>"  value="<?= $tbl->getId() ;?>" /><label>Seated: <?= $tbl->tableMin; ?>-<?= $tbl->tableMax; ?> Guests</label>
                <? endif; ?>
                <? if(!empty($tbl->standingMin) && !empty($tbl->standingMax)): ?>
                <input type="radio" name="<?= $restaurant->getId(); ?>"  value="<?= $tbl->getId(); ?>" /><label>Standing: <?= $tbl->standingMin; ?>-<?= $tbl->standingMax; ?> Guests</label>
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
       <p>Bachelorette party or a parent's anniversary?<br /> If you have any <b>special requests,</b> just let us know.</p>
      </div>
      <!-- end party time -->
      <div class="cls"></div>
     </div>
     <!-- end detail block -->
     <!-- nav block -->
     <nav id="pagemenu">
     	<menu>
      	<li><a href="#photos">photos</a></li>
       <li><a href="#menu">menu</a></li>
       <li><a href="#map">map</a></li>
       <li><a href="#top">top</a></li>
      </menu>
      <input type="submit" value="reserve now" />
     </nav>
     <!-- end nav block -->
    </form>
    <!-- details block -->
    <div id="photos" class="note">
     <p>
     <img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_small_image.gif" width="425" height="360" align="right" style="margin-left:50px; margin-bottom:40px;" />
     <?= $restaurant->getDetails(); ?>
     </p>
     <img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_small_image.gif" width="960" height="360" />
    </div>
    <!-- end details block -->
    <!-- space block-->
    <? $spacetext = $restaurant->getSpaceDetails();
        if(!empty($spacetext)): ?>
    <div class="note">
    	<h2>Todd english's crossbar: the space</h2>
     <img src="<?= IMG_PATH ?>/test_small_image.gif" width="485" height="600" style="margin-right:40px; margin-bottom:20px;" align="left" />
     <h3>Todd English's Crossbar</h3>
     <p><?= $restaurant->getSpaceDetails(); ?></p>
     <div class="noteimgsmall">
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     </div>
     <p>Main Dining Room - Seats up to 40 / Standing 70</p>
     <img src="<?= IMG_PATH ?>/test_small_image.gif" width="960" height="360" />
     <p>Private Room - Seats up to 60 / Standing 90</p>
    </div>
    <? endif; ?>
    <!-- end space block -->
    <!-- food block -->
    <? $foodtext = $restaurant->getFoodDetails();
        if(!empty($foodtext)): ?>
    <div class="note">
	    <h2>Todd english's crossbar: the food</h2>
      <img src="<?= IMG_PATH ?>/test_small_image.gif" width="485" height="600" style="margin-right:40px; margin-bottom:20px;" align="left" />
	     <h3 style="float:left; margin-right:20px;">Sed ut perspiciatis</h3>
      <p><?= $restaurant->getFoodDetails(); ?></p>
     <div class="noteimgsmall">
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     	<img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" width="210" height="140" />
     </div>
     <p>Lorem ipsum dolor sit amet</p>
    </div>
    <? endif; ?>
    <!-- end food block -->
    <!-- group block -->
    <? $grouptext = $restaurant->getGroupDetails();
        if(!empty($grouptext)): ?>
    <div class="note">
	    <h2>WHY WE THINK IT'S GREAT FOR GROUPS</h2>
     <img src="<?= IMG_PATH ?>/assets/<?= $restaurant->getId(); ?>/test_bigimage.gif" height="250" width="435" align="right" style="margin-left:40px;"/>
	     <h3 style="float:left; margin-right:20px;">Sed ut perspiciatis</h3>
      <p><?= $restaurant->getGroupDetails(); ?></p>
    </div>
    <? endif; ?>
    <!-- end group block -->
    <!-- menu block -->
    <div id="menu" class="note">
    	<h2>TODD English's crossbar: the menu</h2>
    	<div class="menutop">
      <div class="menubody">
      	<!-- left column menu -->
       <div class="leftcolumn">
       	<menu>
	        <li><a href="#">brunch</a></li>
         <li><a href="#">dinner</a></li>
         <li class="active"><a href="#">private dining</a></li>
        </menu>
        <div class="cls"></div>
	       <!-- brunch -->
        <div id="brunch">

         <h4>Three - Course Seated Dinner - $55 per person</h4>
 
         <h5>First Course</h5>
         <p><strong>Green Market Salad</strong><br />Polenta Croutons, Herb Vinaigrette</p>
 
         <h5>Second Course (Choose one)</h5>
         <p><strong>Spit Roasted Chicken</strong><br /> Marbled Potatoes, Shaved Fennel, Bourbon Glaze</p>
         <p><strong>Loaded Gnocchi </strong><br />Romanesco Broccoli, Aged Cheddar, Bacon</p>
         <p><strong>Grilled Cobia</strong><br />Charred Tomato, Corn, Chorizo</p>
         <h5>Dessert</h5>
         <p><strong>Assorted Sorbet Plate</strong></p>
 
         <h4>Three - Course Seated Dinner - $65 per person</h4>
 
         <h5>First Course</h5>
         <p><strong>Green Market Salad</strong><br />Polenta Croutons, Herb Vinaigrette</p>
         <p><strong>Burrata Cheese</strong><br />Heirloom Tomatoes, Olive Oil, Saba</p>
 
         <h5>Second Course (Choose one)</h5>
         <p><strong>Spit Roasted Chicken</strong><br />Marbled Potatoes, Shaved Fennel, Bourbon Glaze</p>
         <p><strong>Crispy Pork Belly</strong><br />Curry, Cucumber, Cilantro</p>
         <p><strong>Loaded Gnocchi</strong><br />Romanesco Broccoli, Aged Cheddar, Bacon</p>
         <p><strong>Market Fish</strong><br />Seasonally Inspired</p>
 
         <h5>Dessert</h5>
         <p><strong>Assorted Sorbet Plate</strong></p>
 
         <h4>Four - Course Seated Dinner - $85 per person</h4>
 
         <h5>First Course</h5>
         <p><strong>Green Market Salad</strong><br />Polenta Croutons, Herb Vinaigrette</p>
         <p><strong>Tuna Tartar</strong><br />Puffed Rice, Cucumber</p>
 
         <h5>Second Course (Choose one)</h5>
         <p><strong>Loaded Gnocchi</strong><br />Romanesco Broccoli, Aged Cheddar, Bacon</p>
         <p><strong>Seared Day Boat Scallops</strong><br />Fregola, Asparagus, Sorrel</p>
 
         <h5>Third Course (Choose one)</h5>
         <p><strong>Spit Roasted Chicken</strong><br />Marbled Potatoes, Shaved Fennel, Bourbon Glaze</p>
         <p><strong>New York Strip Steak</strong><br />Marbled Potatoes, Horseradish Crema</p>
         <p><strong>Market Fish</strong><br />Seasonally Inspired</p>
 
         <h5>Dessert</h5>
         <p><strong>Assorted Sorbet Plate</strong></p>
        </div>
        <!-- brunch-->
      </div>
      	<!-- end left column menu -->
      	<!-- rigth column menu -->
       <div class="rightcolumn">
       	<menu>
        	<li><a href="#">cocktails</a></li>
         <li class="active"><a href="#">wine</a></li>
         <li><a href="#">spirits</a></li>
        </menu>
        <div class="cls"></div>
        <menu class="submenu" id="submenuwine">
        	<li class="active"><a href="#">white</a></li>
         <li><a href="#">RED</a></li>
        </menu>
        <div class="cls"></div>
        <!-- wine -->
        <div id="wine">
         <!-- wine white -->
         <div id="white">
          <h4>Old Testament White</h4>
          <p><strong>Domaine Pierre Morey,</strong> Saint-Aubin Blanc 1er Cru, 2007 Burgundy, France 104</p>
          <p><strong>JEAN-MARC MOREY,</strong> 'Morgeot', Chassagne-Montrachet 1er Cru, 2008 Burgundy, France 144</p>
          <p><strong>JEAN-PAUL & BENOIT DROIN,</strong> '1er Cru Vaillons', Chablis, 2008 Burgundy, France 70</p>
          <p><strong>MAISON CHAMPY,</strong> Pernand-Vergelesses, 2008 Burgundy, France 65</p>
          <p><strong>DIDIER CHAMPALOU,</strong> 'Vouvray Cuvee Fondraux', Chenin Blanc, 2008 Loire Valley, France 52</p>
          <p><strong>FLORIAN MOLLET,</strong> 'Roc De L'Abbaye' Sancerre, 2009 Loire Valley, France 60</p>
          <p><strong>M. CHAPOUTIER,</strong> 'Petite Ruche', Crozes-Hermitage, 2007 Rhone Valley, France 68</p>
          <p><strong>S.A. PRUM,</strong> 'Essence', Riesling, 2009 Mosel, Germany 40</p>
          <p><strong>BOTTEGA VINAIA,</strong> Pinot Grigio, 2009 Trentino, Italy 42</p>
  
          <h4>New Testament White</h4>
          <p><strong>Chateau des charmes,</strong> Riesling, 2008 Ontario, Canada 40</p>
          <p><strong>Kumeu River,</strong> 'Hunting Hill', Chardonnay, 2007 Kumeu, New Zealand 92</p>
          <p><strong>Uva Mira,</strong> Sauvignon Blanc, 2009 Stellenbosch, South Africa 52</p>
          <p><strong>Patz & Hall,</strong> 'Hyde Vineyard', Chardonnay, 2007 Cameros-Napa Valley, CA 116</p>
          <p><strong>Selene,</strong> 'Hyde Vineyard', Sauvignon Blanc, 2009 Cameros-Napa Valley, CA 70</p>
          <p><strong>Flora Springs,</strong> Chardonnay, 2009 Napa Valley, CA 54</p>
          <p><strong>Groth Vineyards,</strong> Chardonnay, 2008 Oakville, CA 76</p>
          <p><strong>J Vineyards,</strong> Pinot Gris, 2009 Russian River Valley, CA 46</p>
          <p><strong>Elk Cove,</strong> Pinot Gris, 2009 Willamette Valley, OR 44</p>
          <p><strong>Ponzi Vineyards,</strong> 'Rosato', Pinot Noir 2009 Wilamette Valley, OR 52</p>
         </div>
         <!-- wine white -->
        </div>
        <!-- end wine -->
       </div>
      	<!-- end rigth column menu -->
       <div class="menubottom"></div>
      </div>
     </div>
    <!-- end menu block -->
    	<div class="specialcoock">
     	<h2>todd english's crossbar specials: </h2>
      <!-- left column -->
      <div class="leftcolumn">
      	<h3>suckling pig dinner</h3>
       <h4>Three-Course Seated Dinner</h4>

       <h5>First Course</h5>
							<p><strong>Green Market Salad</strong><br />Polenta Croutons, Herb Vinaigrette</p>

       <h5>Second Course</h5>
       <p><strong>The PIG -</strong> Spit Roasted Suckling Pig</p>

       <h5>Sauces</h5>
       <p>Romesco sauce, Korean BBQ, Chimichurri</p>

       <h5>Sides</h5>
       <p>Pork Fat Roasted Fingerling Potatoes</p>
       <p>Pickled Vegetables</p>
       <p>Coleslaw</p>

       <h5>Dessert</h5>
       <p><strong>Pecan Bacon Pie</strong><br /> whiskey-caramel ice cream</p>

       <h5>Pricing</h5>
       <p>$400 flat charge and $50/per person over 8 people<br />Requires 48 hour notice.</p>
	     </div>
      <!-- end left column -->
      <!-- rigth column -->
      <div class="rightcolumn">
      	<h3>HORS D'oEuvre selections</h3>
       <p>
       	<strong>Puffed Pig's Ears -</strong> black lime, smoked paprika<br />
       	<strong>PopCorn -</strong> bacon, cheddar, chives<br />
        <strong>Lobster Guacamole -</strong> tortilla with chipotle aioli<br />
        <strong>Pulled Pork Bites - </strong>BBQ pork, crispy polenta<br />
        <strong>Bacon Jam -</strong> John Boy bacon, maple, coffee<br />
        <strong>Beets and Goat Cheese -</strong> marcona almonds<br />
        <strong>Tuna Tartar -</strong> tortilla with black bean and spicy aioli<br />
        <strong>Chicken Mole -</strong> tortilla with queso fresco and radish<br />
        <strong>BBQ Pork -</strong> tortilla with hominy relish and cilantro<br />
        <strong>Grilled Scallop -</strong> chorizo sauce<br />
        <strong>Mini Cubano Sandwich - </strong>tasso ham, roasted shoulder, pickles, provolone<br />
        <strong>White Gazpacho - </strong>crab<br />
        <strong>Mini Bratwurst -</strong> pretzel roll, spicy mustard
       </p>
       <h5>Pricing</h5>
       <p>
       	<strong>Choice of 3 -</strong> $35 per person per hour<br />
        <strong>Choice of 6 -</strong> $45 per person per hour<br />
        **Please note we can only make minor modifications to menu items.  All modifications will be made to accommodate allergies and additional vegetarian options to be offered upon request.** 
       </p>
      </div>
      <!-- end rigth column -->
      <div class="cls"></div>
    </div>
   </div>
   <!-- end block group -->
   <!-- location -->
   <div id="map" class="note">
    <h2>todd english's crossbar: the location</h2>
     <address>
      <strong>Neighborhood:</strong> Flatiron <br />135 West Broadway<br /> New York, NY <br />(212) 374-1135 
     </address>
   <? /* Google Map
     <img src="<?= IMG_PATH ?>/test_small_image.gif" width="960" height="450" />
   */ ?>
   </div>
   <!-- end location -->
   <div class="note">
    <h1 class="noborder">todd english's crossbar</h1>
    <form action="#" method="post">
     <!-- detail block -->
     <div class="detail">
      <h2>make your group reservation</h2>
      <!-- available block -->
      <div class="available">
       <strong>Available Tables (choose one):</strong><br />
       <div class="privateroom">
        <b>Private Room</b>
        <input type="radio" name="typeroom" id="place20_2" value="private20" /><label for="place20_2">Seated: 24-50 Guests</label>
        <input type="radio" name="typeroom" id="place70_2" value="private70" /><label for="place70_2">Standing: 70 Guests</label>
       </div>
       <div class="mainroom">
        <b>Main Room</b>
        <input type="radio" name="typeroom" id="place12_2" value="main12" /><label for="place12_2">Seated: 12-20 Guests</label>
        <input type="radio" name="typeroom" id="place40_2" value="main40" /><label for="place40_2">Standing: 40 Guests</label>
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
       <input type="radio" name="timeparty" id="time6_2" value="6" /><label for="time6_2">6pm - 9pm</label>
       <input type="radio" name="timeparty" id="time9_2" value="9" /><label for="time9_2">9pm - 12pm</label>
       <input type="radio" name="timeparty" id="timeother_2" value="0" /><label for="timeother_2">Other</label>
       <p>Bachelorette party or a parent's anniversary?<br /> If you have any <b>special requests,</b> just let us know.</p>
      </div>
      <!-- end party time -->
      <div class="cls"></div>
     </div>
     <!-- end detail block -->
     <!-- bottom block -->
     <div class="bottomitem"><input type="submit" value="reserve now" /></div>
     <!-- end bottom block -->
    </form>
   </div>
   <!-- footer information -->
   <div class="note footernote">
    <div class="objectnavigation">
     <a href="#" class="pervnextobject">&lt; previous</a><a href="#" class="pervnextobject">next &gt;</a><br />
     <span>2. balthazar</span>
    </div>
				<p>Not quite what you're looking for? try the next restaurant<br />or <a href="#">contact us</a> and tell us what you want.</p>
   </div>
   <!-- end footer information -->
  </div>
  <!-- END ITEM--> 
 </div>
</section>

<script type="text/javascript">
// <![CDATA[
(function() {

})();
// ]]>
</script>
<!-- end content -->
