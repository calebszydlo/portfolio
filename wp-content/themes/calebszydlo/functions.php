<?php
/**
 * Caleb Szydlo functions and definitions
 *
 * @package WordPress
 * @subpackage Caleb Szydlo
 * @since Calebszydlo 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see calebszydlo_content_width()
 *
 * @since Calebszydlo 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 617;
}

if ( ! function_exists( 'calebszydlo_setup' ) ) :
/**
 * Calebszydlo setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @since Calebszydlo 1.0
 */
function calebszydlo_setup() {

	add_image_size('order-thumbnail', 112, 144, true);

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'editor-style.css' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Global Navigation', 'calebszydlo' ),
		'secondary' => __( 'Mobile Navigation', 'calebszydlo' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	/*
	 * Enable featured image support.
	 * See http://codex.wordpress.org/Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // calebszydlo_setup
add_action( 'after_setup_theme', 'calebszydlo_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Calebszydlo 1.0
 */
function calebszydlo_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'calebszydlo_content_width' );


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Calebszydlo 1.0
 */
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that
function remove_wp_widget_recent_comments_style() {
	if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	}
}
add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );

function is_tree($pid) {
	global $post;
	if(is_page()&&($post->post_parent==$pid))
		return true;
	else
		return false;
};

function calebszydlo_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.js', false, '1.9.2');
	wp_enqueue_script('modernizr', home_url() . '/lib/modernizr/modernizr.min.js', false, '2.7.0');
	wp_enqueue_script('picturefill', home_url() .'/lib/picturefill/picturefill.js', false, '2.2.0');
	if(is_single()) {
		wp_enqueue_style('flexslider-css', home_url() . '/lib/flexslider/flexslider.css', array(), '1.0' );
		wp_enqueue_script('flexslider-js', home_url() . '/lib/flexslider/jquery.flexslider-min.js', false, '1.0');
	}
	wp_enqueue_style( 'calebszydlo-css', home_url() . '/css/main.css', array(), '1.0' );
	wp_enqueue_script('calebszydlo-js', home_url() . '/js/calebszydlo-custom.js', false, '1.0');
}
add_action( 'wp_enqueue_scripts', 'calebszydlo_scripts' );



/**
 * Extend the default WordPress body classes.
 *
 * @since Calebszydlo 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function calebszydlo_body_classes( $classes ) {
	return $classes;
}
add_filter( 'body_class', 'calebszydlo_body_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Calebszydlo 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function calebszydlo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'calebszydlo' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'calebszydlo_wp_title', 10, 2 );

// Local nav

function local_nav() {
	$current_page_info = current_page();

	global $post;
	$output = '';

	$args = array(
		'echo' => 0,
		'child_of' => $current_page_info[0],
	);

	$defaults = array(
		'depth' => 0, 'show_date' => '',
		'date_format' => get_option('date_format'),
		'child_of' => 0, 'exclude' => '',
		'title_li' => __('Pages'), 'echo' => 1,
		'authors' => '', 'sort_column' => 'menu_order, post_title',
		'link_before' => '', 'link_after' => '', 'walker' => '',
	);

	$args = wp_parse_args($args, $defaults);

	$pages = get_pages($args);
	$output = walk_page_tree($pages, 0, $current_page_info[1], $args);
	return $output;
}

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

function the_pagination(&$new_query = false) {
	global $wp_query;
	$current_query = $wp_query;
	if(is_object($new_query))
		$current_query = $new_query;
	$big = 999999999; // need an unlikely integer

	$output  = '<div class="pagination">'."\n";
	$output .= "<p>\n";
	$output .= paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $current_query->max_num_pages,
		'mid_size' => 2,
	) );
	$output .= "</p>\n";
	$output .= '</div>'."\n";
	echo $output;
}

function calebszydlo_button( $atts, $content ) {
	$a = shortcode_atts( array(
		'size' => 'button',
	), $atts );
	return '<span class="button">' . $content . '</span>';
}
add_shortcode( 'button', 'calebszydlo_button' );

function calebszydlo_text_link( $atts, $content ) {
	return "<p class='text-link'>$content</p>";
}
add_shortcode( 'text-link', 'calebszydlo_text_link' );

function parent_section($page) {
	$ancestors = get_post_ancestors($page);
	if(!is_array($ancestors)) return null;
	if(count($ancestors) <= 0) return $page; // Current page is parent section (returns ID)
	return array_pop($ancestors); // Last page in array is parent section (returns ID)    
}

//Add A Quote Icon to the Blockquote in the Content Area

/*
function add_quotes_to_quote( $content ) {
   $content = str_replace('<blockquote>','<blockquote><span class="quote">&ldquo;</span>', $content);
   return $content;
}
add_filter('the_content', 'add_quotes_to_quote');
*/



