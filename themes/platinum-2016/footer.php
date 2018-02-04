<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'platinum2016' ); ?>">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu',
				 ) );
			?>
		</nav><!-- .main-navigation -->
	<?php endif; ?>

	<div class="site-info">
		<?php
			/**
			 * Fires before the platinum2016 footer text for footer customization.
			 *
			 * @since Platinum-2016 1.0
			 */
			/* do_action( 'platinum2016_credits' ); */
		?>
		CONFIDENTIAL INFORMATION & TRADE SECRET DATA – property of PLATINUM STUDIOS, LLC. Recipient shall not disclose to unauthorized persons or make unauthorized copies, downloads or transmissions.
	</div><!-- .site-info -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
