<?php
/*
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
      <h6 class="sr-only"><?php the_title( '', '&nbsp;-&nbsp;' ); bloginfo( 'name' ); ?></h6>

      <div class="l-container">
        <section class="l-section">

          <?php
          if ( have_posts() ) :

          if ( is_home() && ! is_front_page() ) :
          ?>
          <h1 class="c-heading-section sr-only"><?php single_post_title(); ?></h1>
          <?php
          endif;

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
