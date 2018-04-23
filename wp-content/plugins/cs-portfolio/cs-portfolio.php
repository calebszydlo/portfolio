<?php
/*
Plugin Name: CS Portfolio
Plugin URI: http://calebszydlo.com/
Description: Adds the Portfolio post type
Version: 1.0
Author: Caleb Szydlo
Author URI: http://calebszydlo.com/
*/

if( ! function_exists( 'portfolio_post_types' ) ):
	function portfolio_post_types() {
		$labels = array(
			'name' => _x('Portfolio', 'cs-portfolio'),
			'singular_name' => _x('Project', 'cs-project'),
			'add_new' => _x('Add New', 'cs-project'),
			'add_new_item' => __('Add New Project'),
			'edit_item' => __('Edit Project'),
			'new_item' => __('New Project'),
			'all_items' => __('All Portfolio'),
			'view_item' => __('View Project'),
			'search_items' => __('Search Portfolio'),
			'not_found' =>  __('No results found.'),
			'not_found_in_trash' => __('No results found in trash.'),
			'parent_item_colon' => '',
			'menu_name' => 'Portfolio'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'menu_position' => 4,
			'query_var' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'work' ),
			'hierarchical' => true,
			'supports' => array( 'title', 'thumbnail', 'revisions' ),
		);

		register_post_type('cs-portfolio', $args);

		$cat_labels = array(
			'name'              => _x( 'Portfolio Categories', 'portfolio-categories' ),
			'singular_name'     => _x( 'Category', 'portfolio-category' ),
			'search_items'      => __( 'Search Category' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category' ),
			'menu_name'         => __( 'Category' ),
		);

		$cat_args = array(
			'hierarchical'      => true,
			'labels'            => $cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'category', 'with_front' => true),
		);
		
		register_taxonomy( 'portfolio-categories', array( 'cs-portfolio'), $cat_args );

	}
	add_action( 'init', 'portfolio_post_types' );
endif;

function get_news_posts($args = array()) {
	$args['post_type'] = array('cs-portfolio');
	return get_posts($args);
}

function samaritan_news_categories($echo = true) {
	$news_args = array(
		'numbers' => true,
	);
	$news_terms = get_terms('portfolio-categories', $news_args);

	$output = '';
	if(!empty($news_terms)) {
		$output  = '<div class="category-list portfolio-categories">'."\n";
		$output .= '<ul>'."\n";
		foreach($news_terms as $term) {
			$output .= sprintf('<li><a href="%s">%s</a> (%d)</li>'."\n", get_term_link($term), $term->name, $term->count);
		}
		$output .= "</ul>\n";
		$output .= "</div>\n";
	}
	if($echo)
		echo $output;
	else
		return $output;
}