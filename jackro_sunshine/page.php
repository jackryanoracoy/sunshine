<?php
/*
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
          while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content', 'page' );

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
          comments_template();
          endif;

          endwhile; // End of the loop.
          ?>

        </section><!-- End - section -->
      </div><!-- End - container -->

    </article><!-- End - site-content -->

  </main><!-- End - site-main -->

<?php
get_sidebar();
get_footer();
