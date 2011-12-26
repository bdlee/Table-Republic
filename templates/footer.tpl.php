
     <div id="doobleline"></div>
<!-- header -->
<header>
	<div id="topline">
 	<div class="wrap">
  	<a href="#" id="logotype"><img src="<?= IMG_PATH ?>/logotype.gif" /></a>
   <nav>
    <menu>
     <li><a href="#">about tr</a></li>
     <li><a href="#">blog</a></li>
     <li><a href="#">follow tr</a></li>
    </menu>
   </nav>
   <div id="usermenu">
    <? if(isset($user)): ?>
	   <img src="<?= IMG_PATH ?>/user_icon.jpg" />
    <menu>
     <li>hi <?= $user->fname; ?>!</li>
     <li><a href="#">My Account</a></li>
     <li><a href="/logout.php">sign out</a></li>
    </menu>
    <? endif; ?>
   </div>
  </div>
 </div>
<?
    if(!empty($includeSearch))
        include('search.tpl.php');
?>

</header>
<!-- end header -->

<!-- footer -->
<footer>
	<div class="wrap">
 <!-- footer column -->
  <div class="footercolumn">
   <h3>Invite a Friend </h3>
   <p>Get a friend to join and receive a round of complimentary drinks or hor d'oeurves on your next group reservation!</p>
   <form action="#" method="post">
    <div id="inviteborder">
     <input type="text" id="inviteinput" value="enter your friend's email address" onfocus="inviteFocus(this);" onblur="inviteBlur(this);"/><div class="btsubmit"><input type="submit" value="Invite" /></div>
    </div>
   </form>
  </div>
 <!-- end footer column -->
 <!-- footer column -->
  <div class="footercolumn">
   <h3>About Table Republic</h3>
   <menu>
   	<li><a href="#">Our 411</a></li>
   	<li><a href="#">Contact Us</a></li>
   	<li><a href="#">Careers</a></li>
   	<li><a href="#">Press</a></li>
   </menu>
  </div>
 <!-- end footer column -->
 <!-- footer column -->
  <div class="footercolumn">
   <h3>Let's be friends</h3>
   <ul>
   	<li id="twitter"><a href="#">Follow us on Twitter</a></li>
   	<li id="facebook"><a href="#">Become a fan on Facebook</a></li>
   	<li id="share"><a href="#">Share This</a></li>
   </ul>
  </div>
 <!-- end footer column -->
 <!-- footer bottom -->
 <div id="footerbottom">
  <span>&reg; Table Republic 2012.</span>
  <nav>
  	<menu>
   	<li><a href="#">Terms of Use</a></li>
    <li><a href="#">FAQ</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Trademark Notice</a></li>
    <li><a href="#">Sitemap</a></li>
   </menu>
  </nav>
 </div>
 <!-- end footer bottom -->
 </div>
</footer>
<!-- end footer -->

<script type="text/javascript">
<? if(isset($debug) && $debug): ?>
var myLogReader = new YAHOO.widget.LogReader('log');
<? endif; ?>
</script>

    </body>
</html>