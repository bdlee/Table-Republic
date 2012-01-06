/* js for restaurant details page */

//self executing function (see end)
(function() {

	var currentBannerSlide = 1,
		bannerSpeed 	   = 300,		// milliseconds
		isBannerAnimating  = false,
		bannerCnnrHeight,
		$v = {};

	/**
	 * Onclick handler for the navigation thumbs on the left of the banner.
	 * Clicking rotates loads the banner image as specified by the href value
	 * of the link, this link is then appended after being loaded and an animation
	 * is played. The speed of the animation can be controlled by the variable
	 * bannerSpeed set above.
	 *
	 * @author Sankho
	 * @Function
	 * @param {Object} e
	 * @private
	 */ 
	function navigateBanner(e) {
		e.preventDefault();

		if (isBannerAnimating) {
			return;
		} else {
			isBannerAnimating = true;
		}

		var $link = $(this);
		var count  = $link.data('eq');

		if (count === currentBannerSlide) {
			isBannerAnimating = false;
			return;
		}

		$v.bannerNav.removeClass('active');
		$link.addClass('active');
		var imgSrc = $link.attr('href');

		var $current    = $v.bannerCnnr.find('img');
		var startingPos = count > currentBannerSlide ? bannerCnnrHeight : bannerCnnrHeight * -1;
		var endingPos   = startingPos * -1;

		var image = new Image();
		image.onload = function() {
			$v.bannerLoader.fadeOut('fast');
			currentBannerSlide = count;
			var $img = $(this);
			$img.addClass('bigimage').css('top', startingPos);
			$img.appendTo($v.bannerCnnr);
			$img.animate({
				top : 0
			}, bannerSpeed);
			$current.animate({
				top : endingPos
			}, bannerSpeed, function() {
				$current.remove();
				isBannerAnimating = false;
			})
		}
		image.src = imgSrc;
		$v.bannerLoader.fadeIn('fast');
	}

	/**
	 * This function will run on DOM ready as specified below. Sets up
	 * all DOM funcitonality for the restaurant details page.
	 *
	 * @author Sankho
	 * @private
	 */
	function init() {
		$v.bannerNav  = $('#banner .banner-nav a');
		$v.bannerCnnr = $('#banner .banner-cnnr');
		$v.bannerLoader = $('#banner .loader');

		bannerCnnrHeight = $v.bannerCnnr.height();

		$v.bannerNav.click(navigateBanner)
	}

	// fires init on DOM ready
	$(init);

}());