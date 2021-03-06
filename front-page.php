<?php
/**
 * The template for displaying the front page
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zinnfinity
 */

get_header();

// Check if we have any upcoming events.
$events = tribe_get_events( [
	'posts_per_page' => 3,
    'start_date'     => 'now',
    'featured'       => false,
] );

?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
			<?php if ( $events ) : ?>
                <div class="frontpage-events">
                    <h2>Upcoming Events</h2>
					<?php get_template_part( 'template-parts/event', 'list' ); ?>
                </div>
			<?php endif; ?>
            <?php wp_reset_postdata(); ?>
			<?php the_content(); ?>
        </main><!-- #main -->
		<?php get_sidebar() ?>
    </div><!-- #primary -->

<?php
get_footer();
