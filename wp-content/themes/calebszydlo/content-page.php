<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Calebszydlo
 * @since Calebszydlo 1.0
 */
?>

<?php
if(!isset($output)) {
	$output = '';
} else {
	global $output;
}
if(have_rows('panels')) {
	while(have_rows('panels')) : the_row();
		if(get_row_layout() == 'page_title'):
			// Page Title
			$output .= '<section class="row row--first row--text center">';
			$output .= '<div class="row--truncated">';
			$output .= '<div class="row__cell row__cell--span12">';
			$title = get_sub_field('title');
			$output .= sprintf('<h1 class="subpage-title">%s</h1><hr />', $title);
			$output .= get_sub_field('intro');
			$output .= '</div><!--.row cell span12-->';
			$output .= '</div><!--.row truncated-->';
			$output .= '</section><!--.row-->';
		elseif(get_row_layout() == 'image_text'):
			// Image & Text panel
			$content_span = 'span12';
			$placement = get_sub_field('stack');
			$stack = '';
			if ($placement) {
				if ($placement == 'first') {
					$stack = ' back-to-back--first';
				} elseif ($placement == 'middle') {
					$stack = ' back-to-back--middle';
				} elseif ($placement == 'last') {
					$stack =' back-to-back--last';
				}
			}
			$add_padding = get_sub_field('add_padding');
			$add_heading = get_sub_field('add_heading');
			$heading_text = get_sub_field('heading_text');
			$output .= sprintf('<section class="row row--text center%s">', $stack);
			$output .= '<div class="row--truncated">';
			$output .= sprintf('<div class="row__cell row__cell--%s first">', $content_span);
			if($add_padding) {
				$output .= '<div class="row__cell--inner">';
			}
			if($add_heading) {
				$heading_link = get_sub_field('heading_link');
				if($heading_link) {
					$heading_text = sprintf('<a href="%s">%s</a>', $heading_link, $heading_text);
				}
				$output .= sprintf('<h1>%s</h1>', $heading_text);
			}
			$output .= apply_filters('the_content', get_sub_field('editor'));
			if($add_padding) {
				$output .= '</div> <!--row cell inner-->';
			}
			$output .= sprintf('</div> <!--row cell %s-->', $content_span);
			$output .= '</div> <!--row truncated-->';
			$output .= '</section> <!--row text-->';
		elseif(get_row_layout() == '2_column'):
			// 2 Column panel
			$placement = get_sub_field('stack');
			$stack = '';
			if ($placement) {
				if ($placement == 'first') {
					$stack = ' back-to-back--first';
				} elseif ($placement == 'middle') {
					$stack = ' back-to-back--middle';
				} elseif ($placement == 'last') {
					$stack =' back-to-back--last';
				}
			}
			$add_heading = get_sub_field('add_heading');
			$heading_text = get_sub_field('heading_text');
			$output .= sprintf('<section class="row row--2-col center%s">', $stack);
			$output .= '<div class="row--truncated">';
			if($add_heading) {
				$output .= '<div class="row__cell row__cell--span12">';
				$heading_link = get_sub_field('heading_link');
				if($heading_link) {
					$heading_text = sprintf('<a href="%s">%s</a>', $heading_link, $heading_text);
				}
				$output .= sprintf('<h1>%s</h1><hr />', $heading_text);
				$output .= '</div><!--.row cell span12-->';
			}
			$type_left = get_sub_field('type_left');
			if($type_left == 'text') {
				$output .= '<div class="row__cell row__cell--span6 first">';
				$add_padding_left = get_sub_field('add_padding_left');
				if($add_padding_left) {
					$padding_left = get_sub_field('padding_left');
					$padding_class_left = '';
					if( in_array( 'top', $padding_left )) {
						$padding_class_left .= ' row__cell--inner--top';
					}
					if( in_array('bottom', $padding_left)) {
						$padding_class_left .= ' row__cell--inner--bottom';
					}
					if( in_array('side', $padding_left)) {
						$padding_class_left .= ' row__cell--inner';
					}
					$output .= sprintf('<div class="%s">', $padding_class_left);
				}
				$output .= get_sub_field('editor_left');
				if($add_padding_left) {
					$output .= '</div><!--.row cell inner-->';
				}
				$output .= '</div><!--.row cell span6-->';
			} elseif($type_left == 'image') {
				$output .= '<div class="row__cell row__cell--span6 row--2-col--img">';
				$image_left = get_sub_field('image_left');
				if(!empty($image_left) ) {
					$output .= sprintf('<img class="attachment-full" src="%s" alt="%s" />', $image_left['url'], $image_left['alt']);
				}
				$output .= '</div><!--.row cell span6-->';
			}
			$type_right = get_sub_field('type_right');
			if($type_right == 'text') {
				$output .= '<div class="row__cell row__cell--span6">';
				$add_padding_right = get_sub_field('add_padding_right');
				if($add_padding_right) {
					$padding_right = get_sub_field('padding_right');
					$padding_class_right = '';
					if( in_array( 'top', $padding_right)) {
						$padding_class_right .= ' row__cell--inner--top';
					}
					if( in_array('bottom', $padding_right)) {
						$padding_class_right .= ' row__cell--inner--bottom';
					}
					if( in_array('side', $padding_right)) {
						$padding_class_right .= ' row__cell--inner';
					}
					$output .= sprintf('<div class="%s">', $padding_class_right);
				}
				$output .= get_sub_field('editor_right');
				if($add_padding_right) {
					$output .= '</div><!--.row cell inner-->';
				}
				$output .= '</div><!--.row cell span6-->';
			} elseif($type_right == 'image') {
				$output .= '<div class="row__cell row__cell--span6 row--2-col--img">';
				$image_right = get_sub_field('image_right');
				if(!empty($image_right) ) {
					$output .= sprintf('<img class="attachment-full" src="%s" alt="%s" />', $image_right['url'], $image_right['alt']);
				}
				$output .= '</div><!--.row cell span6-->';
			}
			$output .= '</div><!--.row truncated-->';
			$output .= '</section><!--.row-->';
		elseif(get_row_layout() == 'grid'):
			// grid panel
			$placement = get_sub_field('stack');
			$stack = '';
			$space_mobile = '';
			if ($placement) {
				if ($placement == 'first') {
					$stack = ' back-to-back--first';
				} elseif ($placement == 'middle') {
					$stack = ' back-to-back--middle';
				} elseif ($placement == 'last') {
					$stack =' back-to-back--last';
				}
			}
			$hide_all = get_sub_field('hide_all_mobile');
			$space_all = get_sub_field('space_all_mobile');
			if ($hide_all) {
				$stack .= ' mobile-hide';
			}
			if ($space_all) {
				$space_mobile = ' mobile-space-bottom';
			}
			$output .= sprintf('<section class="row row--grid center%s">', $stack);
			$output .= '<div class="row--truncated">';
			if( have_rows('grid_cells') ):
				while ( have_rows('grid_cells') ) : the_row();
					$column_span = get_sub_field('column_span');
					$span = '';
					if ($column_span == 'one') {
						$span = ' row__cell--span4';
					} elseif ($column_span == 'two') {
						$span = ' row__cell--span8';
					} elseif ($column_span == 'three') {
						$span = ' row__cell--span12';
					}
					$hide_cell = get_sub_field('hide_cell_mobile');
					if ($hide_cell) {
						$span .= ' mobile-hide';
					}
					$output .= sprintf('<div class="row__cell%s%s">', $span, $space_mobile);
					$type = get_sub_field('type');
					if ($type == 'image') {
						$image = get_sub_field('image');
						$image_small = get_sub_field('image_small');
						if(!empty($image_small)) {
							$output .= sprintf('<span class="row--grid--full" data-picture data-class="row--grid--full" data-alt="%s">', $image['alt']);
							$output .= sprintf('<span data-src="%s"></span>', $image['url']);
							$output .= sprintf('<span data-src="%s" data-media="(max-width: 767px)"></span>', $image_small['url']);
							$output .= sprintf('<span data-src="%s" data-media="(min-width: 768px)"></span>', $image['url']);
							$output .= '<noscript>';
							$output .= sprintf('<img src="%s" alt="%s" />', $image['url'], $image['alt']);
							$output .= '</noscript>';
							$output .= '</span>';
						} else {
							$output .= sprintf('<img class="attachment-full" src="%s" alt="%s" />', $image['url'], $image['alt']);
						}

					} elseif ($type == 'text') {
						$output .= get_sub_field('editor');
					}
					$output .= '</div><!--.row cell-->';
				endwhile;
			endif;
			$output .= '</div><!--.row truncated-->';
			$output .= '</section><!--.row-->';
		endif;
	endwhile;
}
echo $output;
?>
