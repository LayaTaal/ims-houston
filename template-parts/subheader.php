<?php
/**
 * Page Subheader
 */

// Ensure the global $post variable is in scope
global $post;

// Setup ACF data
$hero_title       = get_field( 'slide_title' ) ?? '';
$hero_subtitle    = get_field( 'slide_subtitle' ) ?? '';
$hero_image_url   = get_field( 'slide_image' ) ?? '';
$hero_description = get_field( 'slide_description' ) ?? '';

global $featured_events;

// Retrieve the next featured event
$featured_events = tribe_get_events( [
	'start_date'     => 'now',
	'posts_per_page' => 3,
	'featured'       => true,
] );

// Retrieve the next 3 upcoming events
$events = tribe_get_events( [
	'posts_per_page' => - 1,
	'start_date'     => 'now',
] );

$slide_count = ( $hero_title || $hero_subtitle || $hero_description || $hero_image_url ) ? 1 : 0;

?>

<section class="subheader">
    <div id="featured-event-slides" class="zinnfinity-slider">
        <div class="slider-wrapper">
			<?php if ( $hero_title || $hero_subtitle || $hero_description || $hero_image_url ) : ?>
                <div class="featured-event zinnfinity-slider__slide slide-0">
					<?php if ( $hero_image_url ) : ?>
                        <div class="featured-event__image"
                             style="background-image: url(<?php echo esc_url( $hero_image_url ); ?>)"></div>
					<?php endif; ?>
                    <div class="featured-event__content">
						<?php if ( $hero_title || $hero_subtitle ) : ?>
                            <div class="featured-event-header">
								<?php if ( $hero_title ) : ?>
                                    <h3 class="featured-event__title"><?php echo esc_html( $hero_title ); ?></h3>
								<?php endif; ?>
								<?php if ( $hero_subtitle ) : ?>
                                    <span class="featured-event__date"><?php echo esc_html( $hero_subtitle ); ?></span>
								<?php endif; ?>
                            </div>
						<?php endif; ?>
						<?php if ( $hero_description ) : ?>
                            <div class="event-excerpt">
								<?php echo esc_html( $hero_description ); ?>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/event', 'featured' ); ?>

            <div class="zinnfinity-slider__toggle-slides">
				<?php
				for ( $i = 0; $i < count( $featured_events ) + $slide_count; $i ++ ) {
					echo '<span class="zinnfinity-toggle-control toggle-' . $i . '"></span>';
				}
				?>
                <!-- If we want previous / next slide controls
				<a class="left" onclick="previousSlide()">❮</a>
				<a class="right" onclick="nextSlide()">❯</a>
				-->
            </div>
        </div>
    </div>
</section>
