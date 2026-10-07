<?php
/**
 * Landing Page Custom Meta Boxes Engine & Form Handler
 *
 * Full-featured backend engine registering native WordPress meta boxes for
 * the Onyx Referral Campaign landing page. Includes nonces, capability checks,
 * autosave guards, sanitization, frontend asset enqueuing, and AJAX form handler.
 *
 * @package ModularLandingPage
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Meta Box for Onyx Landing Page Settings
 *
 * @return void
 */
function landing_register_onyx_meta_boxes() {
	add_meta_box(
		'landing_onyx_page_meta_box',
		__( 'Onyx Referral Campaign - All Page Section Settings', 'textdomain' ),
		'landing_render_onyx_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'landing_register_onyx_meta_boxes' );

/**
 * Render Admin Meta Box UI with Tabs/Sections
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
	$hero_title     = get_post_meta( $post->ID, '_landing_hero_title', true ) ?: 'SHARE ONYX.<br>GET REWARDED.';
	$hero_btn_text  = get_post_meta( $post->ID, '_landing_hero_btn_text', true ) ?: 'REFER NOW';

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
		.onyx-admin-wrap { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 13px; color: #1e293b; }
		.onyx-admin-section { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 16px; margin-bottom: 20px; }
		.onyx-admin-section-title { font-size: 14px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 14px 0; border-bottom: 2px solid #850c1e; padding-bottom: 6px; }
		.onyx-field-group { margin-bottom: 14px; }
		.onyx-field-group:last-child { margin-bottom: 0; }
		.onyx-field-group label { display: block; font-weight: 600; color: #0f172a; margin-bottom: 4px; }
		.onyx-field-group input[type="text"], .onyx-field-group textarea { width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; }
		.onyx-field-group input[type="text"]:focus, .onyx-field-group textarea:focus { border-color: #850c1e; outline: none; box-shadow: 0 0 0 1px #850c1e; }
		.onyx-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
		.onyx-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
	</style>

	<div class="onyx-admin-wrap">
		<!-- Section 1: Header & Hero -->
		<div class="onyx-admin-section">
			<div class="onyx-admin-section-title">1. Header & Hero Section</div>
			<div class="onyx-field-group">
				<label for="_landing_fdic_text">FDIC Notice Text</label>
				<input type="text" id="_landing_fdic_text" name="_landing_fdic_text" value="<?php echo esc_attr( $fdic_text ); ?>" />
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
				<label for="_landing_hero_title">Hero Title (HTML Allowed e.g. &lt;br&gt;)</label>
				<input type="text" id="_landing_hero_title" name="_landing_hero_title" value="<?php echo esc_attr( $hero_title ); ?>" />
			</div>
		</div>

		<!-- Section 2: Referral Form -->
		<div class="onyx-admin-section">
			<div class="onyx-admin-section-title">2. Referral Form & Thank You Box</div>
			<div class="onyx-grid-2">
				<div class="onyx-field-group">
					<label for="_landing_form_title">Form Header Title</label>
					<input type="text" id="_landing_form_title" name="_landing_form_title" value="<?php echo esc_attr( $form_title ); ?>" />
				</div>
				<div class="onyx-field-group">
					<label for="_landing_form_btn_text">Form Submit Button Text</label>
					<input type="text" id="_landing_form_btn_text" name="_landing_form_btn_text" value="<?php echo esc_attr( $form_btn_text ); ?>" />
				</div>
			</div>
			<div class="onyx-field-group">
				<label for="_landing_form_consent">Consent Checkbox Text</label>
				<textarea id="_landing_form_consent" name="_landing_form_consent" rows="2"><?php echo esc_textarea( $form_consent ); ?></textarea>
			</div>
			<div class="onyx-grid-2">
				<div class="onyx-field-group">
					<label for="_landing_thankyou_title">Thank You Box Heading</label>
					<input type="text" id="_landing_thankyou_title" name="_landing_thankyou_title" value="<?php echo esc_attr( $thankyou_title ); ?>" />
				</div>
				<div class="onyx-field-group">
					<label for="_landing_thankyou_sub">Thank You Subtitle</label>
					<input type="text" id="_landing_thankyou_sub" name="_landing_thankyou_sub" value="<?php echo esc_attr( $thankyou_sub ); ?>" />
				</div>
			</div>
		</div>

		<!-- Section 3: Rewards -->
		<div class="onyx-admin-section">
			<div class="onyx-admin-section-title">3. Rewards Section ("More For You. More For Them.")</div>
			<div class="onyx-grid-2">
				<div class="onyx-field-group">
					<label for="_landing_rewards_title">Section Title</label>
					<input type="text" id="_landing_rewards_title" name="_landing_rewards_title" value="<?php echo esc_attr( $rewards_title ); ?>" />
				</div>
				<div class="onyx-field-group">
					<label for="_landing_rewards_desc">Description Copy</label>
					<textarea id="_landing_rewards_desc" name="_landing_rewards_desc" rows="4"><?php echo esc_textarea( $rewards_desc ); ?></textarea>
				</div>
			</div>
			<div class="onyx-grid-3">
				<div class="onyx-field-group">
					<label for="_landing_reward1_label">Reward 1 Label</label>
					<input type="text" id="_landing_reward1_label" name="_landing_reward1_label" value="<?php echo esc_attr( $reward1_label ); ?>" />
					<label for="_landing_reward1_val" style="margin-top:6px;">Rate Value</label>
					<input type="text" id="_landing_reward1_val" name="_landing_reward1_val" value="<?php echo esc_attr( $reward1_val ); ?>" />
					<label for="_landing_reward1_sub" style="margin-top:6px;">Subtext</label>
					<input type="text" id="_landing_reward1_sub" name="_landing_reward1_sub" value="<?php echo esc_attr( $reward1_sub ); ?>" />
				</div>
				<div class="onyx-field-group">
					<label for="_landing_reward2_label">Reward 2 Label</label>
					<input type="text" id="_landing_reward2_label" name="_landing_reward2_label" value="<?php echo esc_attr( $reward2_label ); ?>" />
					<label for="_landing_reward2_val" style="margin-top:6px;">Rate Value</label>
					<input type="text" id="_landing_reward2_val" name="_landing_reward2_val" value="<?php echo esc_attr( $reward2_val ); ?>" />
					<label for="_landing_reward2_sub" style="margin-top:6px;">Subtext</label>
					<input type="text" id="_landing_reward2_sub" name="_landing_reward2_sub" value="<?php echo esc_attr( $reward2_sub ); ?>" />
				</div>
			</div>
		</div>

		<!-- Section 4: How It Works -->
		<div class="onyx-admin-section">
			<div class="onyx-admin-section-title">4. "How It Works" Section</div>
			<div class="onyx-field-group">
				<label for="_landing_how_title">Section Title</label>
				<input type="text" id="_landing_how_title" name="_landing_how_title" value="<?php echo esc_attr( $how_title ); ?>" />
			</div>
			<div class="onyx-grid-3">
				<div class="onyx-field-group">
					<label for="_landing_step1_title">Step 01 Title</label>
					<input type="text" id="_landing_step1_title" name="_landing_step1_title" value="<?php echo esc_attr( $step1_title ); ?>" />
					<label for="_landing_step1_desc" style="margin-top:6px;">Step 01 Description</label>
					<textarea id="_landing_step1_desc" name="_landing_step1_desc" rows="3"><?php echo esc_textarea( $step1_desc ); ?></textarea>
				</div>
				<div class="onyx-field-group">
					<label for="_landing_step2_title">Step 02 Title</label>
					<input type="text" id="_landing_step2_title" name="_landing_step2_title" value="<?php echo esc_attr( $step2_title ); ?>" />
					<label for="_landing_step2_desc" style="margin-top:6px;">Step 02 Description</label>
					<textarea id="_landing_step2_desc" name="_landing_step2_desc" rows="3"><?php echo esc_textarea( $step2_desc ); ?></textarea>
				</div>
				<div class="onyx-field-group">
					<label for="_landing_step3_title">Step 03 Title</label>
					<input type="text" id="_landing_step3_title" name="_landing_step3_title" value="<?php echo esc_attr( $step3_title ); ?>" />
					<label for="_landing_step3_desc" style="margin-top:6px;">Step 03 Description</label>
					<textarea id="_landing_step3_desc" name="_landing_step3_desc" rows="3"><?php echo esc_textarea( $step3_desc ); ?></textarea>
				</div>
			</div>
		</div>

		<!-- Section 5: Support & Disclaimer -->
		<div class="onyx-admin-section">
			<div class="onyx-admin-section-title">5. Support Boxes & Footer Disclaimer</div>
			<div class="onyx-grid-2">
				<div class="onyx-field-group">
					<label for="_landing_support1_title">Support Box 1 Title</label>
					<input type="text" id="_landing_support1_title" name="_landing_support1_title" value="<?php echo esc_attr( $support1_title ); ?>" />
					<label for="_landing_support1_desc" style="margin-top:6px;">Support Box 1 Text</label>
					<textarea id="_landing_support1_desc" name="_landing_support1_desc" rows="3"><?php echo esc_textarea( $support1_desc ); ?></textarea>
				</div>
				<div class="onyx-field-group">
					<label for="_landing_support2_title">Support Box 2 Title</label>
					<input type="text" id="_landing_support2_title" name="_landing_support2_title" value="<?php echo esc_attr( $support2_title ); ?>" />
					<label for="_landing_support2_desc" style="margin-top:6px;">Support Box 2 Text</label>
					<textarea id="_landing_support2_desc" name="_landing_support2_desc" rows="3"><?php echo esc_textarea( $support2_desc ); ?></textarea>
				</div>
			</div>
			<div class="onyx-field-group" style="margin-top:14px;">
				<label for="_landing_disclaimer">Footer Legal Disclaimer Fine-Print Text</label>
				<textarea id="_landing_disclaimer" name="_landing_disclaimer" rows="4"><?php echo esc_textarea( $disclaimer ); ?></textarea>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Save Meta Box Data Safely
 *
 * @param int $post_id Post ID.
 * @return void
 */
function landing_save_onyx_meta_box( $post_id ) {
	if ( ! isset( $_POST['landing_onyx_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['landing_onyx_meta_box_nonce'], 'landing_onyx_meta_box_save_action' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
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

		$version = file_exists( $css_file_path ) ? filemtime( $css_file_path ) : '2.0.0';

		wp_enqueue_style(
			'landing-onyx-sections-css',
			$css_file_uri,
			array(),
			$version,
			'all'
		);

		// Localize script data for AJAX referral form submission
		wp_register_script( 'landing-onyx-ajax-script', false, array( 'jquery' ), '2.0.0', true );
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

	// Store submission in WordPress options log or send notification email
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
