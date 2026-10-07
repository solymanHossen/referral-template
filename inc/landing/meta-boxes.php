<?php
/**
 * Landing Page Custom Meta Boxes Engine & Form Handler
 *
 * Premium, modern tabbed admin interface registering native WordPress meta boxes for
 * the Onyx Referral Campaign landing page. Includes image upload controls (wp_enqueue_media),
 * nonces, capability checks, autosave guards, sanitization, asset enqueuing, and AJAX form handler.
 *
 * @package OnyxLandingTheme
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue Media Uploader Assets in Admin
 */
function landing_admin_media_assets( $hook ) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'landing_admin_media_assets' );

/**
 * Register Meta Box for Onyx Landing Page Settings
 *
 * @return void
 */
function landing_register_onyx_meta_boxes() {
	add_meta_box(
		'landing_onyx_page_meta_box',
		__( 'Onyx Referral Campaign - Control Panel', 'textdomain' ),
		'landing_render_onyx_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'landing_register_onyx_meta_boxes' );

/**
 * Render Modern Tabbed Admin Meta Box UI
 *
 * @param WP_Post $post Current post object.
 * @return void
 */
function landing_render_onyx_meta_box( $post ) {
	// Nonce field for security verification
	wp_nonce_field( 'landing_onyx_meta_box_save_action', 'landing_onyx_meta_box_nonce' );

	// Fetch all meta fields with defaults
	$fdic_text      = get_post_meta( $post->ID, '_landing_fdic_text', true ) ?: 'FDIC-Insured - Backed by the full faith and credit of the U.S. Government';
	$hero_tagline   = get_post_meta( $post->ID, '_landing_hero_tagline', true ) ?: 'THE ONYX REFERRAL CAMPAIGN';
	$hero_title     = get_post_meta( $post->ID, '_landing_hero_title', true ) ?: 'SHARE ONYX.<br><span class="onyx-hero__gold-text">GET REWARDED.</span>';
	$hero_btn_text  = get_post_meta( $post->ID, '_landing_hero_btn_text', true ) ?: 'REFER NOW';
	$hero_img_url   = get_post_meta( $post->ID, '_landing_hero_image_url', true );

	$form_title     = get_post_meta( $post->ID, '_landing_form_title', true ) ?: 'REFER A FRIEND';
	$form_consent   = get_post_meta( $post->ID, '_landing_form_consent', true ) ?: 'I confirm that I have the referral\'s consent to share their information with ASB for the purpose of the Onyx referral program.';
	$form_btn_text  = get_post_meta( $post->ID, '_landing_form_btn_text', true ) ?: 'REFER NOW';

	$thankyou_title = get_post_meta( $post->ID, '_landing_thankyou_title', true ) ?: 'THANK YOU FOR SUBMITTING YOUR REFERRAL';
	$thankyou_sub   = get_post_meta( $post->ID, '_landing_thankyou_sub', true ) ?: 'An ASB representative will reach out to your referral to get started.';

	$rewards_title  = get_post_meta( $post->ID, '_landing_rewards_title', true ) ?: 'MORE FOR YOU.<br>MORE FOR THEM.';
	$rewards_desc   = get_post_meta( $post->ID, '_landing_rewards_desc', true ) ?: "As an Onyx customer, you already know the value of a premium banking relationship. Now, you can share the Onyx experience with a friend or family member - and you'll both get a little more in return.\n\nIt's our way of giving you both a little more for choosing Onyx.";
	
	$reward1_label  = get_post_meta( $post->ID, '_landing_reward1_label', true ) ?: 'FOR YOU';
	$reward1_val    = get_post_meta( $post->ID, '_landing_reward1_val', true ) ?: '0.50%';
	$reward1_sub    = get_post_meta( $post->ID, '_landing_reward1_sub', true ) ?: 'You get a 0.50% rate increase for 90 days.';

	$reward2_label  = get_post_meta( $post->ID, '_landing_reward2_label', true ) ?: 'FOR YOUR FRIEND';
	$reward2_val    = get_post_meta( $post->ID, '_landing_reward2_val', true ) ?: '0.50%';
	$reward2_sub    = get_post_meta( $post->ID, '_landing_reward2_sub', true ) ?: 'Your friend gets a 0.50% rate increase for 90 days.';

	$how_title      = get_post_meta( $post->ID, '_landing_how_title', true ) ?: 'HOW IT WORKS';
	$step1_title    = get_post_meta( $post->ID, '_landing_step1_title', true ) ?: 'Tell a friend about Onyx';
	$step1_desc     = get_post_meta( $post->ID, '_landing_step1_desc', true ) ?: 'Share the benefits of your Onyx relationship with someone you think would enjoy the same experience.';

	$step2_title    = get_post_meta( $post->ID, '_landing_step2_title', true ) ?: 'Submit their information';
	$step2_desc     = get_post_meta( $post->ID, '_landing_step2_desc', true ) ?: 'Complete the form above and an ASB representative will reach out to your referral to help them get started.';

	$step3_title    = get_post_meta( $post->ID, '_landing_step3_title', true ) ?: 'You both get rewarded';
	$step3_desc     = get_post_meta( $post->ID, '_landing_step3_desc', true ) ?: "Once your referral opens an eligible Onyx account, you'll both receive a 0.50% rate increase for 90 days.";

	$support1_title = get_post_meta( $post->ID, '_landing_support1_title', true ) ?: 'Prefer to have your referral reach out directly?';
	$support1_desc  = get_post_meta( $post->ID, '_landing_support1_desc', true ) ?: 'Your referral can also mention your name when opening their Onyx account to make sure your referral is connected to you.';

	$support2_title = get_post_meta( $post->ID, '_landing_support2_title', true ) ?: 'Questions';
	$support2_desc  = get_post_meta( $post->ID, '_landing_support2_desc', true ) ?: 'Our ASB Team is here to help. Contact us to learn more about Onyx and the referral program.';

	$disclaimer     = get_post_meta( $post->ID, '_landing_disclaimer', true ) ?: '*Offer is valid through November 15, 2026. The promotion is available to existing ASB customers with an active Onyx account who refer an individual who has not been an ASB customer within the previous 06 months. The referred individual must meet all applicable account-opening requirements. Limit one referral form per referring customer. Additional terms and conditions may apply.';
	?>

	<style>
		/* Modern Admin UI Design System */
		.onyx-panel-wrap {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
			background: #ffffff;
			border: 1px solid #e2e8f0;
			border-radius: 10px;
			box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
			overflow: hidden;
			margin-top: 10px;
		}

		.onyx-panel-header {
			background: linear-gradient(135deg, #5d0815 0%, #3a040b 100%);
			padding: 20px 24px;
			color: #ffffff;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.onyx-panel-title {
			font-size: 16px;
			font-weight: 800;
			letter-spacing: 0.05em;
			text-transform: uppercase;
			margin: 0;
			color: #ffffff;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.onyx-panel-badge {
			background: #dfb746;
			color: #1a1a1a;
			font-size: 11px;
			font-weight: 800;
			padding: 3px 10px;
			border-radius: 20px;
			text-transform: uppercase;
		}

		/* Tab Navigation Bar */
		.onyx-panel-tabs {
			display: flex;
			background: #f8fafc;
			border-bottom: 1px solid #e2e8f0;
			padding: 0 10px;
			gap: 4px;
		}

		.onyx-tab-btn {
			padding: 12px 18px;
			font-size: 13px;
			font-weight: 600;
			color: #64748b;
			background: transparent;
			border: none;
			border-bottom: 3px solid transparent;
			cursor: pointer;
			transition: all 0.2s ease;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.onyx-tab-btn:hover {
			color: #5d0815;
			background: rgba(93, 8, 21, 0.03);
		}

		.onyx-tab-btn.is-active {
			color: #5d0815;
			border-bottom-color: #5d0815;
			font-weight: 700;
			background: #ffffff;
		}

		/* Tab Content Panels */
		.onyx-panel-body {
			padding: 24px;
		}

		.onyx-tab-content {
			display: none;
		}

		.onyx-tab-content.is-active {
			display: block;
			animation: onyxFadeIn 0.3s ease;
		}

		@keyframes onyxFadeIn {
			from { opacity: 0; transform: translateY(4px); }
			to { opacity: 1; transform: translateY(0); }
		}

		/* Card Section Containers */
		.onyx-card-box {
			background: #f8fafc;
			border: 1px solid #e2e8f0;
			border-radius: 8px;
			padding: 18px;
			margin-bottom: 18px;
		}

		.onyx-card-box:last-child {
			margin-bottom: 0;
		}

		.onyx-card-heading {
			font-size: 13px;
			font-weight: 700;
			color: #334155;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			margin: 0 0 14px 0;
			padding-bottom: 8px;
			border-bottom: 1px solid #cbd5e1;
		}

		/* Form Fields */
		.onyx-field-group {
			margin-bottom: 14px;
		}

		.onyx-field-group:last-child {
			margin-bottom: 0;
		}

		.onyx-field-group label {
			display: block;
			font-weight: 600;
			color: #0f172a;
			margin-bottom: 5px;
			font-size: 13px;
		}

		.onyx-field-group input[type="text"],
		.onyx-field-group input[type="url"],
		.onyx-field-group textarea {
			width: 100%;
			padding: 9px 12px;
			border: 1px solid #cbd5e1;
			border-radius: 6px;
			font-size: 13px;
			background: #ffffff;
			transition: all 0.2s ease;
		}

		.onyx-field-group input[type="text"]:focus,
		.onyx-field-group input[type="url"]:focus,
		.onyx-field-group textarea:focus {
			border-color: #5d0815;
			outline: none;
			box-shadow: 0 0 0 2px rgba(93, 8, 21, 0.15);
		}

		.onyx-field-desc {
			font-size: 12px;
			color: #64748b;
			margin: 4px 0 0 0;
			font-style: italic;
		}

		/* Grid Layout Helpers */
		.onyx-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
		.onyx-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

		@media (max-width: 782px) {
			.onyx-grid-2, .onyx-grid-3 { grid-template-columns: 1fr; }
			.onyx-panel-tabs { flex-wrap: wrap; }
		}

		/* Media Uploader Styling */
		.onyx-media-wrap {
			display: flex;
			gap: 16px;
			align-items: center;
			margin-top: 8px;
		}

		.onyx-media-preview-box {
			width: 200px;
			height: 120px;
			border-radius: 8px;
			border: 2px dashed #cbd5e1;
			background: #ffffff;
			display: flex;
			align-items: center;
			justify-content: center;
			overflow: hidden;
		}

		.onyx-media-preview-box img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
	</style>

	<div class="onyx-panel-wrap">
		<!-- Header Banner -->
		<div class="onyx-panel-header">
			<h3 class="onyx-panel-title">
				<span>Onyx Referral Campaign</span>
			</h3>
			<span class="onyx-panel-badge">Native Meta Engine v4.0</span>
		</div>

		<!-- Interactive Tab Navigation -->
		<div class="onyx-panel-tabs">
			<button type="button" class="onyx-tab-btn is-active" data-tab="tab-hero">
				<span>🚀 Hero & Header</span>
			</button>
			<button type="button" class="onyx-tab-btn" data-tab="tab-form">
				<span>📋 Referral Form</span>
			</button>
			<button type="button" class="onyx-tab-btn" data-tab="tab-rewards">
				<span>💎 Rewards Section</span>
			</button>
			<button type="button" class="onyx-tab-btn" data-tab="tab-how">
				<span>⚡ How It Works</span>
			</button>
			<button type="button" class="onyx-tab-btn" data-tab="tab-support">
				<span>💬 Support & Legal</span>
			</button>
		</div>

		<!-- Panel Content Body -->
		<div class="onyx-panel-body">
			
			<!-- TAB 1: HERO & HEADER -->
			<div class="onyx-tab-content is-active" id="tab-hero">
				<div class="onyx-card-box">
					<div class="onyx-card-heading">Top FDIC Notice & Hero Tagline</div>
					<div class="onyx-field-group">
						<label for="_landing_fdic_text">FDIC Notice Text</label>
						<input type="text" id="_landing_fdic_text" name="_landing_fdic_text" value="<?php echo esc_attr( $fdic_text ); ?>" />
						<p class="onyx-field-desc">Text displayed in the white bar at the top of the landing page.</p>
					</div>
					<div class="onyx-grid-2">
						<div class="onyx-field-group">
							<label for="_landing_hero_tagline">Hero Tagline</label>
							<input type="text" id="_landing_hero_tagline" name="_landing_hero_tagline" value="<?php echo esc_attr( $hero_tagline ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_hero_btn_text">Hero Button Text</label>
							<input type="text" id="_landing_hero_btn_text" name="_landing_hero_btn_text" value="<?php echo esc_attr( $hero_btn_text ); ?>" />
						</div>
					</div>
					<div class="onyx-field-group">
						<label for="_landing_hero_title">Hero Main Headline (HTML allowed)</label>
						<input type="text" id="_landing_hero_title" name="_landing_hero_title" value="<?php echo esc_attr( $hero_title ); ?>" />
						<p class="onyx-field-desc">Default: SHARE ONYX.&lt;br&gt;&lt;span class="onyx-hero__gold-text"&gt;GET REWARDED.&lt;/span&gt;</p>
					</div>
				</div>

				<div class="onyx-card-box">
					<div class="onyx-card-heading">Hero Right Side Card Graphic (Image Upload)</div>
					<input type="hidden" id="_landing_hero_image_url" name="_landing_hero_image_url" value="<?php echo esc_url( $hero_img_url ); ?>" />
					<div class="onyx-media-wrap">
						<div class="onyx-media-preview-box" id="onyx_hero_img_preview">
							<?php if ( ! empty( $hero_img_url ) ) : ?>
								<img src="<?php echo esc_url( $hero_img_url ); ?>" alt="Hero Preview" />
							<?php else : ?>
								<span style="color:#94a3b8; font-style:italic; text-align:center; padding:10px; font-size:12px;">Vector Fallback Active</span>
							<?php endif; ?>
						</div>
						<div>
							<button type="button" class="button button-secondary button-large" id="onyx_upload_hero_img_btn">
								<?php echo ! empty( $hero_img_url ) ? 'Change Custom Card Image' : 'Upload / Select Custom Card Image'; ?>
							</button>
							<button type="button" class="button button-link-delete" id="onyx_remove_hero_img_btn" style="margin-left:10px; <?php echo empty( $hero_img_url ) ? 'display:none;' : ''; ?>">
								Remove Image
							</button>
							<p class="onyx-field-desc" style="margin-top:8px;">
								Upload a custom PNG/JPG debit card image. If empty, the system automatically renders the metallic vector card visual.
							</p>
						</div>
					</div>
				</div>
			</div>

			<!-- TAB 2: REFERRAL FORM -->
			<div class="onyx-tab-content" id="tab-form">
				<div class="onyx-card-box">
					<div class="onyx-card-heading">Referral Form Card Settings</div>
					<div class="onyx-grid-2">
						<div class="onyx-field-group">
							<label for="_landing_form_title">Form Header Title</label>
							<input type="text" id="_landing_form_title" name="_landing_form_title" value="<?php echo esc_attr( $form_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_form_btn_text">Submit Button Text</label>
							<input type="text" id="_landing_form_btn_text" name="_landing_form_btn_text" value="<?php echo esc_attr( $form_btn_text ); ?>" />
						</div>
					</div>
					<div class="onyx-field-group">
						<label for="_landing_form_consent">Consent Checkbox Copy</label>
						<textarea id="_landing_form_consent" name="_landing_form_consent" rows="2"><?php echo esc_textarea( $form_consent ); ?></textarea>
					</div>
				</div>

				<div class="onyx-card-box">
					<div class="onyx-card-heading">Thank You & Confirmation Settings</div>
					<div class="onyx-grid-2">
						<div class="onyx-field-group">
							<label for="_landing_thankyou_title">Thank You Heading</label>
							<input type="text" id="_landing_thankyou_title" name="_landing_thankyou_title" value="<?php echo esc_attr( $thankyou_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_thankyou_sub">Thank You Subtitle</label>
							<input type="text" id="_landing_thankyou_sub" name="_landing_thankyou_sub" value="<?php echo esc_attr( $thankyou_sub ); ?>" />
						</div>
					</div>
				</div>
			</div>

			<!-- TAB 3: REWARDS SECTION -->
			<div class="onyx-tab-content" id="tab-rewards">
				<div class="onyx-card-box">
					<div class="onyx-card-heading">"More For You. More For Them." Copy</div>
					<div class="onyx-grid-2">
						<div class="onyx-field-group">
							<label for="_landing_rewards_title">Section Title</label>
							<input type="text" id="_landing_rewards_title" name="_landing_rewards_title" value="<?php echo esc_attr( $rewards_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_rewards_desc">Description Text</label>
							<textarea id="_landing_rewards_desc" name="_landing_rewards_desc" rows="4"><?php echo esc_textarea( $rewards_desc ); ?></textarea>
						</div>
					</div>
				</div>

				<div class="onyx-card-box">
					<div class="onyx-card-heading">Stat Card Rate Increases (0.50%)</div>
					<div class="onyx-grid-2">
						<!-- Stat Card 1 -->
						<div style="background:#ffffff; border:1px solid #cbd5e1; padding:14px; border-radius:6px;">
							<div style="font-weight:700; color:#5d0815; margin-bottom:8px;">Stat Card 1 (Referrer)</div>
							<div class="onyx-field-group">
								<label for="_landing_reward1_label">Label</label>
								<input type="text" id="_landing_reward1_label" name="_landing_reward1_label" value="<?php echo esc_attr( $reward1_label ); ?>" />
							</div>
							<div class="onyx-field-group">
								<label for="_landing_reward1_val">Rate Value</label>
								<input type="text" id="_landing_reward1_val" name="_landing_reward1_val" value="<?php echo esc_attr( $reward1_val ); ?>" />
							</div>
							<div class="onyx-field-group">
								<label for="_landing_reward1_sub">Subtext</label>
								<input type="text" id="_landing_reward1_sub" name="_landing_reward1_sub" value="<?php echo esc_attr( $reward1_sub ); ?>" />
							</div>
						</div>

						<!-- Stat Card 2 -->
						<div style="background:#ffffff; border:1px solid #cbd5e1; padding:14px; border-radius:6px;">
							<div style="font-weight:700; color:#5d0815; margin-bottom:8px;">Stat Card 2 (Friend)</div>
							<div class="onyx-field-group">
								<label for="_landing_reward2_label">Label</label>
								<input type="text" id="_landing_reward2_label" name="_landing_reward2_label" value="<?php echo esc_attr( $reward2_label ); ?>" />
							</div>
							<div class="onyx-field-group">
								<label for="_landing_reward2_val">Rate Value</label>
								<input type="text" id="_landing_reward2_val" name="_landing_reward2_val" value="<?php echo esc_attr( $reward2_val ); ?>" />
							</div>
							<div class="onyx-field-group">
								<label for="_landing_reward2_sub">Subtext</label>
								<input type="text" id="_landing_reward2_sub" name="_landing_reward2_sub" value="<?php echo esc_attr( $reward2_sub ); ?>" />
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- TAB 4: HOW IT WORKS -->
			<div class="onyx-tab-content" id="tab-how">
				<div class="onyx-card-box">
					<div class="onyx-card-heading">"How It Works" Section Title</div>
					<div class="onyx-field-group">
						<label for="_landing_how_title">Section Title</label>
						<input type="text" id="_landing_how_title" name="_landing_how_title" value="<?php echo esc_attr( $how_title ); ?>" />
					</div>
				</div>

				<div class="onyx-grid-3">
					<div class="onyx-card-box">
						<div class="onyx-card-heading">Step 01</div>
						<div class="onyx-field-group">
							<label for="_landing_step1_title">Title</label>
							<input type="text" id="_landing_step1_title" name="_landing_step1_title" value="<?php echo esc_attr( $step1_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_step1_desc">Description</label>
							<textarea id="_landing_step1_desc" name="_landing_step1_desc" rows="3"><?php echo esc_textarea( $step1_desc ); ?></textarea>
						</div>
					</div>

					<div class="onyx-card-box">
						<div class="onyx-card-heading">Step 02</div>
						<div class="onyx-field-group">
							<label for="_landing_step2_title">Title</label>
							<input type="text" id="_landing_step2_title" name="_landing_step2_title" value="<?php echo esc_attr( $step2_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_step2_desc">Description</label>
							<textarea id="_landing_step2_desc" name="_landing_step2_desc" rows="3"><?php echo esc_textarea( $step2_desc ); ?></textarea>
						</div>
					</div>

					<div class="onyx-card-box">
						<div class="onyx-card-heading">Step 03</div>
						<div class="onyx-field-group">
							<label for="_landing_step3_title">Title</label>
							<input type="text" id="_landing_step3_title" name="_landing_step3_title" value="<?php echo esc_attr( $step3_title ); ?>" />
						</div>
						<div class="onyx-field-group">
							<label for="_landing_step3_desc">Description</label>
							<textarea id="_landing_step3_desc" name="_landing_step3_desc" rows="3"><?php echo esc_textarea( $step3_desc ); ?></textarea>
						</div>
					</div>
				</div>
			</div>

			<!-- TAB 5: SUPPORT & LEGAL -->
			<div class="onyx-tab-content" id="tab-support">
				<div class="onyx-card-box">
					<div class="onyx-card-heading">Support & Questions Boxes</div>
					<div class="onyx-grid-2">
						<div class="onyx-field-group">
							<label for="_landing_support1_title">Support Box 1 Title</label>
							<input type="text" id="_landing_support1_title" name="_landing_support1_title" value="<?php echo esc_attr( $support1_title ); ?>" />
							<label for="_landing_support1_desc" style="margin-top:6px;">Support Box 1 Description</label>
							<textarea id="_landing_support1_desc" name="_landing_support1_desc" rows="3"><?php echo esc_textarea( $support1_desc ); ?></textarea>
						</div>
						<div class="onyx-field-group">
							<label for="_landing_support2_title">Support Box 2 Title</label>
							<input type="text" id="_landing_support2_title" name="_landing_support2_title" value="<?php echo esc_attr( $support2_title ); ?>" />
							<label for="_landing_support2_desc" style="margin-top:6px;">Support Box 2 Description</label>
							<textarea id="_landing_support2_desc" name="_landing_support2_desc" rows="3"><?php echo esc_textarea( $support2_desc ); ?></textarea>
						</div>
					</div>
				</div>

				<div class="onyx-card-box">
					<div class="onyx-card-heading">Footer Legal Disclaimer (Fine Print)</div>
					<div class="onyx-field-group">
						<label for="_landing_disclaimer">Disclaimer Fine Print Text</label>
						<textarea id="_landing_disclaimer" name="_landing_disclaimer" rows="4"><?php echo esc_textarea( $disclaimer ); ?></textarea>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Tab Switching & Media Uploader JS -->
	<script>
	jQuery(document).ready(function($){
		// Tab Switching Logic
		$('.onyx-tab-btn').click(function(e){
			e.preventDefault();
			var tabId = $(this).data('tab');
			
			$('.onyx-tab-btn').removeClass('is-active');
			$(this).addClass('is-active');
			
			$('.onyx-tab-content').removeClass('is-active');
			$('#' + tabId).addClass('is-active');
		});

		// Native Media Uploader Logic
		var mediaUploader;
		$('#onyx_upload_hero_img_btn').click(function(e) {
			e.preventDefault();
			if (mediaUploader) {
				mediaUploader.open();
				return;
			}
			mediaUploader = wp.media({
				title: 'Select Custom Hero Card Image',
				button: { text: 'Use This Card Image' },
				multiple: false
			});
			mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#_landing_hero_image_url').val(attachment.url);
				$('#onyx_hero_img_preview').html('<img src="' + attachment.url + '" alt="Hero Preview" />');
				$('#onyx_upload_hero_img_btn').text('Change Custom Card Image');
				$('#onyx_remove_hero_img_btn').show();
			});
			mediaUploader.open();
		});

		$('#onyx_remove_hero_img_btn').click(function(e) {
			e.preventDefault();
			$('#_landing_hero_image_url').val('');
			$('#onyx_hero_img_preview').html('<span style="color:#94a3b8; font-style:italic; text-align:center; padding:10px; font-size:12px;">Vector Fallback Active</span>');
			$('#onyx_upload_hero_img_btn').text('Upload / Select Custom Card Image');
			$(this).hide();
		});
	});
	</script>
	<?php
}

/**
 * Save Meta Box Input Data to wp_postmeta with Strict Sanitization & Security Checks.
 *
 * @param int $post_id Current Post ID being saved.
 * @return void
 */
function landing_save_onyx_meta_box( $post_id ) {
	// 1. Nonce check for CSRF protection.
	if ( ! isset( $_POST['landing_onyx_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['landing_onyx_meta_box_nonce'], 'landing_onyx_meta_box_save_action' ) ) {
		return;
	}

	// 2. Prevent saving during WP Autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// 3. Prevent execution on revision save.
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	// 4. Verify user capability.
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	// 5. Verify post type is page.
	if ( isset( $_POST['post_type'] ) && 'page' !== $_POST['post_type'] ) {
		return;
	}

	$fields = array(
		'_landing_fdic_text',
		'_landing_hero_tagline',
		'_landing_hero_btn_text',
		'_landing_form_title',
		'_landing_form_consent',
		'_landing_form_btn_text',
		'_landing_thankyou_title',
		'_landing_thankyou_sub',
		'_landing_rewards_title',
		'_landing_rewards_desc',
		'_landing_reward1_label',
		'_landing_reward1_val',
		'_landing_reward1_sub',
		'_landing_reward2_label',
		'_landing_reward2_val',
		'_landing_reward2_sub',
		'_landing_how_title',
		'_landing_step1_title',
		'_landing_step1_desc',
		'_landing_step2_title',
		'_landing_step2_desc',
		'_landing_step3_title',
		'_landing_step3_desc',
		'_landing_support1_title',
		'_landing_support1_desc',
		'_landing_support2_title',
		'_landing_support2_desc',
		'_landing_disclaimer',
	);

	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			$value = sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) );
			update_post_meta( $post_id, $field, $value );
		}
	}

	if ( isset( $_POST['_landing_hero_title'] ) ) {
		$hero_title_val = wp_kses_post( wp_unslash( $_POST['_landing_hero_title'] ) );
		update_post_meta( $post_id, '_landing_hero_title', $hero_title_val );
	}

	// Sanitize and save/delete custom hero image URL
	if ( isset( $_POST['_landing_hero_image_url'] ) ) {
		$img_url = esc_url_raw( wp_unslash( $_POST['_landing_hero_image_url'] ) );
		if ( ! empty( $img_url ) ) {
			update_post_meta( $post_id, '_landing_hero_image_url', $img_url );
		} else {
			delete_post_meta( $post_id, '_landing_hero_image_url' );
		}
	}
}
add_action( 'save_post', 'landing_save_onyx_meta_box' );

