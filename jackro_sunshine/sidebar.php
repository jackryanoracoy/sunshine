<?php
/*
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jackro_sunshine
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="sidebar-1" class="l-site-sidebar">
  <div class="l-container">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div><!-- End- container -->
</aside><!-- End - site aside -->
