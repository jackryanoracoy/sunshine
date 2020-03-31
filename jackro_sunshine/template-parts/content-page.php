<?php
/*
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

?>

          <?php the_title( '<h1 class="c-heading-section">', '</h1>' ); ?>

          <?php jackro_sunshine_post_thumbnail(); ?>

          <?php
          the_content();

          wp_link_pages( array(
            'before' => '<div class="c-page-links">' . esc_html__( 'Pages:', 'jackro_sunshine' ),
            'after'  => '</div>',
          ) );
          ?>

          <?php if ( get_edit_post_link() ) :
          edit_post_link(
            sprintf( wp_kses( __( 'Edit <span class="sr-only">%s</span> Content', 'jackro_sunshine' ),
            array( 'span' => array( 'class' => array(), ), ) ),
            get_the_title() ), '<p class="u-mar-top-20 u-text-right">', '</p>', null, 'c-button'
          );
          endif;
          ?>
