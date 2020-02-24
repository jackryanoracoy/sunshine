<?php
/*
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jackro_sunshine
 */

?>

  <footer class="l-site-footer">

    <div class="u-background-grey-300">
      <div class="l-container">
        <section class="l-section has-padding-narrow">

          <h5 class="u-text-center u-font-small u-font-medium-lg">&copy; <?php echo date('Y'); ?>&nbsp;<?php bloginfo( 'name' ); ?> - All Rights Reserved</h5>

        </section><!-- End - section -->
      </div><!-- End - container -->
    </div><!-- End - main-footer -->

  </footer><!-- End - site-footer -->

<?php wp_footer(); ?>

<!-- No Script -->
<noscript><p class="c-browser-notice">Please enable JavaScript and revisit (reload) this page, Thank you!</p></noscript>

</body>
</html>
