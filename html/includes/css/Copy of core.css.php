<?
    header('Content-type: text/css');
    
    function is_ie() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
            return true;
        else
            return false;
    }

    $color = '#333';
    $linkColor = '#3366FF';
    $borderColor = '#333';
    $restaurantColor = '#FFF';
?>

body{
    padding: 0;
    margin: 0;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    color: <?= $color ?>;
    width: 960px;
    margin: auto;
}
a {
    color: <?= $linkColor ?>;
    font-weight: bold;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
img{
    border: none;
}

div#header {
    border: 1px solid <?= $borderColor ?>;
    padding: 10px;
    margin: 10px auto;
    background-color: #333;
    color: white;
}
div#header .title {
    font-size: 24px;
    float: left;
}
div#header ul {
    float:right;
    list-style-type: circle;
    color: #FFF;
}
div#header ul li {
    display: inline;
    margin-left: 10px;
}

div#mainContent {
    margin: 10px 0;
}

div.entryForm {
    border: 1px solid <?= $borderColor ?>;
    padding: 10px;
}
div.entryForm table td.label {
    text-align: right;
}
div.entryForm table td.input{
    text-align: left;
}

div.entryForm input.button {
    border: 1px solid <?= $borderColor ?>;
    background: #CCC;
    padding: 2px 8px;
}

div.sideNav {
    border: 1px solid <?= $borderColor ?>;
    width: 186px;
    padding: 0px;
    margin-right: 10px;
    float: left;
}
div.results {
    float: left;
}

div.results div.restaurant {
    position: relative;
    border: 1px solid <?= $borderColor ?>;
    width: 760px;
    height: 183px;
    margin: 0 0 20px 0;
}
div.results div.restaurant div.background {
    position: relative;
    top: 0px;
    left: 0px;
    width: 760px;
    height: 183px;
    opacity:.4;
    filter:alpha(opacity)=40;
    /* For IE 5.5 - 7*/
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99FFFFFF, endColorstr=#99FFFFFF);
	/* For IE 8*/
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99FFFFFF, endColorstr=#99FFFFFF)";
    <? if(is_ie()): ?>
    background:transparent;
    <? endif; ?>
}
div.results div.restaurant div.name {
    position: absolute;
    top: 0px;
    left: 0px;
    background-color: <?= $borderColor; ?>;
    color: <?= $restaurantColor; ?>;
    font-size: 24px;
    font-weight: bold;
    padding: 5px;
}
div.results div.restaurant div.reservations {
    position: absolute;
    top: 0px;
    right: 0px;
    border: 1px solid <?= $borderColor; ?>;
}
div.results div.restaurant div.reservations div.resybackground {
    position: absolute;
    top: 0;
    left: 0;
    background: #FFF;
    width: 100%;
    height: 100%;
}
div.results div.restaurant div.reservations div.content {
    position: relative;
    top: 0;
    left: 0;
}

div.results div.restaurant div.reservations div.resy {
    
    color: #FFF;
    font-size: 12px;
    font-weight: bold;
    margin: 10px;
    padding: 5px;
    width: 120px;
    height: 30px;
    text-align: center;
    background: #FF6666;
    
}

.alert {
    color: #FF0000;
}

.clear {
    border: none !important;
    padding: 0 !important;
    margin: 0 !important;
    clear: both !important;
}