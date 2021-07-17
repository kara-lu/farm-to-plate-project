<?php
/**
 * The template for displaying the social / featured in the news Page
 *
 * This is the template that displays the current Menu Page by default.
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

	<main id="primary" class="archive-menu site-main">
	<?php 
	while ( have_posts() ) :
			the_post();
	?>
		<h1><?php the_title(); ?></h1>
		<!-- Featured in news -->
		<?php
			// Output random list of Social 
			$args = array(
				'post_type'      => 'farm-social',
				'orderby'        => 'rand',
				'posts_per_page' => 4,
				);

				$query = new WP_Query( $args );
				if ( $query -> have_posts() ){
					?>
					<section class="social-archive">
					<?php
					while ($query-> have_posts() ){
						$query -> the_post();
						?>
						<article class='social-archive-item'>
						<?php
						the_post_thumbnail('medium');
						?>
							<div class="social-archive-content">
								<h2> <?php the_title();?> </h2>
								<?php
								the_content();
								?>
							</div>
						</article>
						<?php
					}
					wp_reset_postdata();
					?>
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
