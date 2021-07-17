<?php
/**
 * Farm to Plate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Farm_to_Plate
 */


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'farm_to_plate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function farm_to_plate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Farm to Plate, use a find and replace
		 * to change 'farm-to-plate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'farm-to-plate', get_template_directory() . '/languages' );

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

		//Add custom crop with a uniqe name 'menu-home'
		// menu item image on home page - 398px width, 360px height, hard crop
		add_image_size( 'menu-home', 398, 360, true );


		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'farm-to-plate' ),
				'footer' => esc_html__( 'Footer Menu Location', 'farm-to-plate' ),
				'social' => esc_html__( 'Social Menu Location', 'farm-to-plate' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'farm_to_plate_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 120,
			)
		);

	}
endif;
add_action( 'after_setup_theme', 'farm_to_plate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function farm_to_plate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'farm_to_plate_content_width', 640 );
}
add_action( 'after_setup_theme', 'farm_to_plate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function farm_to_plate_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'farm-to-plate' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'farm-to-plate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'farm_to_plate_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function farm_to_plate_scripts() {
	wp_enqueue_style( 'farm-to-plate-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'farm-to-plate-style', 'rtl', 'replace' );

	wp_enqueue_script( 'farm-to-plate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// add a google font
	wp_enqueue_style( 'fwd-googlefonts', 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap', array(), null );

	// font awesome
	wp_enqueue_script( 'farm-iconmonster', 'https://kit.fontawesome.com/4ff771d579.js');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'farm_to_plate_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';


// add custom image size into the drop down menu
function create_custom_image_size($sizes){
	$custom_sizes = array(
	'menu-home' => 'Menu Home'
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter('image_size_names_choose', 'create_custom_image_size');


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Image Settings',
		'menu_title'	=> 'Image Settings',
		'menu_slug' 	=> 'Image-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}


//  Lower Yoast SEO Metabox location
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );


// login logo
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_bloginfo('wpurl'); ?>/wp-content/uploads/2021/06/cropped-farm-to-plate-logo.png);
			background-repeat: no-repeat;
			background-position: center;
        	padding-bottom: 30px;
        }
		#user_login:focus,
		#user_pass:focus,
		#rememberme:focus{
			border-color: #066436;
			box-shadow: 0 0 0 1px #066436;
		}
		#rememberme:checked::before{
			content: '';
			display: inline-block;
			-webkit-mask: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%233582c4%27%2F%3E%3C%2Fsvg%3E) no-repeat 50% 50%;
  			mask: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%233582c4%27%2F%3E%3C%2Fsvg%3E) no-repeat 50% 50%;
			background-color: #066436;
		}
		.login #login .button.button-secondary.wp-hide-pw:focus{
			border-color: #066436;
			color: #066436;
			box-shadow: 0 0 0 1px #066436;
		}
		.wp-pwd button span{
			color:#066436;
		}
		#wp-submit{
			background-color: #066436;
			border-color: #066436;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


//Edit excerpt length
function ftp_excerpt_length(){
	return 12;
}
add_filter('excerpt_length', 'ftp_excerpt_length', 999);

//Edit the read more link
function ftp_excerpt_more( $more ) {
    $more = ' ...';
    return $more;
}
add_filter( 'excerpt_more', 'ftp_excerpt_more' );


/**
 * Adding welcome widget to dashboard
 */
function farm_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'farm_dashboard_widget',                          // Widget slug.
        esc_html__( 'FTP Welcome Message', 'farm-to-plate' ), // Title.
        'farm_dashboard_widget_render'                    // Display function.
    ); 
}
add_action( 'wp_dashboard_setup', 'farm_add_dashboard_widgets' );
 

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function farm_dashboard_widget_render() {
    // Display whatever you want to show.
    esc_html_e( "Welcome to Farm to Plate!", "farm-to-plate" );
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');


function my_custom_dashboard_widgets() {
global $wp_meta_boxes;


wp_add_dashboard_widget('custom_help_widget', 'Farm to Plate Theme Support', 'custom_dashboard_help');
}


function custom_dashboard_help() {
echo '<h3>For Farm to Plate Tutorials click the button below</h3>';
echo '<a href="../wp-content/themes/farm-to-plate/documents/farm-to-plate-user-menu.pdf" target="_blank">
		<img src="../wp-content/themes/farm-to-plate/img/user-document.jpg" alt="user document">
		</a>';
}


// Removing dashboard widgets
function wporg_remove_all_dashboard_metaboxes() {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'wc_admin_dashboard_setup', 'dashboard', 'normal');
	remove_meta_box( 'jetpack_summary_widget', 'dashboard', 'normal');
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );


// Remove admin menu links for non-Administrator accounts
function twd_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' );           // Remove Posts link
    		remove_menu_page( 'edit-comments.php' );   // Remove Comments link
	}
}
add_action( 'admin_menu', 'twd_remove_admin_links' );


/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style('farm-editor-style.css');
}
add_theme_support( 'editor-styles' );
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// Remove Block Editor
function fwd_post_filter( $use_block_editor, $post ) {
	// Remove the block editor if it is not the page ID of 112245 (unlikely)
	$page_ids = array( 112245 );
	if ( !in_array( $post->ID, $page_ids ) ) {
		return false;
	}
}
add_filter( 'use_block_editor_for_post', 'fwd_post_filter', 10, 2 );


