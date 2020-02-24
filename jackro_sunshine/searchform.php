<?php
/*
 * Search Form with Custom Auto Complete
 *
 * @package jackro_sunshine
 */

?>

<form class="c-form c-searchform" method="get" autocomplete="off" action="<?php echo home_url( '/' ); ?>">
  <label class="sr-only" for="s">Search <?php echo home_url( '/' ); ?></label>
  <input type="text" name="s" id="keyword" placeholder="Search" value="<?php the_search_query(); ?>" onkeyup="fetch()"/>
  <button class="c-button" type="submit" value="Submit"><i class="fas fa-search"></i>&nbsp;Search</button>
  <div class="c-searchform-item" id="datafetch"></div>
</form>
