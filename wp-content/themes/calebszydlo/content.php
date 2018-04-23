<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Calebszydlo_Theme
 * @since Calebszydlo Theme 1.0
 */
?>

<section class="row row--first row--text center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<h1 class="subpage-title"><?php the_title(); ?></h1>
			<hr />
		</div> <!--.row cell span12-->
	</div> <!--.row truncated-->
</section> <!--.row-->

<section class="row center row--gallery">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<div class="row__cell--inner">
				<?php $images = get_field('gallery');
				if ($images && count($images) > 1): ?>
				<div class="flexslider">
					<ul class="slides">
						<?php foreach( $images as $image ): ?>
							<li>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							</li>
							<?php endforeach; ?>
					</ul>
				</div> <!--.flexslider-->
				<?php elseif($images && count($images == 1)): ?>
				<div class="gallery-solo">
					<?php foreach( $images as $image ): ?>
						<img class="attachment-full" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endforeach; ?>
				</div>
				<?php else: ?>
					<?php if(has_post_thumbnail()) {the_post_thumbnail( 'full' );} ?>
				<?php endif; ?>
				<?php if( get_field('visit_site_link') ) : ?>
				<span class="button"><a class="button__link" href="<?php echo get_field('visit_site_link'); ?>">View Live Site</a></span>
				<?php endif; ?>
				<hr />
			</div><!--.row cell inner-->
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</section><!--.row-->

<article class="row row--last row--2-col center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span6">
			<?php the_field('editor_left'); ?>
		</div><!--.row cell span6-->
		<div class="row__cell row__cell--span6">
			<?php the_field('editor_right'); ?>
		</div><!--.row cell span6-->
		<div class="row__cell row__cell--span12">
		<?php if(get_field('awards')): ?>
			<h2><span class="accent">Awards</span></h2>
			<hr />
			<ul>
				<?php while(has_sub_field('awards')): ?>
				<li><?php the_sub_field('award'); ?></li>
				<?php endwhile; ?>
			</ul>
			<hr />
		<?php endif; ?>
		<span class="button"><a class="button__link" href="/work/">Back to all projects</a></span>
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</article><!--.row-->


