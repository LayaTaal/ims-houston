<?php
/**
 * Template Name: Membership
 *
 * The template for displaying the membership page
 *
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zinnfinity
 */

get_header();

$membership_product = get_field( 'membership_year' ) ?? '';
$form_link = get_field( 'membership_form_link' ) ?? '';

?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'apply' );

			endwhile; // End of the loop.
			?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <aside id="secondary">
		<?php if ( $membership_product ) : ?>
            <div class="apply-online">
                <h3>Apply Online</h3>
				<?php echo "<a href='" . wc_get_checkout_url() . " ?add-to-cart= " . $membership_product->ID . "' class='btn btn--featured btn--green'>Join Now!</a>"; ?>
            </div>
		<?php endif; ?>
        <?php if ( $form_link ) : ?>
            <div class="apply-by-mail">
                <h3>Apply By Mail</h3>
                <p>Mail your form along with your check for $100 made out to “IMS Houston” to the address below:</p>
                <p>Mr. Govind Shetty<br>
                    2210 Welch Street<br>
                    Houston, TX 77019</p>
				<?php echo "<a href='" . esc_url( $form_link ) . "'>Download Form</a>"; ?>
            </div>
		<?php endif; ?>
    </aside>

<?php
get_footer();
