<?php
/**
 * The template for displaying a single dish
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Farm_to_Plate
 */

get_header();
?>

	<main id="primary" class="single-dish site-main">

		<section class='banner'>
			<div class='inner-banner'>
				<?php
						while ( have_posts() ) :
							the_post();
						the_title( '<h1 class="dish-title">', '</h1>' );
						the_post_thumbnail('large');
						$terms = get_the_terms( $post->ID, 'farm-type' );
						foreach($terms as $term){
							?>
							<p><?php $term->name ?></p>
							<?php
						}
						?>
			</div>
			<?php
			if ( function_exists ( 'get_field' ) ) {
			?>
				<article class='dish-info-icon'>
					<!-- add ACF -->
					<?php
						if ( get_field( 'flavour_notes' ) ) {
							?>
							<figure class = 'flavour_notes'>
							<?php
							if(get_field('flavour_notes') === "mild"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/mild.png" alt="mild flavour">
								<?php
								
							}else if(get_field('flavour_notes') === "medium"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/medium.png" alt="medium spicy flavour">
								<?php
							}else if(get_field('flavour_notes') === "hot"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/spicy.png" alt="spicy flavour">
								<?php
							}
							?>
								</figure>
							<?php
						}

						if ( get_field( 'time' ) ) {
							?>
							<figure class = 'time'>
							<?php
							if(get_field('time') === "15 min"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/15min.png" alt="15 min to cook">
								<?php
							}else if(get_field('time') === "30 min"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/30min.png" alt="30 min to cook">
								<?php
							}else if(get_field('time') === "1 hr"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/1hr.png" alt="1 hour to cook">
								<?php
							}
							?>
							</figure>
							<?php
						}

						if ( get_field( 'difficulty' ) ) {
							?>
							<figure class = 'difficulty'>
							<?php
							if(get_field('difficulty') === "beginner"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/beginner.png" alt="beginner skill level to cook">
								<?php
							}else if(get_field('difficulty') === "intermediate"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/intermediate.png" alt="intermediate skill level to cook">
								<?php
							}else if(get_field('difficulty') === "expert"){
								?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/expert.png" alt="expert skill level to cook">
								<?php
							}
							?>
								</figure>
								<?php
						}
					?>
				</article>
			<?php
			}
			?>
		</section>

		<?php
		if ( function_exists ( 'get_field' ) ) {
		?>
			<section class="ingredients">
				<h2 class="ingredients-title">Ingredients</h2>
				<?php
				if( have_rows('what_we_deliver') ):
				?>
					<section class="deliver">
						<h3>What We Deliver</h3>
						<?php
							while( have_rows('what_we_deliver') ) : the_row();
								$sub_value_img = wp_get_attachment_image( get_sub_field('ingredient_image'), 'full', '', array( 'class' => '' ));
								$sub_value_text = get_sub_field('ingredient_name');
								?>
								<article class = 'deliver-item'>
								<?php echo $sub_value_img; ?>
								<p><?php echo $sub_value_text ?></p>
								</article>

						<?php	endwhile; ?>
					</section>
				<?php
				endif;
				if( have_rows('what_you_need') ):
				?>
					<section class="need">
						<h3>What You Need</h3>
						<ul>
						<?php
							while( have_rows('what_you_need') ) : the_row();
								$sub_value_text = get_sub_field('ingredients_and_tools');
						?>
									<li class = 'need-item'>
									<?php echo "$sub_value_text" ?>
									</li>
						<?php	endwhile;
						?>
						</ul>
					</section>
				<?php
				endif;
				?>

				<table class="nutrition">
					<thead>
					<tr><th colspan="2">Nutrition Facts</th></tr>
					</thead>
					<tbody>
					<?php
					if ( get_field( 'calories' ) ) {
						$field = get_field_object('calories');
						?>
						<tr class="<?php echo $field['name']; ?> nutrition-item">
							<td><?php echo $field['label']; ?></td> 
							<td><?php echo $field['value']; ?></td>
							</tr>	
					<?php
					}
					?>

					<?php
					if ( get_field( 'total_fat' ) ) {
						$field = get_field_object('total_fat');
						?>
						<tr class="<?php echo $field['name']; ?> nutrition-item">
							<td><?php echo $field['label']; ?></td> 
							<td><?php echo $field['value']; ?></td>
							</tr>	
					<?php
					}
					?>

					<?php
					if ( get_field( 'protein' ) ) {
						$field = get_field_object('protein');
						?>
						<tr class="<?php echo $field['name']; ?> nutrition-item">
							<td><?php echo $field['label']; ?></td> 
							<td><?php echo $field['value']; ?></td>
							</tr>	
					<?php
					}
					?>

					<?php
					if ( get_field( 'carbohydrate' ) ) {
						$field = get_field_object('carbohydrate');
						?>
						<tr class="<?php echo $field['name']; ?> nutrition-item">
							<td><?php echo $field['label']; ?></td> 
							<td><?php echo $field['value']; ?></td>
							</tr>	
					<?php
					}
					?>

					<?php
					if ( get_field( 'sodium' ) ) {
						$field = get_field_object('sodium');
						?>
						<tr class="<?php echo $field['name']; ?> nutrition-item">
							<td><?php echo $field['label']; ?></td> 
							<td><?php echo $field['value']; ?></td>
							</tr>	
					<?php
					}
					?>

					<?php
					if( have_rows('nutrients') ):
						$field = get_field_object('nutrients');	
								while( have_rows('nutrients') ) : the_row();
									$sub_value_label = get_sub_field('label');
									$sub_value_value = get_sub_field('value');
									$sub_value_name = get_sub_field('name');
									
									?>
									<tr class="nutrients-item">
									<?php
										echo "<td>$sub_value_label</td>";
										echo "<td>$sub_value_value</td>";
									echo "</tr>";
								endwhile;
					endif;

					if ( get_field( 'allergen' ) ) {
						$field = get_field_object('allergen');
						?>
						<tr class="<?php echo $field['name']; ?>">
							<th colspan="2"><?php echo $field['label']; ?> Info</th> 
						</tr>
						<tr class="<?php echo $field['name']; ?>">
							<td colspan="2"><?php echo $field['value']; ?></td>
						</tr>

					<?php	
					}
					?>

				</tbody>
				</table>
			</section>
		<?php
		}
		?>

		<?php
		if ( function_exists ( 'get_field' ) ) {
		?>
				<?php
				if( have_rows('cooking_directions') ):
				?>
					<section class="cooking-directions">
						<h2>Cooking Directions</h2>
						<?php
							while( have_rows('cooking_directions') ) : the_row();
								$sub_value_img = wp_get_attachment_image( get_sub_field('image'), 'medium', '', array( 'class' => '' ));
								$sub_value_step = get_sub_field('step');
								$sub_value_text_area = get_sub_field('text_area');
						?>
								<article class = 'cooking-steps'>
									<?php echo $sub_value_img; ?>
									<div><h3><?php echo $sub_value_step ?> </h3>
									<?php echo $sub_value_text_area ?></div>
								</article>
						<?php	endwhile;
						?>
					</section>
				<?php
				endif;
				?>
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
