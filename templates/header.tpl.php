<?php 
    if(Authenticator::authenticated()) {
        $user = Authenticator::getUser();
    }

    if(!isset($css)) {
        $css = array();
    }
    if(!isset($js)) {
        $js = array();
    }
    
    $coreCss = array(
        "/includes/css/core.css.php"
    );
    $coreJs = array(
        "/includes/js/yui/build/yahoo/yahoo-min.js",
        "/includes/js/yui/build/dom/dom-min.js",
        "/includes/js/yui/build/event/event-min.js",
        "/includes/js/yui/build/connection/connection-min.js",
        "/includes/js/yui/build/event-mouseenter/event-mouseenter-min.js",
        "/includes/js/jquery-1.5.2.min.js",
        "/includes/js/cufon/cufon.js",
        "/includes/js/cufon/Duality_400.font.js",
        "/includes/js/cufon/OptimusPrinceps_500.font.js",
        "/includes/js/core.js"
    );
    
    if (file_exists(dirname(__FILE__) . "/../html/includes/css/$page.css")) {
        $coreCss[] = "/includes/css/$page.css";
    }
    if (file_exists(dirname(__FILE__) . "/../html/includes/js/$page.js")) {
        $coreJs[] = "/includes/js/$page.js";
    }
    if (file_exists(dirname(__FILE__) . "/../html/images/$page.ico")) {
        $ico = "/images/$page.ico";
    }
    
    $css = array_merge($coreCss, (array) $css);
    $js  = array_merge($coreJs, (array) $js);

    if(!isset($title)) {
        $title = "RSVP";
    }
    
    header("P3P: CP=\"NOI DSP COR NID CURa ADMa DEVa PSAo PSDo OUR BUS COM NAV\"");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:meebo="http://www.meebo.com/">

  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="og:title" content="<?php echo $title; ?>" /> 
    <!-- CSS -->
<?php foreach ($css as $href): ?>
    <link href="<?php echo $href ?>" rel="stylesheet" type="text/css" />
<?php endforeach ?>
    
<?php if (isset($ico)): ?>
    <!-- icon -->
    <link href="<?php echo $ico ?>" rel="shortcut icon" type="image/x-icon" />
<?php endif ?>
    
<?php foreach ($js as $href): ?>
    <script src="<?php echo $href ?>"></script>
<?php endforeach ?>
  </head>
  <body class="yui-skin-sam">
    <div id="header">
        <div id="headerContent">
        <span class="title"><a href="/"><img src="/includes/images/tr_logo.png" width="250" /></a></span>
        <ul class="headerMenu">
            <? if(@$user): ?>
            <li>Welcome <?= $user->fname; ?></li>
            <li>Settings</li>
            <li><a href="/logout.php">Logout</a></li>
            <? else: ?>
            <li>About</li>
            <li><a href="/login.php">Login</a></li>
            <? endif; ?>
        </ul>
        <div class="clear"></div>
        </div>
    </div>
    <div id="mainContent">
 