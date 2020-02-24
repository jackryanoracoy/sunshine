<?php
/*
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

					<h1 class="c-heading-section"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'jackro_sunshine' ); ?></h1>

					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'jackro_sunshine' ); ?></p>

					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<article class="l-article">
						<h2 class="c-heading-article"><?php esc_html_e( 'Most Used Categories', 'jackro_sunshine' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</article><!-- End- article -->

					<?php
					/* translators: %1$s: smiley */
					$jackro_sunshine_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'jackro_sunshine' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$jackro_sunshine_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

        </section><!-- End - section -->
      </div><!-- End - container -->

    </article><!-- End - site-content -->

  </main><!-- End - site-main -->

<?php
get_footer();
