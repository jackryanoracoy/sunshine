<?php
/*
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jackro_sunshine
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#263238">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="msapplication-TileColor" content="#263238">
  <link rel="manifest" href="<?php echo get_parent_theme_file_uri( 'manifest.json' )?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!--[if IE]><p class="c-browser-notice">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience and security.</p><![endif]-->

	<a class="sr-only is-focusable" href="#site-content"><?php esc_html_e( 'Skip to content', 'jackro_sunshine' ); ?></a>

  <header class="l-site-header">

    <div class="l-site-header-content u-background-primary l-flex is-jus-spbetween is-alt-center">

      <div class="l-site-header-branding">

        <a class="c-site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <?php
          if ( is_front_page() && is_home() ) :
          ?>

          <h1 class="c-site-branding-title"><?php bloginfo( 'name' ); ?></h1>

          <?php
          else :
          ?>

          <p class="c-site-branding-title"><?php bloginfo( 'name' ); ?></p>

          <?php
          endif;

          $jackro_sunshine_description = get_bloginfo( 'description', 'display' );
          if ( $jackro_sunshine_description || is_customize_preview() ) :
          ?>

          <p class="sr-only"><?php echo $jackro_sunshine_description; ?></p>

          <?php
          endif;
          ?>
        </a><!-- End - site branding -->

      </div><!-- End - branding -->

      <div class="l-site-header-menu u-hidden-lg-min">
        <a class="c-site-menu" href="javascript:void(0)"><span class="c-site-menu-box"><span class="c-site-menu-inner"></span></span></a>
      </div><!-- End - menu -->

    </div><!-- End - content -->

    <div class="l-site-header-content u-background-secondary">

      <nav class="l-site-header-navigation" role="navigation">
        <?php
        wp_nav_menu( array(
        'theme_location' => 'menu-1',
        'menu_class'     => 'c-site-nav',
        'menu_id'        => 'primary-menu',
        ) );
        ?>
      </nav><!-- End - navigation -->

    </div><!-- End - content -->

  </header><!-- End - site-header -->
