<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zinnfinity
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Adobe Fonts -->
	<link rel="stylesheet" href="https://use.typekit.net/zrg4taf.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'haunmena' ); ?></a>
	<div class="page-wrapper">
		<header id="masthead" class="site-header site-header--large">
			<div class="nav-container">
				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri() ?>/img/ims-houston-logo.svg" alt="Indian Music Society of Houston"></a>
					</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .nav-container -->
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</header><!-- #masthead -->

		<div id="content" class="site-content">