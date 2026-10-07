<?php
/**
 * Template Part: Footer Legal Disclaimer Module
 *
 * Renders the dark crimson legal disclaimer fine print text at the page footer.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$disclaimer = get_post_meta( $post_id, '_landing_disclaimer', true ) ?: '*Offer is valid through November 15, 2026. The promotion is available to existing ASB customers with an active Onyx account who refer an individual who has not been an ASB customer within the previous 06 months. The referred individual must meet all applicable account-opening requirements. Limit one referral form per referring customer. Additional terms and conditions may apply.';
?>

<footer class="onyx-disclaimer">
	<div class="onyx-disclaimer__container">
		<p class="onyx-disclaimer__text">
			<?php echo esc_html( $disclaimer ); ?>
		</p>
	</div>
</footer>