//Adding custom walker class for menus

class calebszydlo_global_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	    // depth dependent classes
	    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
	    $classes = array(
	        'global-nav--sub__list',
	        ( $display_depth >=2 ? 'global-nav--sub--sub__list' : '' ),
	        'global-depth-' . $display_depth
	        );
	    $class_names = implode( ' ', $classes );

	    // build html
	    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	// add main/sub classes to li's and links
		function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $wp_query;
	    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

	    // depth dependent classes
	    $depth_classes = array(
	        ( $depth == 0 ? 'global-nav__item' : 'global-nav--sub__item' ),
	        ( $depth >=2 ? 'global-nav--sub--sub__item' : '' ),
	        'global-item-depth-' . $depth
	    );
	    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

	    // passed classes
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	    // build html
	    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

	    // link attributes
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	    $attributes .= ' class="global-nav__link ' . ( $depth > 0 ? 'global-nav--sub__link' : 'global-menu-link' ) . '"';

	    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
	        $args->before,
	        $attributes,
	        $args->link_before,
	        apply_filters( 'the_title', $item->title, $item->ID ),
	        $args->link_after,
	        $args->after
	    );

	    // build html
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class calebszydlo_mobile_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	    // depth dependent classes
	    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
	    $classes = array(
	        'mobile-nav--sub__list',
	        ( $display_depth >=2 ? 'mobile-nav--sub--sub__list' : '' ),
	        'menu-depth-' . $display_depth
	        );
	    $class_names = implode( ' ', $classes );

	    // build html
	    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	// add main/sub classes to li's and links
		function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $wp_query;
	    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

	    // depth dependent classes
	    $depth_classes = array(
	        ( $depth == 0 ? 'mobile-nav__item' : 'mobile-nav--sub__item' ),
	        ( $depth >=2 ? 'mobile-nav--sub--sub__item' : '' ),
	        'menu-item-depth-' . $depth
	    );
	    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

	    // passed classes
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	    // build html
	    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

	    // link attributes
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	    $attributes .= ' class="mobile-nav__link ' . ( $depth > 0 ? 'global-nav--sub__link' : 'main-menu-link' ) . '"';

	    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
	        $args->before,
	        $attributes,
	        $args->link_before,
	        apply_filters( 'the_title', $item->title, $item->ID ),
	        $args->link_after,
	        $args->after
	    );

	    // build html
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

//Remove Menu pages

add_action( 'admin_menu', 'cs_remove_menu_pages' );

function cs_remove_menu_pages() {
	remove_menu_page('edit.php');
}

//Allow SVG Uploads

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//Check if page is a child

function is_child($pageID) {
	global $post;
	if( is_page() && ($post->post_parent==$pageID) ) {
		return true;
	} else {
		return false;
	}
}

//Custom validation for Contact Forms 7

add_filter( 'wpcf7_validate_text', 'your_validation_filter_func', 10, 2 );
add_filter( 'wpcf7_validate_text*', 'your_validation_filter_func', 10, 2 );

function your_validation_filter_func( $result, $tag ) {
	$type = $tag['type'];
	$name = $tag['name'];

	if ( 'your-id-number-field' == $name ) {
		$the_value = $_POST[$name];

		if ( is_not_valid_against_your_validation( $the_value ) ) {
			$result['valid'] = false;
			$result['reason'][$name] = "Test";
		}
	}

	return $result;
}


//add_filter( 'https_ssl_verify', '__return_false' );
