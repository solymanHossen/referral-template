<?php
/**
 * Template Part: Onyx Hero Section View Module
 *
 * Renders the exact Onyx Referral Campaign Hero Section matching the target design:
 * - White "SHARE ONYX." + Gold "GET REWARDED." headline
 * - Crimson red background with glowing gold diagonal accent lines
 * - Tilted metallic Onyx Debit Card with chip, debossed signature & ASB brand
 * - Smooth bottom wave curve transition into white background
 *
 * @package ModularLandingPage
 * @version 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id      = get_the_ID();
$hero_tagline = get_post_meta( $post_id, '_landing_hero_tagline', true ) ?: 'THE ONYX REFERRAL CAMPAIGN';
$hero_title   = get_post_meta( $post_id, '_landing_hero_title', true ) ?: 'SHARE ONYX.<br><span class="onyx-hero__gold-text">GET REWARDED.</span>';
$hero_btn     = get_post_meta( $post_id, '_landing_hero_btn_text', true ) ?: 'REFER NOW';
?>

<section class="onyx-hero" aria-labelledby="onyx-hero-title">
	<!-- Geometric Gold Accent Lines in Background -->
	<div class="onyx-hero__bg-lines" aria-hidden="true">
		<svg width="100%" height="100%" viewBox="0 0 1440 550" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			<line x1="0" y1="520" x2="100" y2="340" stroke="#d4af37" stroke-width="2.5" opacity="0.85"/>
			<line x1="100" y1="340" x2="20" y2="600" stroke="#d4af37" stroke-width="1.5" opacity="0.6"/>
			<line x1="1120" y1="0" x2="1440" y2="320" stroke="#d4af37" stroke-width="1.8" opacity="0.75"/>
			<line x1="1260" y1="0" x2="1440" y2="520" stroke="#d4af37" stroke-width="1.5" opacity="0.55"/>
			<line x1="980" y1="0" x2="1440" y2="200" stroke="#d4af37" stroke-width="1.2" opacity="0.45"/>
		</svg>
	</div>

	<!-- Glowing Gold Accent Line at Bottom Left -->
	<div class="onyx-hero__left-glow-line" aria-hidden="true"></div>

	<div class="onyx-hero__container">
		<!-- Left: Text Content -->
		<div class="onyx-hero__content">
			<?php if ( ! empty( $hero_tagline ) ) : ?>
				<span class="onyx-hero__tagline">
					<?php echo esc_html( $hero_tagline ); ?>
				</span>
			<?php endif; ?>

			<?php if ( ! empty( $hero_title ) ) : ?>
				<h1 id="onyx-hero-title" class="onyx-hero__title">
					<?php echo wp_kses_post( $hero_title ); ?>
				</h1>
			<?php endif; ?>

			<?php if ( ! empty( $hero_btn ) ) : ?>
				<div class="onyx-hero__cta-wrap">
					<a href="#referral-form" class="onyx-hero__btn">
						<?php echo esc_html( $hero_btn ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<!-- Right: Realistic Vector Onyx Debit Card Visual -->
		<div class="onyx-hero__card-wrapper" aria-hidden="true">
			<div class="onyx-debit-card">
				<div class="onyx-debit-card__shine"></div>
				<div class="onyx-debit-card__surface">
					<!-- Big Script Watermark in Background -->
					<div class="onyx-debit-card__watermark-text">Onyx</div>
					
					<!-- EMV Gold Chip -->
					<div class="onyx-debit-card__chip">
						<div class="onyx-debit-card__chip-line"></div>
					</div>
					
					<!-- Card Footer: Debit Label & Signature Brand -->
					<div class="onyx-debit-card__footer">
						<span class="onyx-debit-card__debit-text">debit</span>
						<div class="onyx-debit-card__brand">
							<span class="onyx-debit-card__brand-signature">Onyx</span>
							<span class="onyx-debit-card__brand-sub">By ASB</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bottom Smooth Wave Transition to White Background -->
	<div class="onyx-hero__wave-bottom" aria-hidden="true">
		<svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 0 C480 75, 960 75, 1440 0 L1440 90 L0 90 Z" fill="#ffffff"/>
		</svg>
	</div>
</section>
