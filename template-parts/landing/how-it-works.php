<?php
/**
 * Template Part: "HOW IT WORKS" Section Module
 *
 * Renders the 3-step referral process matching the exact reference picture design:
 * - Title: "HOW IT WORKS" flanked by accent lines
 * - Step Numbers: 01, 02, 03 embedded inside horizontal divider lines
 * - Titles & Descriptions centered
 * - Outline CTA Button
 *
 * @package ModularLandingPage
 * @version 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id     = get_the_ID();
$how_title   = get_post_meta( $post_id, '_landing_how_title', true ) ?: 'HOW IT WORKS';

$step1_title = get_post_meta( $post_id, '_landing_step1_title', true ) ?: 'Tell a friend about Onyx';
$step1_desc  = get_post_meta( $post_id, '_landing_step1_desc', true ) ?: 'Share the benefits of your Onyx relationship with someone you think would enjoy the same experience.';

$step2_title = get_post_meta( $post_id, '_landing_step2_title', true ) ?: 'Submit their information';
$step2_desc  = get_post_meta( $post_id, '_landing_step2_desc', true ) ?: 'Complete the form below, and an ASB representative will reach out to your referral to help them get started.';

$step3_title = get_post_meta( $post_id, '_landing_step3_title', true ) ?: 'You both get rewarded';
$step3_desc  = get_post_meta( $post_id, '_landing_step3_desc', true ) ?: "Once your referral opens an eligible Onyx account, you'll both receive a 0.50% rate increase for 90 days.";

$hero_btn    = get_post_meta( $post_id, '_landing_hero_btn_text', true ) ?: 'REFER NOW';
?>

<section class="onyx-how">
	<div class="onyx-how__container">
		
		<!-- Section Header -->
		<div class="onyx-how__header">
			<span class="onyx-how__line" aria-hidden="true"></span>
			<h2 class="onyx-how__title"><?php echo esc_html( $how_title ); ?></h2>
			<span class="onyx-how__line" aria-hidden="true"></span>
		</div>

		<!-- 3 Steps Grid -->
		<div class="onyx-how__steps-grid">
			
			<!-- Step 01 -->
			<div class="onyx-step-card">
				<div class="onyx-step-card__divider">
					<span class="onyx-step-card__num">01</span>
				</div>
				<h3 class="onyx-step-card__title"><?php echo esc_html( $step1_title ); ?></h3>
				<p class="onyx-step-card__desc"><?php echo esc_html( $step1_desc ); ?></p>
			</div>

			<!-- Step 02 -->
			<div class="onyx-step-card">
				<div class="onyx-step-card__divider">
					<span class="onyx-step-card__num">02</span>
				</div>
				<h3 class="onyx-step-card__title"><?php echo esc_html( $step2_title ); ?></h3>
				<p class="onyx-step-card__desc"><?php echo esc_html( $step2_desc ); ?></p>
			</div>

			<!-- Step 03 -->
			<div class="onyx-step-card">
				<div class="onyx-step-card__divider">
					<span class="onyx-step-card__num">03</span>
				</div>
				<h3 class="onyx-step-card__title"><?php echo esc_html( $step3_title ); ?></h3>
				<p class="onyx-step-card__desc"><?php echo esc_html( $step3_desc ); ?></p>
			</div>

		</div>

		<!-- Bottom CTA -->
		<div class="onyx-how__cta-wrap">
			<a href="#referral-form" class="onyx-how__btn">
				<?php echo esc_html( $hero_btn ); ?>
			</a>
		</div>

	</div>
</section>
