<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zinnfinity
 */

?>

		</div><!-- /.site-content -->

		<!-- footer -->
		<footer class="footer" role="contentinfo">
			<div class="footer-1 footer-column">
				<?php if( is_active_sidebar('footer-widget-1') ) :
					dynamic_sidebar('footer-widget-1');
				endif; ?>
			</div>
			<div class="footer-2 footer-column">
				<?php if( is_active_sidebar('footer-widget-2') ) :
					dynamic_sidebar('footer-widget-2');
				endif; ?>
			</div>
			<div class="footer-end">
				<p class="footer-copyright">Copyright <?php echo date("Y"); ?>. Indian Music Society of Houston. All rights reserved.</p>
			</div>
		</footer>
		<!-- /footer -->

	</div><!-- .page-wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
