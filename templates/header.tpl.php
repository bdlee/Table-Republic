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
        "/includes/css/core.css",
        "/includes/css/search.css",
        "/includes/css/smoothness/jquery-ui-1.8.16.custom.css",
        "/includes/css/jquery.lightbox-0.5.css",
        YUI_LIB."/fonts/fonts-min.css",
        YUI_LIB."/button/assets/skins/sam/button.css",
        YUI_LIB."/container/assets/skins/sam/container.css",
        YUI_LIB."/calendar/assets/skins/sam/calendar.css"
    );
    $coreJs = array(
        YUI_LIB."/yahoo/yahoo-min.js",
        YUI_LIB."/dom/dom-min.js",
        YUI_LIB."/event/event-min.js",
        YUI_LIB."/connection/connection-min.js",
        YUI_LIB."/event-mouseenter/event-mouseenter-min.js",
        YUI_LIB."/container/container-min.js",
        YUI_LIB."/element/element-min.js",
        YUI_LIB."/button/button-min.js",
        YUI_LIB."/container/container-min.js",
        YUI_LIB."/calendar/calendar-min.js",
        "/includes/js/jquery-1.6.2.min.js",
        "/includes/js/jquery-ui-1.8.16.custom.min.js",
        "/includes/js/jquery.mSelect.min.js",
        "/includes/js/tools.js",
        "/includes/js/jquery.lightbox-0.5.pack.js",
//        "/includes/js/cufon/cufon.js",
//        "/includes/js/cufon/Duality_400.font.js",
//        "/includes/js/cufon/OptimusPrinceps_500.font.js",
        "/includes/js/core.js.php"
    );
    if (file_exists(dirname(__FILE__) . "/../html/includes/css/$page.css")) {
        $coreCss[] = "/includes/css/$page.css";
    }
    if (file_exists(dirname(__FILE__) . "/../html/includes/js/$page.js")) {
        $coreJs[] = "/includes/js/$page.js";
    }
    
    $css = array_merge($coreCss, (array) $css);
    $js  = array_merge($coreJs, (array) $js);

    if(empty($includeSearch))
        $css[] = '/includes/css/nosearch.css';
    
    if(!isset($title)) {
        $title = "RSVP";
    }
    
    // set the header menu items
    $baseMenu = array(
        'about' => array(
            'label' => 'About',
            'href' => '/about.php'
        )
    );
    if($user = Authenticator::getUser()) {
        $headerMenu = array_merge($baseMenu, array(
            'welcome' => array(
                'label' => 'Welcome ' . $user->fname
            ),
            'logout' => array(
                'label' => 'Logout',
                'href' => '/logout.php'
            )
        ));
    } else {
        $headerMenu = array_merge($baseMenu, array(
            'login' => array(
                'label' => 'Login',
                'href' => '/login.php'
            )
        ));
    }
    
    
    header("P3P: CP=\"NOI DSP COR NID CURa ADMa DEVa PSAo PSDo OUR BUS COM NAV\"");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="og:title" content="<?php echo $title; ?>" /> 
    <!-- CSS -->
<?php foreach ($css as $href): ?>
    <link href="<?php echo $href ?>" rel="stylesheet" type="text/css" />
<?php endforeach ?>

<!--[if lt IE 9]> 
 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/ielt9.css"/>
<![endif]-->
<!--[if lt IE 8]> 
	<link rel="stylesheet" type="text/css" href="css/ielt8.css"/>
<![endif]-->

<?php if (isset($ico)): ?>
    <!-- icon -->
    <link href="<?php echo $ico ?>" rel="shortcut icon" type="image/x-icon" />
<?php endif ?>
    
<?php foreach ($js as $href): ?>
    <script src="<?php echo $href ?>"></script>
<?php endforeach ?>
    <script type="text/javascript">
        var Dom = YAHOO.util.Dom;
        var Event = YAHOO.util.Event;
        var Connect = YAHOO.util.Connect;
    </script>
  </head>
  <body class="yui-skin-sam">


    <div id="mainContent">