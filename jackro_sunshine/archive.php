<?php
/*
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

get_header();
?>

  <main id="site-main" class="l-site-main">

    <article id="site-content" class="l-site-content">

      <!-- This heading is for screen reader -->
      <h6 class="sr-only"><?php the_archive_title( '', '&nbsp;-&nbsp;' ); bloginfo( 'name' ); ?></h6>

      <div class="l-container">
        <section class="l-section">

          <?php if ( have_posts() ) : ?>

          <?php
          the_archive_title( '<h1 class="c-heading-section">', '</h1>' );
          the_archive_description( '<div class="archive-description">', '</div>' );
          ?>

          <?php
          /* Start the Loop */
          while ( have_posts() ) :
          the_post();

          /*
          * Include the Post-Type-specific template for the content.
          * If you want to override this in a child theme, then include a file
          * called content-___.php (where ___ is the Post Type name) and that will be used instead.
          */
          get_template_part( 'template-parts/content', get_post_type() );

          endwhile;

          the_posts_navigation();

          else :

          get_template_part( 'template-parts/content', 'none' );

          endif;
          ?>

        </section><!-- End - section -->
      </div><!-- End - container -->

    </article><!-- End - site-content -->

  </main><!-- End - site-main -->

<?php
get_sidebar();
get_footer();
