<?
    $aTimes = Helpers::getTimes();
    
?>
 <div id="search" class="wrap">
  <form action="" method="get">
   <a href="#" id="clearall" onClick="ClearAll(this);return false;">Clear all</a>
   <h3>Browse our select restaurants for group reservations</h3>
   <ul>
   	<li>
    	<span>1. When is your party?</span>
     <div class="formborder w198"><input type="text" id="formdate" name="date" value="<?= $searchfields['display_date']; ?>" onkeypress="event.preventDefault();" /><span></span></div>
    </li>
    <li>
    	<span>2. When's a good time?</span>
     <div class="formborder w191">
      <select id="formtime" name="time" onchange="selectChange(this)">
       <? foreach($aTimes as $oTime): ?>
        <?
            $t = $oTime->format('G:i');
            if(!isset($selected)) {
                if($searchfields['time'] == $t) {
                    $selected = ' selected';
                }
            } else
                $selected = '';
        ?>
        <option value="<?= $t ?>"<? if(isset($selected)) echo $selected; ?>><?= $oTime->format('g:i a') ?></option>
        <? endforeach; ?>
      </select>
     </div>
    </li>
    <li>
    	<span>3. How many are coming?</span>
     <div class="formborder w184">
      <select id="formnum" name="num" onchange="selectChange(this)">
        <option value=""></option>
        <? $step = 1; ?>
        <? for($i = 6; $i < 200; $i = $i + $step): ?>
        <option value="<?= $i ?>"<? if($searchfields['num'] == $i) echo ' selected'; ?>><?= $i ?></option>
        <? if($i == 20) $step = 5; ?>
        <? if($i == 50) $step = 50; ?>
        <? endfor; ?>
        <option value="200">200+</option>
      </select>
     </div>
    </li>
    <li>
    	<span>4. What's the occasion?</span>
     <div class="formborder w245">
      <select id="formoccasion" name="occasion" onchange="selectChange(this)">
       <option value="-1"></option>
       <option value="1">Birthday Party</option>
       <option value="2">Party</option>
      </select>
     </div>
    </li>
   </ul>
   <div class="btsubmit"><input type="submit" id="action" name="action" value="Search" /></div>
  </form>
 </div>
<script type="text/javascript">
Event.onDOMReady(function() {
    initSearchCalendar();
});
</script>