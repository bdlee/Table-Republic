<?
    $aTimes = Helpers::getTimes();
    
    $defaultDate = new DateTime();
    $defaultDate->add(new DateInterval('P7D'));
    
    $param_display_date   = isset($_GET['display_date']) ? $_GET['display_date'] : $defaultDate->format('l, j F Y');
    $param_date           = isset($_GET['date']) ? $_GET['date'] : $defaultDate->format('m/d/Y');
    $param_time           = isset($_GET['time']) ? $_GET['time'] : '19:00';
    $param_num            = isset($_GET['num']) ? $_GET['num'] : 12;
    
    $fields = array(
        'display_date' => $param_display_date,
        'date' => $param_date,
        'time' => $param_time,
        'num' => $param_num
    );
    
?>
<div id="search">
    <form action="" method="get">
    <table>
        <tr>
            <td>
                <div class="box"> 
                   <div class="datefield"> 
                      <label for="date">Date: </label><input type="text" id="display_date" name="display_date" value="<?= $param_display_date; ?>" readonly />
                      <input type="hidden" id="date" name="date" value="<?= $param_date; ?>" />
                      <button type="button" id="show" title="Show Calendar"><img src="<?= IMG_PATH ?>/calbtn.gif" width="18" height="18" alt="Calendar" ></button> 
                   </div> 
                </div> 
            </td>
            <td><select id="time" name="time">
                <? foreach($aTimes as $oTime): ?>
                <?
                    $t = $oTime->format('G:i');
                    if(!isset($selected)) {
                        if($param_time == $t) {
                            $selected = ' selected';
                        }
                    } else
                        $selected = '';
                ?>
                <option value="<?= $t ?>"<? if(isset($selected)) echo $selected; ?>><?= $oTime->format('g:i a') ?></option>
                <? endforeach; ?>
            </select>
            </td>
            <td><select id="num" name="num">
                <? $step = 1; ?>
                <? for($i = 6; $i < 200; $i = $i + $step): ?>
                <option value="<?= $i ?>"<? if($param_num == $i) echo ' selected'; ?>><?= $i ?></option>
                <? if($i == 20) $step = 5; ?>
                <? if($i == 50) $step = 50; ?>
                <? endfor; ?>
                <option value="200">200+</option>
            </select>
            </td>
            <td>
                <input type="submit" id="action" name="action" value="Search" />
            </td>
        </tr>
    </table>
    </form>
</div>
<script type="text/javascript">
Event.onDOMReady(function() {
    initSearchCalendar();
});
</script>