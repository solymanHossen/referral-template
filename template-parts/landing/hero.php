<?php
/**
 * Template Part: Onyx Hero Section View Module
 *
 * Renders the exact Onyx Referral Campaign Hero Section with dynamic image support:
 * - Tagline: "THE ONYX REFERRAL CAMPAIGN"
 * - Title: White "SHARE ONYX." + Gold "GET REWARDED."
 * - CTA Button: Dark Crimson with Gold Border ("REFER NOW")
 * - Background: Deep Crimson Red with crisp gold diagonal geometric lines
 * - Dynamic Card Visual: Renders uploaded custom PNG/JPG image or vector card fallback
 * - Bottom: Smooth convex wave curve transition into white background
 *
 * @package OnyxLandingTheme
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id      = get_the_ID();
$hero_tagline = get_post_meta( $post_id, '_landing_hero_tagline', true ) ?: 'THE ONYX REFERRAL CAMPAIGN';
$hero_title   = get_post_meta( $post_id, '_landing_hero_title', true ) ?: 'SHARE ONYX.<br><span class="onyx-hero__gold-text">GET REWARDED.</span>';
$hero_btn     = get_post_meta( $post_id, '_landing_hero_btn_text', true ) ?: 'REFER NOW';
$hero_img     = get_post_meta( $post_id, '_landing_hero_image_url', true );
?>

<section class="onyx-hero" aria-labelledby="onyx-hero-title">
	<!-- Background Diagonal Gold Geometric Lines -->
	<div class="onyx-hero__bg-lines" aria-hidden="true">
		<svg width="100%" height="100%" viewBox="0 0 1440 550" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			<!-- Bottom-Left Diagonal Accent Line -->
			<line x1="0" y1="520" x2="80" y2="280" stroke="#dfb746" stroke-width="2" opacity="0.9"/>
			<line x1="80" y1="280" x2="160" y2="550" stroke="#dfb746" stroke-width="1.2" opacity="0.6"/>

			<!-- Top-Right Diagonal Accent Lines Intersecting Card -->
			<line x1="1180" y1="0" x2="1440" y2="420" stroke="#dfb746" stroke-width="2" opacity="0.85"/>
			<line x1="1320" y1="0" x2="1440" y2="240" stroke="#dfb746" stroke-width="1.5" opacity="0.65"/>
			<line x1="1050" y1="0" x2="1440" y2="520" stroke="#dfb746" stroke-width="1" opacity="0.4"/>
		</svg>
	</div>

	<div class="onyx-hero__container">
		<!-- Left: Headline & CTA -->
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

		<!-- Right: Dynamic Hero Card Image or Vector Fallback -->
		<div class="onyx-hero__card-wrapper" aria-hidden="true">
			<?php if ( ! empty( $hero_img ) ) : ?>
				<div class="onyx-hero__card-image-wrap">
					<img src="<?php echo esc_url( $hero_img ); ?>" alt="Onyx Debit Card" class="onyx-hero__card-custom-img" />
				</div>
			<?php else : ?>
				<div class="onyx-debit-card">
					<div class="onyx-debit-card__surface">
						<!-- Cursive Script Watermark Signature in Background -->
						<div class="onyx-debit-card__watermark-text">Onyx</div>
						
						<!-- Gold EMV Microchip -->
						<div class="onyx-debit-card__chip">
							<div class="onyx-debit-card__chip-grid"></div>
						</div>
						
						<!-- Card Footer: "debit" & Signature "Onyx By ASB" -->
						<div class="onyx-debit-card__footer">
							<span class="onyx-debit-card__debit-text">debit</span>
							<div class="onyx-debit-card__brand">
								<span class="onyx-debit-card__brand-signature">Onyx</span>
								<span class="onyx-debit-card__brand-sub">By ASB</span>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Bottom Wave Curve Transition to White Background -->
	<div class="onyx-hero__wave-bottom" aria-hidden="true">
		<svg viewBox="0 0 1440 85" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 0 C480 65, 960 65, 1440 0 L1440 85 L0 85 Z" fill="#ffffff"/>
		</svg>
	</div>
</section>
