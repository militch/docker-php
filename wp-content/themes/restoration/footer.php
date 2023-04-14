<?php
/**
 * The footer for our theme
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

?>
	</div> <!-- End Main -->
	<?php do_action( 'thb_after_main' ); ?>
	<?php

		/*
		 * Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */

		wp_footer();
	?>
</div> <!-- End Wrapper -->
<?php do_action( 'thb_after_wrapper' ); ?>
</body>
</html>
