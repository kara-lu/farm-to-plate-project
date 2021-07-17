<?php
/**
 * The template for displaying the Front Page
 *
 * This is the template that displays the Front Page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Farm_to_Plate
 */

get_header();
?>

	<main id="primary" class="home-page site-main">
		<?php 
		while ( have_posts() ) :
		the_post();
		// <!-- add ACF -->
		
			if ( function_exists ( 'get_field' ) ) {
				// Banner
				?>
				<section class = 'banner'>
				<?php
				if ( get_field( 'banner_image' ) ) {
					?><div class = "img-container">
						<?php echo wp_get_attachment_image( get_field( 'banner_image' ), 'full', '', array( 'class' => '' )); ?>
					  </div>
					  <?php
				}

				if ( get_field( 'banner_text_area' ) ) {
					?>
					<h1> <?php echo get_field( 'banner_text_area'); ?> </h1>
					<?php
				}

				if ( get_field( 'banner_link' ) ) {
					?>
					<div class='button'><a href='<?php echo get_field( 'banner_link') ?>'>Try It Free</a></div>
					<?php
				}
				?>
				</section>

				<!-- // How It Works -->

				<section class = 'how-it-works'>
				<?php
				if( have_rows('how_it_works') ):
					?>
					<h2>How It Works</h2>
					<?php
					while( have_rows('how_it_works') ) : the_row();
						$sub_value_img = wp_get_attachment_image( get_sub_field('image'), 'full', '', array( 'class' => '' ));
						$sub_value_heading = get_sub_field('heading');
						$sub_value_text = get_sub_field('text_area');
						?>
						<article class = 'how-it-work-item'>
						<?php
							echo $sub_value_img;
							echo "<h2>$sub_value_heading</h2>";
							echo "<p>$sub_value_text</p>";
						?>
						</article>
						<?php
					endwhile;
				endif;
				?>
				</section>
				<?php

				// add Why Choose
				get_template_part( 'template-parts/why', 'choose' );
			} 
		?>

		<!-- Add menu-->
		<?php
		
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
								array(
									'taxonomy' 	=> 'farm-week',
									'field' 	=> 'slug',
									// 'terms' 	=> $currentWeek
									'terms' 	=> "2021-28"
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
								<article class='menu-item'>	
								<a href="<?php the_permalink();?>">
									<?php
										the_post_thumbnail('menu-home');
									?>
									<h3><?php the_title(); ?></h3>
								</a>
								</article>
								<?php
							}
							?>
							</section>
							<?php
							wp_reset_postdata();
						}

				}
		// <!-- CTA -->
		if ( get_field( 'cta_link' ) ) {
			?>
			<section class='button-container'>
				<div class='button'><a href=' <?php echo get_field( 'cta_link') ?> '>Try It Free</a></div>
			</section>
		<?php
		}else{
			?>
			<section class='button-container'>
			<div class='button'><a href='<?php echo get_permalink(53) ?>'>Try It Free</a></div>
			</section>
		<?php
		}
		// <!-- Add Testimonials -->
			// Output a random testimonials 
			$args = array(
				'post_type'      => 'farm-testimonial',
				'orderby'        => 'rand',
				'posts_per_page' => 2,
				);

				$query = new WP_Query( $args );
				if ( $query -> have_posts() ){
					?>
					<section class="testimonial"><h2>What Our Customers Say</h2>
					<?php
					while ($query-> have_posts() ){
						?>
						<article class='testimonial-item'>
						<?php
						$query -> the_post();
						the_content();
						?>
						</article>
						<?php
					}
					wp_reset_postdata();
					?>
					</section>
					<?php
				}
		?>

		<!-- Featured in news -->
		<?php
			// Output a random Socials 
			$args = array(
				'post_type'      => 'farm-social',
				'orderby'        => 'rand',
				'posts_per_page' => 4,
				);

				$query = new WP_Query( $args );
				if ( $query -> have_posts() ){
					?>
					<section class="social"><h2>As Featured in</h2>
					<?php
					while ($query-> have_posts() ){
						$query -> the_post();
						?>
						<article class='social-item'>
						<a href="<?php echo get_permalink(409) ?>">
						<?php
						the_post_thumbnail('medium');
						?></a>
						</article>
						<?php
					}
					wp_reset_postdata();
					?>
					</section>
					<?php
				}
		?>

		<!-- Add ACF Option map -->
		<?php
			if ( get_field( 'delivery-map','option') && get_field( 'delivery_map_large','option')) {
				$map = get_field( 'delivery-map','option');
				$map_large = get_field( 'delivery_map_large','option');
				?>
				<section class="delivery">
					<h2>Our Delivery Area</h2>
					<picture class="map-container">
						<source media="(min-width: 1001px)" srcset="<?php echo $map_large['url']; ?>">
						<img src="<?php echo $map['url']; ?>" alt="delivery area map">
					</picture>	
				</section>
				<?php
			}
			?>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
