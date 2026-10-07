<?php
/**
 * Template Part: FDIC Notice Top Bar
 *
 * Displays FDIC-Insured notice at the top of the Onyx Referral Landing Page.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id   = get_the_ID();
$fdic_text = get_post_meta( $post_id, '_landing_fdic_text', true ) ?: 'FDIC-Insured - Backed by the full faith and credit of the U.S. Government';
?>

<div class="onyx-fdic-bar" role="banner">
	<div class="onyx-fdic-bar__container">
		<div class="onyx-fdic-bar__logo" aria-label="FDIC Logo">
			<svg width="68" height="24" viewBox="0 0 68 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect width="68" height="24" rx="2" fill="#003B6d"/>
				<text x="7" y="17" fill="#FFFFFF" font-family="Arial, sans-serif" font-weight="900" font-size="15" letter-spacing="1">FDIC</text>
			</svg>
		</div>
		<span class="onyx-fdic-bar__text">
			<?php echo esc_html( $fdic_text ); ?>
		</span>
	</div>
</div>
