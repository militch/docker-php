<?php

/**
 * Gutenberg Patterns
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( ! is_admin() ) {
	return;
}
if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
	return;
}
function thb_patterns_register_block_patterns() {
	register_block_pattern(
		'restoration/homepage',
		array(
			'title'      => esc_html__( 'Homepage', 'restoration' ),
			'keywords'   => array( 'restoration', 'page' ),
			'categories' => array( 'restoration' ),
			// phpcs:disable
			'content' => '<!-- wp:media-text {"align":"","mediaPosition":"right","mediaId":97,"mediaType":"image","mediaWidth":58,"verticalAlignment":"center","imageFill":true,"style":{"color":{"background":"#f2ece8"}},"className":"has-background"} -->
<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-center is-image-fill has-background has-background" style="background-color:#f2ece8;grid-template-columns:auto 58%"><figure class="wp-block-media-text__media" style="background-image:url(https://restoration.fuelthemes.net/wp-content/uploads/2020/07/hero-1024x776.jpg);background-position:50% 50%"><img src="https://restoration.fuelthemes.net/wp-content/uploads/2020/07/hero-1024x776.jpg" alt="" class="wp-image-97 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"Content…","style":{"typography":{"fontSize":14}}} -->
<p style="font-size:14px">New Arrivals</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1>From indoor to<br>outdoor</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>From reissuing design icons to creating future classics in collaboration with acclaimed international designers, the collection combines craftsmanship.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":112} -->
<div style="height:112px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"color":{"text":"#ffffff","background":"#5a5958"}},"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-text-color has-background" href="https://restoration.fuelthemes.net/shop/" style="background-color:#5a5958;color:#ffffff">Shop collection</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:media-text -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:fuel-themes/thb-iconbox {"uid":"asquared-1594916829449","title":"Easy Assembly","subtitle":"Two People 1 Tool","image":{"uploading":false,"date":1594973451000,"filename":"icon01.png","menuOrder":0,"uploadedTo":16,"type":"image","subtype":"png","id":156,"title":"icon01","url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon01.png","link":"https://restoration.fuelthemes.net/home/icon01/","alt":"","author":"1","description":"","caption":"","name":"icon01","status":"inherit","modified":1594973451000,"mime":"image/png","icon":"https://restoration.fuelthemes.net/wp-includes/images/media/default.png","dateFormatted":"July 17, 2020","nonces":{"update":"624a00d32e","delete":"f0110e6a90","edit":"f1d4404b23"},"editLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=156\u0026action=edit","meta":false,"authorName":"Fuel Themes","uploadedToLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=16\u0026action=edit","uploadedToTitle":"Home","filesizeInBytes":2340,"filesizeHumanReadable":"2 KB","context":"","height":120,"width":120,"orientation":"landscape","sizes":{"full":{"url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon01.png","height":120,"width":120,"orientation":"landscape"}},"compat":{"item":"","meta":""}}} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:fuel-themes/thb-iconbox {"uid":"asquared-1594917159363","title":"Free Shipping","subtitle":"Fast + free shipping","image":{"uploading":false,"date":1594973505000,"filename":"icon02.png","menuOrder":0,"uploadedTo":16,"type":"image","subtype":"png","alt":"","title":"icon02","caption":"","description":"","url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon02.png","id":157,"link":"https://restoration.fuelthemes.net/home/icon02/","author":"1","name":"icon02","status":"inherit","modified":1594973505000,"mime":"image/png","icon":"https://restoration.fuelthemes.net/wp-includes/images/media/default.png","dateFormatted":"July 17, 2020","nonces":{"update":"3aa5cbb989","delete":"c02c3eaf61","edit":"56a18c0541"},"editLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=157\u0026action=edit","meta":false,"authorName":"Fuel Themes","uploadedToLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=16\u0026action=edit","uploadedToTitle":"Home","filesizeInBytes":3739,"filesizeHumanReadable":"4 KB","context":"","height":120,"width":120,"orientation":"landscape","sizes":{"full":{"url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon02.png","height":120,"width":120,"orientation":"landscape"}},"compat":{"item":"","meta":""}}} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:fuel-themes/thb-iconbox {"uid":"asquared-1594917164809","title":"Fair Prices","subtitle":"No matter your budget","image":{"uploading":false,"date":1594973568000,"filename":"icon03.png","menuOrder":0,"uploadedTo":16,"type":"image","subtype":"png","alt":"","title":"icon03","caption":"","description":"","url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon03.png","id":158,"link":"https://restoration.fuelthemes.net/home/icon03/","author":"1","name":"icon03","status":"inherit","modified":1594973568000,"mime":"image/png","icon":"https://restoration.fuelthemes.net/wp-includes/images/media/default.png","dateFormatted":"July 17, 2020","nonces":{"update":"fc1bcf105f","delete":"91695d8611","edit":"822104b08c"},"editLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=158\u0026action=edit","meta":false,"authorName":"Fuel Themes","uploadedToLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=16\u0026action=edit","uploadedToTitle":"Home","filesizeInBytes":2965,"filesizeHumanReadable":"3 KB","context":"","height":120,"width":120,"orientation":"landscape","sizes":{"full":{"url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon03.png","height":120,"width":120,"orientation":"landscape"}},"compat":{"item":"","meta":""}}} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:fuel-themes/thb-iconbox {"uid":"asquared-1594917168849","title":"Free Returns","subtitle":"Simply Return it","image":{"uploading":false,"date":1594973616000,"filename":"icon04.png","menuOrder":0,"uploadedTo":16,"type":"image","subtype":"png","alt":"","title":"icon04","caption":"","description":"","url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon04.png","id":159,"link":"https://restoration.fuelthemes.net/home/icon04/","author":"1","name":"icon04","status":"inherit","modified":1594973616000,"mime":"image/png","icon":"https://restoration.fuelthemes.net/wp-includes/images/media/default.png","dateFormatted":"July 17, 2020","nonces":{"update":"c34ad467f8","delete":"84d5314380","edit":"a3d236e07a"},"editLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=159\u0026action=edit","meta":false,"authorName":"Fuel Themes","uploadedToLink":"https://restoration.fuelthemes.net/wp-admin/post.php?post=16\u0026action=edit","uploadedToTitle":"Home","filesizeInBytes":2370,"filesizeHumanReadable":"2 KB","context":"","height":120,"width":120,"orientation":"landscape","sizes":{"full":{"url":"https://restoration.fuelthemes.net/wp-content/uploads/2020/07/icon04.png","height":120,"width":120,"orientation":"landscape"}},"compat":{"item":"","meta":""}}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"color":"very-light-gray","className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-background has-very-light-gray-background-color has-very-light-gray-color is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":55} -->
<div style="height:55px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","level":3,"className":"thb-heading-letterspacing"} -->
<h3 class="has-text-align-center thb-heading-letterspacing">CONTEMPORARY FURNITURE</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":14}}} -->
<p class="has-text-align-center" style="font-size:14px">From glam vibes to laid-back comfort, these sofas all have one thing in common—and that’s amazing value.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":20} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:fuel-themes/thb-woocommerce-category-grid {"uid":"asquared-1594746672215","thbcolumns":6,"categories":[{"term_id":26,"name":"Seating","slug":"seating","term_group":0,"term_taxonomy_id":26,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":26},{"term_id":27,"name":"Storage","slug":"storage","term_group":0,"term_taxonomy_id":27,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":27},{"term_id":28,"name":"Tables","slug":"tables","term_group":0,"term_taxonomy_id":28,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":28},{"term_id":29,"name":"Chairs","slug":"chairs","term_group":0,"term_taxonomy_id":29,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":29},{"term_id":30,"name":"Sofas","slug":"sofas","term_group":0,"term_taxonomy_id":30,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":30},{"term_id":31,"name":"Side Tables","slug":"side","term_group":0,"term_taxonomy_id":31,"taxonomy":"product_cat","description":"","parent":0,"count":1,"filter":"raw","id":31}]} /-->

<!-- wp:spacer {"height":24} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:buttons {"contentJustification":"center"} -->
<div class="wp-block-buttons is-content-justification-center"><!-- wp:button {"style":{"color":{"text":"#5a5958"}},"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color" href="https://restoration.fuelthemes.net/shop/" style="color:#5a5958">View All Categories</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":70} -->
<div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:image {"id":96,"sizeSlug":"full"} -->
<figure class="wp-block-image size-full"><a href="https://restoration.fuelthemes.net/shop/"><img src="https://restoration.fuelthemes.net/wp-content/uploads/2020/07/banner.png" alt="" class="wp-image-96"/></a></figure>
<!-- /wp:image -->

<!-- wp:spacer {"height":60} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","level":3,"className":"thb-heading-letterspacing"} -->
<h3 class="has-text-align-center thb-heading-letterspacing">HANDPICKED PRODUCTS</h3>
<!-- /wp:heading -->

<!-- wp:spacer {"height":20} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:woocommerce/product-new {"columns":4} /-->

<!-- wp:buttons {"contentJustification":"center"} -->
<div class="wp-block-buttons is-content-justification-center"><!-- wp:button {"style":{"color":{"background":"#5a5958"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-background" href="https://restoration.fuelthemes.net/shop/" style="background-color:#5a5958">View All products</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":30} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->',
		)
	// phpcs:enable
	);

	register_block_pattern(
		'restoration/aboutpage',
		array(
			'title'      => esc_html__( 'About Page', 'restoration' ),
			'keywords'   => array( 'restoration', 'page' ),
			'categories' => array( 'restoration' ),
			// phpcs:disable
			'content' => '<!-- wp:spacer {"height":30} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:media-text {"align":"","mediaId":202,"mediaType":"image","imageFill":true,"style":{"color":{"background":"#f2ece8"}},"className":"has-background"} -->
<div class="wp-block-media-text is-stacked-on-mobile is-image-fill has-background has-background" style="background-color:#f2ece8"><figure class="wp-block-media-text__media" style="background-image:url(https://restoration.fuelthemes.net/wp-content/uploads/2020/07/about-img-1024x778.jpg);background-position:50% 50%"><img src="https://restoration.fuelthemes.net/wp-content/uploads/2020/07/about-img-1024x778.jpg" alt="" class="wp-image-202 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"Content…","style":{"typography":{"fontSize":14}}} -->
<p style="font-size:14px">Welcome to Restoration</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1>Be Adventurous</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Originally founded by three design professionals,<br>the Industrial Union of the town of Pordenone, Italy,<br>(Unione Industriali Pordenone) and the Friulian<br>region’s best furniture producers and artisans, in<br>2017 Valitalia is experiencing a new beginning. We<br>are passionate about well-designed, timeless<br>furnishings and have come.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":200,"width":176,"height":52,"sizeSlug":"large"} -->
<figure class="wp-block-image size-large is-resized"><img src="https://restoration.fuelthemes.net/wp-content/uploads/2020/07/signature.png" alt="" class="wp-image-200" width="176" height="52"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:media-text -->

<!-- wp:spacer {"height":80} -->
<div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"25%"} -->
<div class="wp-block-column" style="flex-basis:25%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:paragraph -->
<p>Home is a story of people who reside in there, the colors are background music and the furniture are the second lead of the story. Your furniture is more than just a piece of the timber - it reflects your choice, personality, and your comfort zone. We understand buying furniture is more of an emotional process, thus we are helping you personalize your home since 2010 according to your choices and with utmost love.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We aim to give you the best choices concerning high-quality furniture at affordable prices. The designs are carefully picked by our team so that you have the best alternatives to choose from. SelectFunitureStore is a home furniture store that has an extensive range of categories from dining room furniture, kids furniture bedroom furniture, bathroom furniture, etc.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The other place where you spend your most time apart from home is your office. There are many perks of well-designed office, it leaves a positive impression on clients &amp; a comfortable working space encourages employees to perform better. Select Restoration Furniture provides you furniture that manages, maintain and modify your office space.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"25%"} -->
<div class="wp-block-column" style="flex-basis:25%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
		)
	// phpcs:enable
	);

	register_block_pattern(
		'restoration/contactpage',
		array(
			'title'      => esc_html__( 'Contact Page', 'restoration' ),
			'keywords'   => array( 'restoration', 'page' ),
			'categories' => array( 'restoration' ),
			// phpcs:disable
			'content' => '<!-- wp:media-text {"align":"","mediaPosition":"right","mediaId":199,"mediaType":"image","mediaWidth":56,"imageFill":true,"focalPoint":{"x":"0.94","y":"0.48"},"style":{"color":{"background":"#f7f4f2"}},"className":"has-background"} -->
<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile is-image-fill has-background has-background" style="background-color:#f7f4f2;grid-template-columns:auto 56%"><figure class="wp-block-media-text__media" style="background-image:url(https://restoration.fuelthemes.net/wp-content/uploads/2020/07/contact-1024x830.jpg);background-position:94% 48%"><img src="https://restoration.fuelthemes.net/wp-content/uploads/2020/07/contact-1024x830.jpg" alt="" class="wp-image-199 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"level":1} -->
<h1>We would love to hear from you.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>It’s sometimes said that I’m rebellious and I do things to push people’s buttons, but I just like the challenge. Luxury must be comfortable, otherwise.<br><br></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":6} -->
<h6><strong>Restoration Co.</strong></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":14}}} -->
<p style="font-size:14px">8212 E. Glen Creek Street Orchard Park, NY 14127,<br>United States of America<br><br>Phone: +1 909969 0383<br>Email: hello@fuelthemes.net</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":6} -->
<h6><strong>Store Hours</strong></h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":14}}} -->
<p style="font-size:14px">Monday–Saturday 11am–7pm ET<br>Sunday 11am–6pm ET</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->',
		)
	// phpcs:enable
	);
	register_block_pattern_category(
		'restoration',
		array( 'label' => esc_html__( 'Restoration', 'restoration' ) )
	);
}
add_action( 'init', 'thb_patterns_register_block_patterns' );
