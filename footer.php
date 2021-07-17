<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Farm_to_Plate
 */

?>

	<footer id="colophon" class="site-footer">
		<?php
		$image = get_field( 'footer_logo','option' );
		if ( get_field( 'footer_logo','option' ) ) {
			?>
			<div class='footer-logo'>
			<a href="<?php the_permalink(20)?>">
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			</a>
			</div>
			<?php
		}
		?>
		
		<nav id="footer-navigation" class="footer-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
		</nav>

		<nav id="social-navigation" class="social-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
		</nav>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
