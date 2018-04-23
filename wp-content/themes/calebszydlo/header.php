<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage Caleb Szydlo
 * @since Calebszydlo 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8">
<![endif]-->
<!--[if IE 9]>
<html class="ie9 ie-modern">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie-modern">
<![endif]-->
<!--[if !IE]><!-->
<html class="not-ie" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="Caleb Szydlo, web developer, graphic designer, illustrator and generally okay dude living and working in the Twin Cities of Minnesota." />
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php if(is_front_page() || is_archive()): ?>
<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<?php else: ?>
<meta property="og:title" content="<?php echo single_post_title(); ?>" />
<?php endif; ?>
<?php if(is_singular()): ?>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<?php endif; ?>
<meta property="og:image" content="<?php echo home_url(); ?>/images/facebook-calebszydlo.png" />
<meta property="og:image:width" content="200" />
<meta property="og:image:height" content="200" />
<?php wp_head(); ?>
<?php
global $add_header_js;
if(isset($add_header_js)): ?>
<script type="text/javascript">
<?php echo $add_header_js; ?>
</script>
<?php endif; ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60590034-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>

<div id="container">
<section class="test-grid row">
	<div class="row--truncated">
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
		<div class="row__cell row__cell--span1">
		</div> <!--Row Cell Span1-->
	</div> <!--Row Truncated-->
</section> <!--Test Grid-->

<header class="row row--header">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<div class="logo">
				<a class="logo__link" href="/"><img class="logo__mark" src="/images/logodark.svg" onerror="this.onerror=null; this.src='/images/logodark.png'" alt="Caleb Szydlo" /></a>
				<div class="logo__text">
					<h1 class="logo__title">Caleb Szydlo</h1>
					<p class="logo__tagline"><span class="nowrap">Web developer &amp; graphic designer</span></p>
				</div>
			</div><!--logo-->
			<nav class="global-nav mobile-hide">
				<?php
					$global_nav = wp_nav_menu( array( 	'menu' => 'Global Nav',
														'sort_column' => 'menu_order',
														'container' => false,
														'echo' => '0',
														'depth' => 1,
														'menu_class' => 'global-nav__list',
														'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
														'walker' => new calebszydlo_global_walker_nav_menu ) );
					echo $global_nav;
				?>
			</nav><!--.global-nav-->
		</div><!--.row cell span12-->
	</div><!--.row truncated-->
</header><!--.row header-->

<section class="row row--mobile-nav mobile-only">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12">
			<a class="mobile-nav__button" href="#mobile-nav">Menu</a>
			<nav class="mobile-nav__nav">
				<?php
					$global_nav = wp_nav_menu( array( 	'menu' => 'Mobile Nav',
														'sort_column' => 'menu_order',
														'container' => false,
														'echo' => '0',
														'depth' => 1,
														'menu_class' => 'mobile-nav__list',
														'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
														'walker' => new calebszydlo_mobile_walker_nav_menu ) );
					echo $global_nav;
				?>
			</nav>
		</div><!--.mobile-nav-->
	</div><!--.row truncated-->
</section><!--.row-->
