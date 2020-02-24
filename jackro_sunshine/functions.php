<?php
/*
 * jackro_sunshine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jackro_sunshine
 */

if ( ! function_exists( 'jackro_sunshine_setup' ) ) :
	/*
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jackro_sunshine_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on jackro_sunshine, use a find and replace
		 * to change 'jackro_sunshine' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'jackro_sunshine', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'jackro_sunshine' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'jackro_sunshine_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
			'flex-height' => false,
		) );
	}
endif;
add_action( 'after_setup_theme', 'jackro_sunshine_setup' );

/*
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jackro_sunshine_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'jackro_sunshine_content_width', 640 );
}
add_action( 'after_setup_theme', 'jackro_sunshine_content_width', 0 );

/*
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jackro_sunshine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jackro_sunshine' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'jackro_sunshine' ),
		'before_widget' => '<section id="%1$s" class="l-widget is-%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="c-heading-widget">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jackro_sunshine_widgets_init' );

/*
 * Enqueue scripts and styles.
 */
function jackro_sunshine_scripts() {
  wp_enqueue_style( 'jackro_sunshine-style', get_stylesheet_uri() );

  wp_enqueue_script( 'jackro_sunshine-script', get_template_directory_uri() . '/scripts/script.js', array('jquery'), '20200225', true );

  wp_enqueue_script( 'jackro_sunshine-modernizr', get_template_directory_uri() . '/scripts/modernizr-3.7.1.min.js', array(), '20200225', true );

  wp_enqueue_script( 'jackro_sunshine-object-fit', get_template_directory_uri() . '/scripts/object-fit-images-3.2.3.min.js', array(), '20200225', true );

	wp_enqueue_script( 'jackro_sunshine-navigation', get_template_directory_uri() . '/scripts/navigation.js', array(), '20200225', true );

  wp_enqueue_script( 'jackro_sunshine-skip-link-focus-fix', get_template_directory_uri() . '/scripts/skip-link-focus-fix.js', array(), '220200225', true );

  wp_localize_script( 'jackro_sunshine-localization', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jackro_sunshine_scripts' );

/*
 * Filter the except length to 20 words.
 */
function wp_custom_excerpt_length( $length ) { return 20; }
add_filter( 'excerpt_length', 'wp_custom_excerpt_length', 999 );

/*
 * Filter the "get_custom_logo".
 */
add_filter( 'get_custom_logo', 'change_logo_class' );
function change_logo_class( $html ) {
    $html = str_replace( 'custom-logo', 'c-site-branding-logo', $html );
    $html = str_replace( 'c-site-branding-logo-link', 'c-site-branding', $html );
    return $html;
}

/*
 * Filter the "read more" excerpt string link to the post.
 */
function wp_excerpt_more( $more ) {
  if ( ! is_single() ) { $more = sprintf( '...&nbsp;<a class="c-read-more" href="%1$s">%2$s</a>', get_permalink( get_the_ID() ), __( 'Read More', 'jackro_sunshine' ) ); }
  return $more;
}
add_filter( 'excerpt_more', 'wp_excerpt_more' );

/*
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/*
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/*
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
 * Add ajax search suggestions
 */
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>

<script type="text/javascript">
function fetch(){
  jQuery.ajax({
    url: '<?php echo admin_url('admin-ajax.php'); ?>',
    type: 'post',
    data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
    success: function(data) { jQuery('#datafetch').html( data ); }
  });
}
</script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch() {

  $the_query = new WP_Query( array( 'posts_per_page' => 10, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post' ) );
  if( $the_query->have_posts() ) :
  while( $the_query->have_posts() ): $the_query->the_post(); ?>

  <div><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></div>

  <?php endwhile;
  wp_reset_postdata();
  endif;

  die();
}

