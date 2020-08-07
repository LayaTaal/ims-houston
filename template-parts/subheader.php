<?php
/**
 * Page Subheader
 */

// Ensure the global $post variable is in scope
global $post;
global $featured_events;

// Retrieve the next featured event
$featured_events = tribe_get_events( [ 
  'start_date'     => 'now',
  'posts_per_page' => 3, 
  'featured'       => true,
] );

// Retrieve the next 3 upcoming events
$events = tribe_get_events( [ 
  'posts_per_page' => -1, 
  'start_date'     => 'now',
] );

?>

<section class="subheader">
  <div id="featured-event-slides" class="zinnfinity-slider">
    <?php get_template_part( 'template-parts/event', 'featured' ); ?>
    <div class="zinnfinity-slider__toggle-slides">
      <?php
      for ( $i = 0; $i < count($featured_events); $i++ ) {
        echo '<span class="zinnfinity-toggle-control toggle-' . $i . '"></span>';
      }
      ?>
      <!-- If we want previous / next slide controls
      <a class="left" onclick="previousSlide()">❮</a>  
      <a class="right" onclick="nextSlide()">❯</a> 
      -->
    </div>
  </div>
</section>