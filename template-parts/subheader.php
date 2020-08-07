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
    <div class="slider-wrapper">
      <div class="featured-event zinnfinity-slider__slide slide-0">
        <div class="featured-event__image" style="background-image: url(<?php echo get_template_directory_uri() . '/dist/images/2020-digital-season-promo.jpg' ?>)"></div>
        <div class="featured-event__content">
        <div class="featured-event-header">
            <h3 class="featured-event__title">Announcing Our 2020 Digital Season</h3>
            <span class="featured-event__date">Stay tuned!</span>
          </div> 
          <div class="event-excerpt">
            Bringing the world's great Indian classical artists to your home this Fall and Winter.
          </div>
        </div>
      </div>

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
  </div>
</section>