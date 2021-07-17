<?php
/**
 * The template for displaying the FAQ page
 *
 * This is the template that displays the FAQ page by default.
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

	<main id="primary" class="page-faq site-main">
		<?php 
		while ( have_posts() ) :
		the_post();
		?>
		<h1><?php the_title(); ?></h1>

		<?php
		if ( function_exists ( 'get_field' ) ) {
			?>
			<section class = 'faq'>
			<?php
			if( have_rows('faq') ):
				while( have_rows('faq') ) : the_row();
					$faq_category_heading = get_sub_field('category_heading');
					?>
					<button class = 'faq-category'>
						<h2><?php echo $faq_category_heading;?></h2>
					</button>

					<div class='faq-category-answers'>
						<?php
						while(have_rows('category')): the_row();
							?>
							<article class = 'faq-qa'>
							<?php
							$faq_question = get_sub_field('question');
							$faq_answer = get_sub_field('answer');
							echo "<h3>$faq_question</h3>";
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
			}

		// <!-- CTA -->
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
		

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
