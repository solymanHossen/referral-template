<?php
/**
 * Template Part: Footer Legal Disclaimer & Bottom Footer Bar Module
 *
 * Renders the dark crimson legal disclaimer fine print text and the bottom
 * dark footer bar with Andover State Bank copyright and FDIC/Equal Housing Lender badges
 * matching the exact reference picture design.
 *
 * @package ModularLandingPage
 * @version 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$disclaimer = get_post_meta( $post_id, '_landing_disclaimer', true ) ?: '*Offer is valid through November 15, 2026. The promotion is available to existing ASB customers with an active Onyx account who refer an individual who has not been an ASB customer within the previous six months. The referred individual must meet all applicable account-opening requirements. Limit one referral bonus per referring customer. Additional terms and conditions may apply.';
?>

<footer class="onyx-footer-group">
	<!-- Top Red Disclaimer Section -->
	<div class="onyx-disclaimer">
		<div class="onyx-disclaimer__container">
			<p class="onyx-disclaimer__text">
				<?php echo esc_html( $disclaimer ); ?>
			</p>
		</div>
	</div>

	<!-- Bottom Dark Footer Bar -->
	<div class="onyx-footer-bottom">
		<div class="onyx-footer-bottom__container">
			<div class="onyx-footer-bottom__copyright">
				&copy; <?php echo date( 'Y' ); ?> Andover State Bank. All Rights Reserved.
			</div>
			<div class="onyx-footer-bottom__badges">
				<!-- Member FDIC Badge -->
				<div class="onyx-fdic-badge">
					<span class="onyx-fdic-badge__sub">Member</span>
					<span class="onyx-fdic-badge__main">FDIC</span>
				</div>

				<!-- Equal Housing Lender Badge -->
				<div class="onyx-lender-badge" aria-label="Equal Housing Lender">
					<svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
						<path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 4.5l5 4.5v7H7v-7l5-4.5z"/>
						<rect x="9" y="14" width="6" height="1.5"/>
						<rect x="9" y="16.5" width="6" height="1.5"/>
					</svg>
					<span class="onyx-lender-badge__text">EQUAL HOUSING<br>LENDER</span>
				</div>
			</div>
		</div>
	</div>
</footer>
