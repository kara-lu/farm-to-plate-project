<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Farm_to_Plate
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<!-- .page-content -->
			<section class="page-content">

				<?php
				if ( function_exists ( 'get_field' ) ) {
					$image = get_field( 'image_404','option' );
					if ( get_field( 'image_404','option' ) ) {
						?>
						<section class='image-404-container'>
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						</section>
					<?php
					} 
				}?>


				<section class="content-container">
					<h1 class="page-title"><?php esc_html_e( 'Oops! Page Not Found.', 'farm-to-plate' ); ?></h1>
					<p><?php esc_html_e( 'The page you were looking for does not exist.', 'farm-to-plate' ); ?></p>
					<p><?php esc_html_e( 'Please try one of the links below.', 'farm-to-plate' ); ?></p>

					<ul>
						<li><a href='<?php echo get_permalink(20) ?>'>Return to Home</a></li>
						<li><a href='<?php echo get_permalink(42) ?>'>See the Menu</a></li>
						<li><a href='<?php echo get_permalink(53) ?>'>Our Products</a></li>
					</ul>
				</section>

			</section>

			<?php
			// CTA to Pricing
			if ( get_field( 'cta_link' ) ) { ?>
				<section class='cta-button-container'>
					<?php
					$image = get_field( 'cta_image','option');
					if ( get_field( 'cta_image','option')) {
						?>
						<div class="cta-image-container">
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						</div>
						<?php
					}
					?>
					<div class='button'><a href=' <?php echo get_field( 'cta_link') ?> '>Try It Free</a></div>
				</section>
			<?php
			}else{ ?>
				<section class='cta-button-container'>
				<?php
					$image = get_field( 'cta_image','option');
					if ( get_field( 'cta_image','option')) {
						?>
						<div class="cta-image-container">
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						</div>
						<?php
					}
					?>
				<div class='button'><a href='<?php echo get_permalink(53) ?>'>Try It Free</a></div>
				</section>
			<?php
			}
			// end CTA -------
			?>

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
