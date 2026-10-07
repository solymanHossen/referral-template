<?php
/**
 * Template Part: Support & Questions Grid Module
 *
 * Renders the 2-column info block with direct referral advice and ASB customer support info.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id        = get_the_ID();
$support1_title = get_post_meta( $post_id, '_landing_support1_title', true ) ?: 'Prefer to have your referral reach out directly?';
$support1_desc  = get_post_meta( $post_id, '_landing_support1_desc', true ) ?: 'Your referral can also mention your name when opening their Onyx account to make sure your referral is connected to you.';

$support2_title = get_post_meta( $post_id, '_landing_support2_title', true ) ?: 'Questions';
$support2_desc  = get_post_meta( $post_id, '_landing_support2_desc', true ) ?: 'Our ASB Team is here to help. Contact us to learn more about Onyx and the referral program.';
?>

<section class="onyx-support">
	<div class="onyx-support__container">
		
		<!-- Box 1 -->
		<div class="onyx-support-box">
			<div class="onyx-support-box__icon" aria-hidden="true">
				<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d4af37" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
					<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
					<circle cx="9" cy="7" r="4"></circle>
					<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
					<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
				</svg>
			</div>
			<div class="onyx-support-box__content">
				<h3 class="onyx-support-box__title"><?php echo esc_html( $support1_title ); ?></h3>
				<p class="onyx-support-box__desc"><?php echo esc_html( $support1_desc ); ?></p>
			</div>
		</div>

		<!-- Box 2 -->
		<div class="onyx-support-box">
			<div class="onyx-support-box__content">
				<h3 class="onyx-support-box__title"><?php echo esc_html( $support2_title ); ?></h3>
				<p class="onyx-support-box__desc"><?php echo esc_html( $support2_desc ); ?></p>
			</div>
		</div>

	</div>
</section>