/**
 * Conditionally Enqueue Landing Page CSS & JavaScript ONLY when page-landing.php is active.
 *
 * @return void
 */
function landing_enqueue_onyx_assets() {
	if ( is_page_template( 'page-landing.php' ) ) {
		$css_relative_path = '/assets/css/landing/sections.css';
		$css_file_path     = get_stylesheet_directory() . $css_relative_path;
		$css_file_uri      = get_stylesheet_directory_uri() . $css_relative_path;

		if ( ! file_exists( $css_file_path ) ) {
			$css_file_path = get_template_directory() . $css_relative_path;
			$css_file_uri  = get_template_directory_uri() . $css_relative_path;
		}

		$version = file_exists( $css_file_path ) ? filemtime( $css_file_path ) : '4.0.0';

		wp_enqueue_style(
			'landing-onyx-sections-css',
			$css_file_uri,
			array(),
			$version,
			'all'
		);

		// Localize script data for AJAX referral form submission
		wp_register_script( 'landing-onyx-ajax-script', false, array( 'jquery' ), '4.0.0', true );
		wp_enqueue_script( 'landing-onyx-ajax-script' );

		$script_vars = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'onyx_referral_nonce' ),
		);
		wp_localize_script( 'landing-onyx-ajax-script', 'onyxReferralData', $script_vars );
	}
}
add_action( 'wp_enqueue_scripts', 'landing_enqueue_onyx_assets' );

