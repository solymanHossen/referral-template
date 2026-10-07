<?php
/**
 * Template Name: Landing Page
 * Template Post Type: page
 *
 * Custom Page Template acting as the main controller for the modular, decoupled
 * Onyx Referral Campaign landing page. Bypasses default theme header to present
 * a clean, standalone landing page starting directly with the FDIC banner.
 *
 * @package ModularLandingPage
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<style>
		/* Ensure theme default header & footer wrappers are hidden on this template */
		header.wp-block-template-part,
		footer.wp-block-template-part,
		.site-header,
		.site-footer,
		.entry-header {
			display: none !important;
		}
		body {
			margin: 0 !important;
			padding: 0 !important;
			background-color: #ffffff !important;
		}
	</style>
</head>
<body <?php body_class( 'onyx-landing-page-body' ); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="landing-page onyx-landing" role="main">
	<?php
	while ( have_posts() ) :
		the_post();

		// 1. Top FDIC Banner
		get_template_part( 'template-parts/landing/header-fdic' );

		// 2. Hero Section
		get_template_part( 'template-parts/landing/hero' );

		// 3. Referral Form & Inline Confirmation
		get_template_part( 'template-parts/landing/referral-form' );

		// 4. Rewards Section ("MORE FOR YOU. MORE FOR THEM.")
		get_template_part( 'template-parts/landing/rewards' );

		// 5. How It Works Section
		get_template_part( 'template-parts/landing/how-it-works' );

		// 6. Support & Questions Grid
		get_template_part( 'template-parts/landing/support' );

		// 7. Footer Legal Disclaimer
		get_template_part( 'template-parts/landing/disclaimer' );

		// 8. Interactive Popup Modal
		get_template_part( 'template-parts/landing/popup-modal' );

	endwhile;
	?>
</main><!-- #primary -->

<!-- Client-side Interactive AJAX Form & Modal Controller -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('onyx-ajax-referral-form');
	const responseDiv = document.getElementById('onyx-form-response');
	const submitBtn = document.getElementById('onyx-submit-btn');
	const popup = document.getElementById('onyx-popup-modal');
	const popupMessage = document.getElementById('onyx-popup-message');
	const closeBtn = document.getElementById('onyx-popup-close-btn');
	const closeBackdrop = document.getElementById('onyx-popup-close-backdrop');

	function openPopup(msg) {
		if (popupMessage && msg) popupMessage.textContent = msg;
		if (popup) {
			popup.classList.add('is-active');
			popup.setAttribute('aria-hidden', 'false');
		}
	}

	function closePopup() {
		if (popup) {
			popup.classList.remove('is-active');
			popup.setAttribute('aria-hidden', 'true');
		}
	}

	if (closeBtn) closeBtn.addEventListener('click', closePopup);
	if (closeBackdrop) closeBackdrop.addEventListener('click', closePopup);

	if (form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();

			const userName = document.getElementById('onyx_user_name').value.trim();
			const userEmail = document.getElementById('onyx_user_email').value.trim();
			const userPhone = document.getElementById('onyx_user_phone').value.trim();
			const refName = document.getElementById('onyx_ref_name').value.trim();
			const refEmail = document.getElementById('onyx_ref_email').value.trim();
			const refPhone = document.getElementById('onyx_ref_phone').value.trim();
			const consent = document.getElementById('onyx_consent').checked;

			if (!userName || !userEmail || !refName || !refEmail) {
				showResponse('Please fill in all required fields marked with *.', 'error');
				return;
			}

			if (!consent) {
				showResponse('Please confirm consent before submitting.', 'error');
				return;
			}

			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.style.opacity = '0.7';
			}

			showResponse('Submitting referral...', 'info');

			const formData = new FormData();
			formData.append('action', 'submit_onyx_referral');
			formData.append('nonce', window.onyxReferralData ? window.onyxReferralData.nonce : '');
			formData.append('user_name', userName);
			formData.append('user_email', userEmail);
			formData.append('user_phone', userPhone);
			formData.append('ref_name', refName);
			formData.append('ref_email', refEmail);
			formData.append('ref_phone', refPhone);
			formData.append('consent', consent ? '1' : '0');

			const ajaxUrl = window.onyxReferralData ? window.onyxReferralData.ajax_url : '/wp-admin/admin-ajax.php';

			fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
			.then(res => res.json())
			.then(data => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.style.opacity = '1';
				}

				if (data.success) {
					form.reset();
					showResponse('', '');
					openPopup(data.data.message);
					
					// Display thank-you inline section
					const tyBlock = document.getElementById('onyx-thankyou-section');
					if (tyBlock) {
						tyBlock.classList.add('is-visible');
						tyBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
				} else {
					showResponse(data.data.message || 'An error occurred. Please try again.', 'error');
				}
			})
			.catch(err => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.style.opacity = '1';
				}
				showResponse('Network error. Please check your connection and try again.', 'error');
			});
		});
	}

	function showResponse(msg, type) {
		if (!responseDiv) return;
		if (!msg) {
			responseDiv.style.display = 'none';
			responseDiv.textContent = '';
			return;
		}
		responseDiv.style.display = 'block';
		responseDiv.className = 'onyx-form__alert onyx-form__alert--' + type;
		responseDiv.textContent = msg;
	}
});
</script>

<?php wp_footer(); ?>
</body>
</html>
