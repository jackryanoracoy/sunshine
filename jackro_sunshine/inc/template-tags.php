<?php
/*
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jackro_sunshine
 */

if ( ! function_exists( 'jackro_sunshine_posted_on' ) ) :
  /*
   * Prints HTML with meta information for the current post-date/time.
   */
  function jackro_sunshine_posted_on() {
    $time_string = '<time class="c-entry-date is-published is-updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date is-published" datetime="%1$s">%2$s</time><time class="c-entry-date-updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
      esc_attr( get_the_date( DATE_W3C ) ),
      esc_html( get_the_date() ),
      esc_attr( get_the_modified_date( DATE_W3C ) ),
      esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
      /* translators: %s: post date. */
      esc_html_x( 'Posted on %s', 'post date', 'jackro_sunshine' ),
      '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="c-posted-on">' . $posted_on . '</span>';

  }
endif;

if ( ! function_exists( 'jackro_sunshine_posted_by' ) ) :
  /*
   * Prints HTML with meta information for the current author.
   */
  function jackro_sunshine_posted_by() {
    $byline = sprintf(
      esc_html_x( 'by %s', 'post author', 'jackro_sunshine' ), '<span class="c-author c-vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="c-byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

  }
endif;

if ( ! function_exists( 'jackro_sunshine_entry_footer' ) ) :
  /*
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function jackro_sunshine_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
      /* translators: used between list items, there is a space after the comma */
      $categories_list = get_the_category_list( esc_html__( ', ', 'jackro_sunshine' ) );
      if ( $categories_list ) {
        printf( '<span class="c-cat-links">' . esc_html__( 'Posted in %1$s', 'jackro_sunshine' ) . '</span>', $categories_list );
      }

      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'jackro_sunshine' ) );
      if ( $tags_list ) {
        printf( '<span class="c-tags-links">' . esc_html__( 'Tagged %1$s', 'jackro_sunshine' ) . '</span>', $tags_list );
      }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
      echo '<span class="c-comments-link">';
      comments_popup_link(
        sprintf(
          wp_kses(
            __( 'Leave a Comment<span class="sr-only"> on %s</span>', 'jackro_sunshine' ),
            array( 'span' => array( 'class' => array(),	),	)
          ),
          get_the_title()
        )
      );
      echo '</span>';
    }

    edit_post_link(
      sprintf(
        wp_kses(
          __( 'Edit <span class="sr-only">%s</span>', 'jackro_sunshine' ),
          array( 'span' => array( 'class' => array(),	), )
        ),
        get_the_title()
      ),
      '<span class="c-edit-link">',
      '</span>'
    );
  }
endif;

if ( ! function_exists( 'jackro_sunshine_post_thumbnail' ) ) :
  /*
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   */
  function jackro_sunshine_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
      return;
    }

    if ( is_singular() ) :
      ?>

      <div class="c-post-thumbnail">
        <?php the_post_thumbnail(); ?>
      </div><!-- .post-thumbnail -->

    <?php else : ?>

    <a class="c-post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
      <?php
      the_post_thumbnail( 'post-thumbnail', array(
        'alt' => the_title_attribute( array( 'echo' => false, ) ),
      ) );
      ?>
    </a>

    <?php
    endif; // End is_singular().
  }
endif;
