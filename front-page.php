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
      <?php get_template_part( 'template-parts/event', 'list' ); ?>
    </div>
  </main><!-- #main -->
  <?php get_sidebar() ?>
</div><!-- #primary -->

<?php
get_footer();
