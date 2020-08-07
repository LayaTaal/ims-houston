<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zinnfinity
 */

get_header();

?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="frontpage-events">
      <h2>Upcoming Events</h2>
      <p>Due to the imact of COVID-19, IMS Houston has had to cancel our originally planned programs. 
      Please check back soon for our revised calendar which will feature digital performances by 
      professional musicians from India and the U.S. as well as unique programs to highlight Houston's own artists.
      </p> 
      <?php //get_template_part( 'template-parts/event', 'list' ); ?>
    </div>
  </main><!-- #main -->
  <?php get_sidebar() ?>
</div><!-- #primary -->

<?php
get_footer();
