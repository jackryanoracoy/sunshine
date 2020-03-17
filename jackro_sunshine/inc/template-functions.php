<?php
/*
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package jackro_sunshine
 */

/*
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jackro_sunshine_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  // Adds a class of no-sidebar when there is no sidebar present.
  if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    $classes[] = 'has-no-sidebar';
  }

  return $classes;
}
add_filter( 'body_class', 'jackro_sunshine_body_classes' );

/*
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jackro_sunshine_pingback_header() {
  if ( is_singular() && pings_open() ) {
    printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
  }
}
add_action( 'wp_head', 'jackro_sunshine_pingback_header' );

/*
 * App Icons and Favicons
 */
add_action('wp_head', function() {
  echo '<meta name="msapplication-TileImage" content="' . get_template_directory_uri() . '/assets/app-icon/ms-icon-144x144.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="57x57" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-57x57.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="60x60" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-60x60.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="72x72" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-72x72.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="76x76" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-76x76.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="114x114" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-114x114.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="120x120" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-120x120.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="144x144" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-144x144.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="152x152" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-152x152.png' . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_template_directory_uri() . '/assets/app-icon/apple-icon-180x180.png' . '">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="192x192" href="' . get_template_directory_uri() . '/assets/app-icon/android-icon-192x192.png' . '">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_template_directory_uri() . '/assets/app-icon/favicon-32x32.png' . '">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="96x96" href="' . get_template_directory_uri() . '/assets/app-icon/favicon-96x96.png' . '">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_template_directory_uri() . '/assets/app-icon/favicon-16x16.png' . '">' . "\n";
  echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/assets/app-icon/favicon.ico' . '">' . "\n\n";
});

/*
 * Minify/Compress HTML Output
 */
class HTML_Compression {
  protected $compress_css = true;
  protected $compress_js = true;
  protected $info_comment = true;
  protected $remove_comments = true;
  protected $html;

  public function __construct($html) {
    if (!empty($html)) { $this->parseHTML($html); }
  }

  public function __toString() { return $this->html; }
  protected function bottomComment($raw, $compressed) {
    $raw = strlen($raw);
    $compressed = strlen($compressed);
    $savings = ($raw-$compressed) / $raw * 100;
    $savings = round($savings, 2);
    return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
  }

  protected function minifyHTML($html) {
    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
    $overriding = false;
    $raw_tag = false;
    $html = '';

    foreach ($matches as $token) {
      $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
      $content = $token[0];

      if (is_null($tag)) {

      if ( !empty($token['script']) ) { $strip = $this->compress_js; }

      else if ( !empty($token['style']) ) { $strip = $this->compress_css; }

      else if ($content == '<!--wp-html-compression no compression-->') {
      $overriding = !$overriding;
      continue; }

      else if ($this->remove_comments) {
      if (!$overriding && $raw_tag != 'textarea') { $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content); }
      } }

      else {
      if ($tag == 'pre' || $tag == 'textarea') { $raw_tag = $tag; }

      else if ($tag == '/pre' || $tag == '/textarea') { $raw_tag = false; }

      else { if ($raw_tag || $overriding) { $strip = false; }

      else {
      $strip = true;
      $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
      $content = str_replace(' />', '/>', $content); }
      } }

      if ($strip) { $content = $this->removeWhiteSpace($content); }

      $html .= $content;
    }
    return $html;
  }

  public function parseHTML($html) {
    $this->html = $this->minifyHTML($html);
    if ($this->info_comment) { $this->html .= "\n" . $this->bottomComment($html, $this->html); }
  }

  protected function removeWhiteSpace($str) {
    $str = str_replace("\t", ' ', $str);
    $str = str_replace("\n",  '', $str);
    $str = str_replace("\r",  '', $str);
    while (stristr($str, '  ')) { $str = str_replace('  ', ' ', $str); }
    return $str;
  }
}

function wp_html_compression_finish($html) {
  return new HTML_Compression($html);
}

function wp_html_compression_start() {
  ob_start('wp_html_compression_finish');
}

add_action('get_header', 'wp_html_compression_start');

