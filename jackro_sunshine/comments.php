<?php
/*
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

      <div class="l-container">
        <section class="l-section">

          <?php if ( have_comments() ) : ?>

          <h2 class="c-heading-section">
            <?php
            $jackro_sunshine_comment_count = get_comments_number();
            if ( '1' === $jackro_sunshine_comment_count ) {
              printf( esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'jackro_sunshine' ), '<span>' . get_the_title() . '</span>' );
            } else {
              printf( esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $jackro_sunshine_comment_count, 'comments title', 'jackro_sunshine' ) ),
              number_format_i18n( $jackro_sunshine_comment_count ), '<span>' . get_the_title() . '</span>' );
            }
            ?>
          </h2>

          <?php the_comments_navigation(); ?>

          <ol class="c-comment-list">
            <?php
            wp_list_comments( array(
              'style'      => 'ol',
              'short_ping' => true,
            ) );
            ?>
          </ol><!-- End - comment list -->

          <?php
          the_comments_navigation();

          // If comments are closed and there are comments, let's leave a little note, shall we?
          if ( ! comments_open() ) :
          ?>

          <p class="c-comment-none"><?php esc_html_e( 'Comments are closed.', 'jackro_sunshine' ); ?></p>

          <?php
          endif;

          endif; // Check for have_comments().

          comment_form();
          ?>

        </section><!-- End - section -->
      </div><!-- End - container -->
