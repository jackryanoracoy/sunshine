<?php
/*
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

?>

          <?php
          if ( is_singular() ) :
          the_title( '<h1 class="c-heading-section">', '</h1>' );
          else :
          the_title( '<h2 class="c-heading-section"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
          endif;

          if ( 'post' === get_post_type() ) :
          ?>
          <div class="c-entry-meta">
            <?php
            jackro_sunshine_posted_on();
            jackro_sunshine_posted_by();
            ?>
          </div><!-- End - meta -->
          <?php endif; ?>

          <?php
          jackro_sunshine_post_thumbnail();

          the_content( sprintf(
            wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jackro_sunshine' ),
            array( 'span' => array( 'class' => array(), ), ) ),
            get_the_title() )
          );

          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jackro_sunshine' ),
            'after'  => '</div>',
          ) );

          jackro_sunshine_entry_footer();
          ?>
