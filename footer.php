<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BijBest
 */

?>

		</div><!-- close .row -->
	</div><!-- close #main -->

</div><!-- close .main-container -->

	<?php bb_footer_callout(); ?>

	<footer id="colophon" class="site-footer footer bg-dark" role="contentinfo">

		<?php // Substitute the class "container-fluid" below if you want a wider content area. ?>
		<div class="container">
			<div class="row">
				<?php get_sidebar( 'footer' ); ?>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<?php if ( '' != get_theme_mod( 'bb_footer_copyright' ) ) { ?>
					<div class="copyright-text"><?php echo esc_attr( get_theme_mod( 'bb_footer_copyright' ) ); ?></div>
					<?php } else { ?>
					<div class="footer-credits"><?php bb_footer_info(); ?></div>
					<?php }; ?>
				</div><!-- .site-info -->
				<div class="col-sm-6">
					<div class="pull-right">
						<?php bb_social_icons(); ?>
					</div>
				</div>
			</div>
		</div><!-- close .container -->

		<!-- Back to top link -->
		<a class="btn btn-default btn-sm fade-half back-to-top inner-link" href="#top"><i class="fa fa-angle-up fa-2x"></i></a>

	</footer><!-- close #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
