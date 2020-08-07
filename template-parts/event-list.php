<?php
/**
 * Template part for displaying the event loop on the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zinnfinity
 */

// Retrieve the next 3 upcoming events
$events = tribe_get_events( [ 
  'posts_per_page' => -1, 
  'start_date'     => 'now',
] );

// Loop through the events: set up each one as
// the current post then use template tags to
// display the title and content
foreach ( $events as $post ) {
  setup_postdata( $post );

  $is_featured = Tribe__Events__Featured_Events::is_featured( $post );

  if ( ! $is_featured ) :

    // Determine if this is a free or paid event
    $ticket_type = ( tribe_get_cost() === '' ) ? 'More Info' : 'Buy Tickets';

    echo '<div class="frontpage-event">';
      echo '<div class="frontpage-event__image">';
        echo get_the_post_thumbnail( $post->ID, 'medium' );
      echo '</div>';
      echo '<div class="frontpage-event__content">';
        echo '<div class="event-header">';
          echo '<div class="event-header__title">';
            echo '<h3>' . $post->post_title . '</h3>';
            echo '<span class="event-header__date">' . tribe_get_start_date( $post ) . '</span>';
          echo '</div>';
          echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="btn btn--tickets">' . $ticket_type . '</a>';
        echo '</div>'; 
        echo '<div class="event-excerpt">';
          echo $post->post_excerpt;
        echo '</div>';
        
        // Display accompanists if we have any
        if ( get_field( 'accompanists' ) ):
          echo '<p class="event-accompanists">' . get_field( 'accompanists' ) . '</p>';
        endif;

      echo '</div>';
    echo '</div>';

  endif;
}
?>