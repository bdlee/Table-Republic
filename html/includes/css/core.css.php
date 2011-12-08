<?
    header('Content-type: text/css');

    $color = '#000';
    $linkColor = '#3366FF';
    $borderColor = '#FFF';
    $restaurantColor = '#000';
    $backgroundColor = '#FFF';
    $headerBackgroundColor = '#000';
    $headerColor = '#FFF';
?>

body{
    padding: 0;
    margin: 0;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    color: <?= $color ?>;
    margin: auto;
    background: <?= $backgroundColor ?>;
}
a {
    color: <?= $linkColor ?>;
    font-weight: bold;
    text-decoration: none;
}
a img {
    border: none;
}
a:hover {
    text-decoration: underline;
}
img{
    border: none;
}

div#header {
    padding: 10px;
    margin: 0 auto;
    background-color: <?= $headerBackgroundColor ?>;
    color: <?= $headerColor ?>;
}
div#header .title {
    font-size: 24px;
    float: left;
}
div#header ul {
    float:right;
    list-style-type: circle;
    color: <?= $headerColor ?>;
}
div#header ul li {
    display: inline;
    margin-left: 10px;
    padding-right: 10px;
    border-right: 1px solid <?= $headerColor ?>;
}
div#header div#headerContent {
    width: 960px;
    margin: 0 auto;
}

div#mainContent {
    margin: 10px auto;
    width: 960px;
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

div.leftSide {
    border: 1px solid <?= $borderColor ?>;
    width: 186px;
    padding: 0px;
    margin-right: 10px;
    float: left;
}
div.rightSide {
    border: 1px solid <?= $borderColor ?>;
    width: 186px;
    padding: 0px;
    margin-right: 10px;
    float: left;
}
div.results {
    width: 762px;
    float: left;
}

div.results div.restaurant {
    border: 1px solid <?= $borderColor ?>;
    width: 760px;
    height: 224px;
    margin: 0 0 20px 0;
}
div.results div.restaurant div.background {
    width: 760px;
    height: 183px;
}
div.results div.restaurant div.name {
    background-color: <?= $borderColor; ?>;
    color: <?= $restaurantColor; ?>;
    font-size: 24px;
    font-weight: bold;
    padding: 5px;
    height: 31px;
}
div.results div.restaurant div.tables {
    border: 1px solid <?= $borderColor; ?>;
}
div.results div.restaurant div.tables div.resybackground {
    background: #FFF;
    width: 100%;
    height: 100%;
}
div.results div.restaurant div.tables div.content {
}

div.results div.restaurant div.tables div.tbl {
    
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