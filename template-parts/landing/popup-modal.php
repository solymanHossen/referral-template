<?php
/**
 * Template Part: Success Popup Modal Overlay
 *
 * Renders the interactive Dark Crimson & Gold referral submission success popup.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="onyx-popup-modal" class="onyx-popup" aria-hidden="true" role="dialog" aria-labelledby="onyx-popup-title">
	<div class="onyx-popup__backdrop" id="onyx-popup-close-backdrop"></div>
	<div class="onyx-popup__card">
		<!-- Close X Button -->
		<button type="button" class="onyx-popup__close-btn" id="onyx-popup-close-btn" aria-label="Close modal">
			&times;
		</button>

		<!-- Gold Checkmark Icon -->
		<div class="onyx-popup__icon-wrap">
			<svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22" stroke="#d4af37" stroke-width="2"/>
				<path d="M14 23.5L20 29.5L32 16.5" stroke="#d4af37" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>

		<!-- Title -->
		<h3 id="onyx-popup-title" class="onyx-popup__title">REFERRAL RECEIVED</h3>
		<div class="onyx-popup__line" aria-hidden="true"></div>

		<!-- Dynamic Body -->
		<p id="onyx-popup-message" class="onyx-popup__message">
			Thank you for submitting your referral. An ASB representative will reach out to your referral to get started.
		</p>
	</div>
</div>