/**
 * AJAX Handler for Referral Form Submission
 */
function landing_handle_onyx_referral_submission() {
	// Verify Nonce
	if ( ! check_ajax_referer( 'onyx_referral_nonce', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => 'Security check failed. Please refresh the page.' ) );
	}

	// Sanitize form inputs
	$user_name       = isset( $_POST['user_name'] ) ? sanitize_text_field( wp_unslash( $_POST['user_name'] ) ) : '';
	$user_email      = isset( $_POST['user_email'] ) ? sanitize_email( wp_unslash( $_POST['user_email'] ) ) : '';
	$user_phone      = isset( $_POST['user_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['user_phone'] ) ) : '';
	$ref_name        = isset( $_POST['ref_name'] ) ? sanitize_text_field( wp_unslash( $_POST['ref_name'] ) ) : '';
	$ref_email       = isset( $_POST['ref_email'] ) ? sanitize_email( wp_unslash( $_POST['ref_email'] ) ) : '';
	$ref_phone       = isset( $_POST['ref_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['ref_phone'] ) ) : '';
	$consent_checked = isset( $_POST['consent'] ) && '1' === $_POST['consent'];

	if ( empty( $user_name ) || empty( $user_email ) || empty( $ref_name ) || empty( $ref_email ) ) {
		wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
	}

	if ( ! is_email( $user_email ) || ! is_email( $ref_email ) ) {
		wp_send_json_error( array( 'message' => 'Please provide valid email addresses.' ) );
	}

	if ( ! $consent_checked ) {
		wp_send_json_error( array( 'message' => 'You must consent to sharing referral information.' ) );
	}

	// Store submission in WordPress options log
	$submissions   = get_option( 'onyx_referral_submissions', array() );
	$submissions[] = array(
		'timestamp'  => current_time( 'mysql' ),
		'user_name'  => $user_name,
		'user_email' => $user_email,
		'user_phone' => $user_phone,
		'ref_name'   => $ref_name,
		'ref_email'  => $ref_email,
		'ref_phone'  => $ref_phone,
	);
	update_option( 'onyx_referral_submissions', $submissions );

	wp_send_json_success( array(
		'message' => 'Thank you for submitting your referral. An ASB representative will reach out to your referral to get started.',
	) );
}
add_action( 'wp_ajax_submit_onyx_referral', 'landing_handle_onyx_referral_submission' );
add_action( 'wp_ajax_nopriv_submit_onyx_referral', 'landing_handle_onyx_referral_submission' );
