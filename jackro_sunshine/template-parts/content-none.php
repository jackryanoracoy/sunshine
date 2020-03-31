<?php
/*
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jackro_sunshine
 */

?>

          <h1 class="c-heading-section"><?php esc_html_e( 'Nothing Found', 'jackro_sunshine' ); ?></h1>

          <?php
          if ( is_home() && current_user_can( 'publish_posts' ) ) :

          printf( '<p>' . wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jackro_sunshine' ),
          array( 'a' => array( 'href' => array(), ), ) ) . '</p>', esc_url( admin_url( 'post-new.php' ) ) );

          elseif ( is_search() ) :
          ?>

          <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jackro_sunshine' ); ?></p>
          <?php
          get_search_form();

          else :
          ?>

          <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jackro_sunshine' ); ?></p>
          <?php
          get_search_form();

          endif;
          ?>
