<?php
/**
 * The template for displaying the Pricing page
 *
 * This is the template that displays the Pricing page default.
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

	<main id="primary" class="pricing site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			// free trial notes
			if ( function_exists ( 'get_field' ) ) {
				if ( get_field( 'free_trial_notes' ) ) {
					?>
					<section class='free-trial-note'>
					<?php
					echo get_field( 'free_trial_notes');
					?>
					</section>
					<?php
				}
			}
			// meal kit
			$args = array(
				'post_type'      => 'product',
				'orderby'        => 'name',
				'order'			=> 'ASC',
				'posts_per_page' => 2,
				);

				$query = new WP_Query( $args );
				if ( $query -> have_posts() ){
					?>
					<section class="product">
						<?php
						while ($query-> have_posts() ){
							$query -> the_post();
							?>
							<article class='product-item'>
							<a href="<?php the_permalink();?>">
								<?php
								the_post_thumbnail('menu-home');
								echo "<h3>".get_the_title()."</h3>";
								?>
								<p><?php the_excerpt(  );?></p>
								
								<div class="button">
									<p>Select</p>
								</div>
							</a>
							</article>
							<?php


						}
						?>
						
						<?php
						wp_reset_postdata();
						?>
						</section>
						<?php
					}
				// Why Choose
				if ( function_exists ( 'get_field' ) ) {
					get_template_part( 'template-parts/why', 'choose' );
				}

				// FAQ snippet
				if ( function_exists ( 'get_field' ) ) {
					?>
					<section class = 'pricing-faq'>
					<h2>Common Questions</h2>
					<?php
					if( have_rows('faq') ):
						while( have_rows('faq') ) : the_row();
							$faq_category_heading = get_sub_field('category_heading');
							?>
							<div class = 'faq-category'>
								<h3><?php echo $faq_category_heading?></h3>
								<hr>
								<?php
								while(have_rows('category')): the_row();
									?>
									<article class = 'faq-qa'>
									<?php
									$faq_question = get_sub_field('question');
									$faq_answer = get_sub_field('answer');
									echo "<h4>$faq_question</h4>";
									echo $faq_answer;
									?>
									</article>
									<?php
								endwhile;
							?>
							</div>
							<?php
						endwhile;
					endif;
					?>
					</section>
					<?php

					// CTA to FAQ page
					if ( get_field( 'cta_faq_link' ) ) {
						?>
						<section class='button-container'>
							<div class='button'><a target='_blank' href=' <?php echo get_field( 'cta_faq_link') ?>'>Check out our FAQs</a></div>
						</section>
						<?php
					}else{
						?>
						<section class='button-container'>
							<div class='button'><a target='_blank' href=' <?php echo get_permalink(51) ?>'>Read the FAQs</a></div>
						</section>
						<?php
					}
				}


			// <!-- Add ACF Option map -->
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
