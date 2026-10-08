<?php
/**
 * Template Part: Rewards Module ("MORE FOR YOU. MORE FOR THEM.")
 *
 * Renders the 2-column rewards breakdown matching the exact reference picture design:
 * - Left Column: Title, gold line, description paragraphs
 * - Middle: Vertical divider line
 * - Right Column: Intro text, 2 stat cards
 *
 * @package ModularLandingPage
 * @version 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id       = get_the_ID();
$rewards_title = get_post_meta( $post_id, '_landing_rewards_title', true ) ?: 'MORE FOR YOU.<br>MORE FOR THEM.';
$rewards_desc  = get_post_meta( $post_id, '_landing_rewards_desc', true ) ?: "As an Onyx customer, you already know the value of a premium banking relationship. Now, you can share the Onyx experience with a friend or family member - and you'll both get a little more in return.\n\nIt's our way of giving you both a little more for choosing Onyx.";

$reward1_label = get_post_meta( $post_id, '_landing_reward1_label', true ) ?: 'FOR YOU';
$reward1_val   = get_post_meta( $post_id, '_landing_reward1_val', true ) ?: '0.50%';
$reward1_sub   = get_post_meta( $post_id, '_landing_reward1_sub', true ) ?: 'You get a 0.50% rate increase for 90 days.';

$reward2_label = get_post_meta( $post_id, '_landing_reward2_label', true ) ?: 'FOR YOUR FRIEND';
$reward2_val   = get_post_meta( $post_id, '_landing_reward2_val', true ) ?: '0.50%';
$reward2_sub   = get_post_meta( $post_id, '_landing_reward2_sub', true ) ?: 'Your friend gets a 0.50% rate increase for 90 days.';
?>

<section class="onyx-rewards">
	<div class="onyx-rewards__container">
		
		<!-- Left Column: Title & Paragraphs -->
		<div class="onyx-rewards__info">
			<h2 class="onyx-rewards__title"><?php echo wp_kses_post( $rewards_title ); ?></h2>
			<div class="onyx-rewards__line" aria-hidden="true"></div>
			<div class="onyx-rewards__text">
				<?php echo nl2br( esc_html( $rewards_desc ) ); ?>
			</div>
		</div>

		<!-- Center Vertical Divider Line -->
		<div class="onyx-rewards__divider" aria-hidden="true"></div>

		<!-- Right Column: Intro & 2 Stat Cards -->
		<div class="onyx-rewards__cards-col">
			<p class="onyx-rewards__card-intro">When your referral opens an Onyx account:</p>
			
			<div class="onyx-rewards__grid">
				<!-- Stat Card 1 -->
				<div class="onyx-reward-card">
					<span class="onyx-reward-card__label"><?php echo esc_html( $reward1_label ); ?></span>
					<div class="onyx-reward-card__value"><?php echo esc_html( $reward1_val ); ?></div>
					<p class="onyx-reward-card__sub"><?php echo esc_html( $reward1_sub ); ?></p>
				</div>

				<!-- Stat Card 2 -->
				<div class="onyx-reward-card">
					<span class="onyx-reward-card__label"><?php echo esc_html( $reward2_label ); ?></span>
					<div class="onyx-reward-card__value"><?php echo esc_html( $reward2_val ); ?></div>
					<p class="onyx-reward-card__sub"><?php echo esc_html( $reward2_sub ); ?></p>
				</div>
			</div>
		</div>

	</div>
</section>
