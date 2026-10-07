<?php
/**
 * Template Part: Referral Form & Submission Section Module
 *
 * Renders the floating Dark Red "REFER A FRIEND" form box with AJAX handling,
 * inline validation, consent confirmation, dynamic thank you block, and bottom wave curve.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id        = get_the_ID();
$form_title     = get_post_meta( $post_id, '_landing_form_title', true ) ?: 'REFER A FRIEND';
$form_consent   = get_post_meta( $post_id, '_landing_form_consent', true ) ?: 'I confirm that I have the referral\'s consent to share their information with ASB for the purpose of the Onyx referral program.';
$form_btn_text  = get_post_meta( $post_id, '_landing_form_btn_text', true ) ?: 'REFER NOW';
$thankyou_title = get_post_meta( $post_id, '_landing_thankyou_title', true ) ?: 'THANK YOU FOR SUBMITTING YOUR REFERRAL';
$thankyou_sub   = get_post_meta( $post_id, '_landing_thankyou_sub', true ) ?: 'An ASB representative will reach out to your referral to get started.';
?>

<section id="referral-form" class="onyx-form-section">
	<div class="onyx-form-section__container">

		<!-- Floating Referral Form Card -->
		<div class="onyx-form-card">
			<div class="onyx-form-card__header">
				<span class="onyx-form-card__line"></span>
				<h2 class="onyx-form-card__title"><?php echo esc_html( $form_title ); ?></h2>
				<span class="onyx-form-card__line"></span>
			</div>

			<form id="onyx-ajax-referral-form" class="onyx-form" method="post" novalidate>
				<div class="onyx-form__alert" id="onyx-form-response" aria-live="polite"></div>

				<!-- Section: YOUR INFORMATION -->
				<div class="onyx-form__group">
					<h3 class="onyx-form__group-label">YOUR INFORMATION</h3>
					<div class="onyx-form__row">
						<div class="onyx-form__field">
							<input type="text" id="onyx_user_name" name="user_name" placeholder="Your Name *" required />
						</div>
						<div class="onyx-form__field">
							<input type="email" id="onyx_user_email" name="user_email" placeholder="Your Email *" required />
						</div>
						<div class="onyx-form__field">
							<input type="tel" id="onyx_user_phone" name="user_phone" placeholder="Your Phone *" required />
						</div>
					</div>
				</div>

				<!-- Section: REFERRAL'S INFORMATION -->
				<div class="onyx-form__group">
					<h3 class="onyx-form__group-label">REFERRAL'S INFORMATION</h3>
					<div class="onyx-form__row">
						<div class="onyx-form__field">
							<input type="text" id="onyx_ref_name" name="ref_name" placeholder="Referral's Name *" required />
						</div>
						<div class="onyx-form__field">
							<input type="email" id="onyx_ref_email" name="ref_email" placeholder="Referral's Email *" required />
						</div>
						<div class="onyx-form__field">
							<input type="tel" id="onyx_ref_phone" name="ref_phone" placeholder="Referral's Phone *" required />
						</div>
					</div>
				</div>

				<!-- Checkbox Consent -->
				<div class="onyx-form__consent-wrapper">
					<label class="onyx-form__checkbox-label">
						<input type="checkbox" id="onyx_consent" name="consent" value="1" required />
						<span class="onyx-form__checkbox-custom"></span>
						<span class="onyx-form__consent-text"><?php echo esc_html( $form_consent ); ?></span>
					</label>
				</div>

				<!-- Submit CTA Button -->
				<div class="onyx-form__submit-wrapper">
					<button type="submit" class="onyx-form__submit-btn" id="onyx-submit-btn">
						<span class="onyx-form__submit-text"><?php echo esc_html( $form_btn_text ); ?></span>
						<svg class="onyx-form__submit-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</button>
				</div>
			</form>
		</div>

		<!-- Thank You Confirmation Display -->
		<div class="onyx-thankyou-block" id="onyx-thankyou-section">
			<div class="onyx-thankyou-block__icon" aria-hidden="true">
				<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="24" cy="24" r="23" stroke="#d4af37" stroke-width="2"/>
					<path d="M15 24.5L21 30.5L33 17.5" stroke="#d4af37" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<h3 class="onyx-thankyou-block__title"><?php echo esc_html( $thankyou_title ); ?></h3>
			<p class="onyx-thankyou-block__sub"><?php echo esc_html( $thankyou_sub ); ?></p>
			<div class="onyx-thankyou-block__line" aria-hidden="true"></div>
		</div>

	</div>

	<!-- Wave Transition to Red Rewards Section -->
	<div class="onyx-form-section__wave-bottom" aria-hidden="true">
		<svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 40 C480 100, 960 0, 1440 50 L1440 90 L0 90 Z" fill="#580814"/>
		</svg>
	</div>
</section>
