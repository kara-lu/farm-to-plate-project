<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Farm_to_Plate
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function farm_to_plate_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'farm_to_plate_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function farm_to_plate_woocommerce_scripts() {
	wp_enqueue_style( 'farm-to-plate-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'farm-to-plate-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'farm_to_plate_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function farm_to_plate_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'farm_to_plate_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function farm_to_plate_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'farm_to_plate_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'farm_to_plate_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function farm_to_plate_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'farm_to_plate_woocommerce_wrapper_before' );

if ( ! function_exists( 'farm_to_plate_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function farm_to_plate_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'farm_to_plate_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'farm_to_plate_woocommerce_header_cart' ) ) {
			farm_to_plate_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'farm_to_plate_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function farm_to_plate_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		farm_to_plate_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'farm_to_plate_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'farm_to_plate_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function farm_to_plate_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'farm-to-plate' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'farm-to-plate' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'farm_to_plate_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function farm_to_plate_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php farm_to_plate_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


// editing woocommerce

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// add menu to single product
function farmtoplate_menu(){

	// check if page is signature or vegetarian
	$str = get_post_field( 'post_name' );
	if($str === "signature-meal-kit"){
		$querySlug = "signature";
	}else if($str === "vegetarian-meal-kit"){
		$querySlug = "vegetarian";
	}

	// calc date (php date)
	// https://www.php.net/manual/en/function.date.php
	// https://www.php.net/manual/en/datetime.format.php
	$currentWeek = date('o-W');
	$terms = get_terms(
				array(
					'taxonomy' 	=> 'farm-week',
				)
			);
			if ( $terms && ! is_wp_error( $terms ) ) {
					$args = array(
						'post_type' 		=> 'farm-dish',
						'posts_per_page' 	=> 8,
						'orderby'            => 'title',
						'order'              => 'ASC',
						'tax_query' 		=> array(
							'relation' => 'AND',
							array(
								'taxonomy' 	=> 'farm-week',
								'field' 	=> 'slug',
								// 'terms' 	=> $currentWeek
								'terms' 	=> "2021-28"
							),
							array(
								'taxonomy' 	=> 'farm-type',
								'field' 	=> 'slug',
								'terms' 	=> $querySlug
							)
						)
					);
					$query = new WP_Query( $args );
					// loop output all the menu
					if ( $query -> have_posts() ){
						?>
						<section class='this-week-menu'>
						<h2>This Week's Menu</h2>
						<?php
						while ( $query -> have_posts() ) {
							$query -> the_post();
							?>
							<a target='_blank' href="<?php the_permalink();?>">
							<article class='menu-item'>	
								<?php
									the_post_thumbnail('menu-home');
								?>
								<h3><?php the_title(); ?></h3>
							</article>
							</a>
							<?php
						}
						?>
						</section>
						<?php
						wp_reset_postdata();
					}
			}
}
add_action('woocommerce_after_single_product_summary','farmtoplate_menu',30);