<?php
/**
 * Template part for displaying featured events on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zinnfinity
 */

global $featured_events;

// Loop through the events: set up each one as
// the current post then use template tags to
// display the title and content
$slide_index = 0;

foreach ( $featured_events as $post ) {
  setup_postdata( $post );
  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

  echo '<div class="featured-event zinnfinity-slider__slide slide-' . $slide_index . '">';
    echo '<div class="featured-event__image" style="background-image: url(' . $featured_img_url . ')">';
    echo '</div>';
    echo '<div class="featured-event__content">';
      echo '<div class="featured-event-header">';
        echo '<h3 class="featured-event__title">' . $post->post_title . '</h3>';
        echo '<span class="featured-event__date">' . tribe_get_start_date( $post ) . '</span>';
      echo '</div>'; 
      echo '<div class="event-excerpt">';
        echo $post->post_excerpt;

        // Display accompanists if we have any
        if ( get_field( 'accompanists' ) ):
          echo '<p class="event-accompanists">' . get_field( 'accompanists' ) . '</p>';
        endif;
      echo '</div>';

      // Display ticket button
      echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="btn btn--tickets btn--featured">Buy Tickets</a>';
    echo '</div>';
  echo '</div>';

  $i++;
}
?>