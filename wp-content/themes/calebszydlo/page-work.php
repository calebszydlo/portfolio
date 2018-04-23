<?php
/**
 * The template for displaying Work page
 *
 * @package WordPress
 * @subpackage Calebszydlo
 * @since Calebszydlo 1.0
 */

get_header(); ?>

<section class="row row--first row--text center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<h1 class="subpage-title">My <span class="accent">Work</span></h1>
			<hr />
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->


<section class="row center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<?php
				global $more;
				$web_arr = array(
					'posts_per_page'	=> -1,
					'post_type'			=> 'cs-portfolio',
					'tax_query'			=> array(
						array(
							'taxonomy' 	=> 'portfolio-categories',
							'field'		=> 'slug',
							'terms' 	=> 'web'
							)
						),
					'orderby'			=> 'date'
				);
				$web_query = new WP_Query($web_arr);
				if ($web_query->have_posts()) : ?>
			<h2><span class="accent">Web</span></h2>
			<hr />
			<ul class="work-list">
				<?php while ($web_query->have_posts()) : $web_query->the_post(); $more = 0; ?>
				<li class="work-list__item">
					<a class="work-list__image" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) {the_post_thumbnail( 'full' );} ?></a>
					<a class="work-list__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>
			<hr />
			<?php endif; ?>
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->
<section class="row center back-to-back--last">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12 first">
			<?php
				global $more;
				$print_arr = array(
					'posts_per_page'	=> -1,
					'post_type'			=> 'cs-portfolio',
					'tax_query'			=> array(
						array(
							'taxonomy'	=> 'portfolio-categories',
							'field'		=> 'slug',
							'terms' 	=> 'print'
							)
						),
					'orderby'			=> 'date'
				);
				$print_query = new WP_Query($print_arr);
				if ($print_query->have_posts()) : ?>
			<h2><span class="accent">Print</span></h2>
			<hr />
			<ul class="work-list">
				<?php while ($print_query->have_posts()) : $print_query->the_post(); $more = 0; ?>
				<li class="work-list__item">
					<a class="work-list__image" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) {the_post_thumbnail( 'full' );} ?></a>
					<a class="work-list__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>
			<hr />
			<?php endif; ?>
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->











<?php
get_footer();