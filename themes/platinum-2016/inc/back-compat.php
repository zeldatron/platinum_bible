<?php
/**
 * Platinum-2016 back compat functionality
 *
 * Prevents Platinum-2016 from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */

/**
 * Prevent switching to Platinum-2016 on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'platinum2016_upgrade_notice' );
}
add_action( 'after_switch_theme', 'platinum2016_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Platinum-2016 on WordPress versions prior to 4.4.
 *
 * @since Platinum-2016 1.0
 *
 * @global string $wp_version WordPress version.
 */
function platinum2016_upgrade_notice() {
	$message = sprintf( __( 'Platinum-2016 requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'platinum2016' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Platinum-2016 1.0
 *
 * @global string $wp_version WordPress version.
 */
function platinum2016_customize() {
	wp_die( sprintf( __( 'Platinum-2016 requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'platinum2016' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'platinum2016_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Platinum-2016 1.0
 *
 * @global string $wp_version WordPress version.
 */
function platinum2016_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Platinum-2016 requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'platinum2016' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'platinum2016_preview' );
