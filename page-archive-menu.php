<?php
/**
 * The template for displaying the archive Menu Page
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
			<?php
			$currentWeek = date('oW');

			// loop to get menu items
			$terms = get_terms(
				array(
					'taxonomy' 	=> 'farm-week',
					'orderby'   =>  'name',
					'order'     =>  'DESC',
				)
			);
			if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<section class='menu-container'>

				<?php
				foreach ( $terms as $term ) {
					$week = str_replace('-', '', $term->name);
					
					// format week numbers into year, month, and day 
					// code modified from http://www.expertphp.in/article/php-how-to-get-start-date-and-end-date-from-given-week-number-and-year
					$week_num = substr($week, -2, 2);
					$year = substr($week, 0, 4);
					$timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week_num * 7 * 24 * 60 * 60 );
					$timestampForMonday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
					$dateForMonday = date( 'F d, Y', $timestampForMonday );

					if($week >= $currentWeek){
						continue;
					}
					$args = array(
						'post_type' 		=> 'farm-dish',
						'posts_per_page' 	=> -1,
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> 'farm-week',
								'field' 	=> 'slug',
								'terms' 	=> $term->slug
							)

						)
					);


					$query = new WP_Query( $args );
					// loop output all the menu
					if ( $query -> have_posts() ){ ?>
						<section class='<?php echo $term->slug?>-list'>
						<h2>Week of <?php echo $dateForMonday; ?></h2>
							<div class = 'menu-list'>
							<?php
							while ( $query -> have_posts() ) {
								$query -> the_post();
							?>
								<article class='menu-item'>	
									<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
								</article>
							<?php 
							}
							?>
							</div>
						</section>

						<?php
						wp_reset_postdata();
					}
				}
				?>
				</section>
			<?php endif;
	
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
