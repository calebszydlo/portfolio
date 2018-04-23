<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Calebszydlo
 * @since Calebszyldo's Theme 1.0
 */

get_header(); ?>


<section class="row row--first row--text center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<h1 class="subpage-title"><span class="accent">Whoops!</span></h1>
			<hr />
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->

<section class="row row--last row--text center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<h2>404 error</h2>
			<p>Looks like you&rsquo;re off the map, chief.</p>
			<span class="button"><a href="/" class="button__link">Back Home</a></span>
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->


<?php

get_footer();