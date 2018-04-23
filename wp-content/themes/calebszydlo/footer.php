<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Calebszydlo
 * @since Calebszydlo 1.0
 */
?>

<footer class="row row--footer center">
	<div class="row--truncated">
		<div class="row__cell row__cell--span12 row--footer__content">
			<a class="footer__link" href="/"><img class="footer__img" src="/images/logolight.svg" onerror="this.onerror=null; this.src='/images/logolight.png'" alt="Caleb Szydlo" /></a>
			<p class="copyright">&copy; copyright <?php echo date("Y"); ?>, Caleb Szydlo Designs</p>
		</div> <!--.row cee span12-->
	</div><!--.row truncated-->
</footer><!--.row footer-->

</div> <!--Container-->
<?php wp_footer(); ?>
</body>
</html>