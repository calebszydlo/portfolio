<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Duets
 * @since Duets 1.0
 */

get_header(); ?>

<?php
// Start the Loop.
$output = '';
while ( have_posts() ) : the_post();
	// Include the page content template.
	get_template_part( 'content', 'page' );
endwhile;
?>

<?php
get_footer();
