<?php
/*
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

?>


          <?php the_title( sprintf( '<h2 class="c-heading-section"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

          if ( 'post' === get_post_type() ) : ?>

          <div class="c-entry-meta">
            <?php
            jackro_sunshine_posted_on();
            jackro_sunshine_posted_by();
            ?>
          </div><!-- End - meta -->

          <?php endif; ?>

          <?php jackro_sunshine_post_thumbnail(); ?>

          <div class="c-entry-summary">
            <?php the_excerpt(); ?>
          </div><!-- End - summary -->

          <?php jackro_sunshine_entry_footer(); ?>

