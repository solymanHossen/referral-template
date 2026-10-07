<?php
/**
 * Onyx Referral Campaign Theme - Functions & Auto-Activation Engine
 *
 * Includes the Landing Page engine, registers theme supports, automatically
 * sets the active theme options in WordPress database, and auto-creates the landing page.
 *
 * @package OnyxLandingTheme
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Load Landing Page Engine (Meta Boxes, Assets, & AJAX Handler)
require_once get_template_directory() . '/inc/landing/meta-boxes.php';

// 2. Register Theme Supports
function onyx_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
}
add_action( 'after_setup_theme', 'onyx_theme_setup' );

/**
 * Automatically set active theme options in database to onyx-landing-theme
 */
function onyx_ensure_active_theme_options() {
	if ( get_option( 'template' ) !== 'onyx-landing-theme' ) {
		update_option( 'template', 'onyx-landing-theme' );
		update_option( 'stylesheet', 'onyx-landing-theme' );
		update_option( 'current_theme', 'Onyx Referral Campaign Theme' );
	}
}
add_action( 'setup_theme', 'onyx_ensure_active_theme_options' );
add_action( 'wp_loaded', 'onyx_ensure_active_theme_options' );

/**
 * Programmatically Auto-Create & Configure the Landing Page
 */
function onyx_auto_create_landing_page() {
	if ( ! get_option( 'onyx_landing_page_created' ) ) {
		$page_slug = 'referral-campaign';
		$existing  = get_page_by_path( $page_slug );

		if ( ! $existing ) {
			$page_id = wp_insert_post( array(
				'post_title'     => 'Onyx Referral Campaign',
				'post_name'      => $page_slug,
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'comment_status' => 'closed',
			) );

			if ( $page_id && ! is_wp_error( $page_id ) ) {
				// Assign page-landing.php custom template
				update_post_meta( $page_id, '_wp_page_template', 'page-landing.php' );

				// Populate all default meta box data
				update_post_meta( $page_id, '_landing_fdic_text', 'FDIC-Insured - Backed by the full faith and credit of the U.S. Government' );
				update_post_meta( $page_id, '_landing_hero_tagline', 'THE ONYX REFERRAL CAMPAIGN' );
				update_post_meta( $page_id, '_landing_hero_title', 'SHARE ONYX.<br><span class="onyx-hero__gold-text">GET REWARDED.</span>' );
				update_post_meta( $page_id, '_landing_hero_btn_text', 'REFER NOW' );

				update_post_meta( $page_id, '_landing_form_title', 'REFER A FRIEND' );
				update_post_meta( $page_id, '_landing_form_consent', 'I confirm that I have the referral\'s consent to share their information with ASB for the purpose of the Onyx referral program.' );
				update_post_meta( $page_id, '_landing_form_btn_text', 'REFER NOW' );

				update_post_meta( $page_id, '_landing_thankyou_title', 'THANK YOU FOR SUBMITTING YOUR REFERRAL' );
				update_post_meta( $page_id, '_landing_thankyou_sub', 'An ASB representative will reach out to your referral to get started.' );

				update_post_meta( $page_id, '_landing_rewards_title', 'MORE FOR YOU.<br>MORE FOR THEM.' );
				update_post_meta( $page_id, '_landing_rewards_desc', "As an Onyx customer, you already know the value of a premium banking relationship. Now, you can share the Onyx experience with a friend or family member - and you'll both get a little more in return.\n\nIt's our way of giving you both a little more for choosing Onyx." );

				update_post_meta( $page_id, '_landing_reward1_label', 'FOR YOU' );
				update_post_meta( $page_id, '_landing_reward1_val', '0.50%' );
				update_post_meta( $page_id, '_landing_reward1_sub', 'You get a 0.50% rate increase for 90 days.' );

				update_post_meta( $page_id, '_landing_reward2_label', 'FOR YOUR FRIEND' );
				update_post_meta( $page_id, '_landing_reward2_val', '0.50%' );
				update_post_meta( $page_id, '_landing_reward2_sub', 'Your friend gets a 0.50% rate increase for 90 days.' );

				update_post_meta( $page_id, '_landing_how_title', 'HOW IT WORKS' );
				update_post_meta( $page_id, '_landing_step1_title', 'Tell a friend about Onyx' );
				update_post_meta( $page_id, '_landing_step1_desc', 'Share the benefits of your Onyx relationship with someone you think would enjoy the same experience.' );

				update_post_meta( $page_id, '_landing_step2_title', 'Submit their information' );
				update_post_meta( $page_id, '_landing_step2_desc', 'Complete the form above and an ASB representative will reach out to your referral to help them get started.' );

				update_post_meta( $page_id, '_landing_step3_title', 'You both get rewarded' );
				update_post_meta( $page_id, '_landing_step3_desc', "Once your referral opens an eligible Onyx account, you'll both receive a 0.50% rate increase for 90 days." );

				update_post_meta( $page_id, '_landing_support1_title', 'Prefer to have your referral reach out directly?' );
				update_post_meta( $page_id, '_landing_support1_desc', 'Your referral can also mention your name when opening their Onyx account to make sure your referral is connected to you.' );

				update_post_meta( $page_id, '_landing_support2_title', 'Questions' );
				update_post_meta( $page_id, '_landing_support2_desc', 'Our ASB Team is here to help. Contact us to learn more about Onyx and the referral program.' );

				update_post_meta( $page_id, '_landing_disclaimer', '*Offer is valid through November 15, 2026. The promotion is available to existing ASB customers with an active Onyx account who refer an individual who has not been an ASB customer within the previous 06 months. The referred individual must meet all applicable account-opening requirements. Limit one referral form per referring customer. Additional terms and conditions may apply.' );

				update_option( 'onyx_landing_page_created', $page_id );
			}
		}
	}
}
add_action( 'wp_loaded', 'onyx_auto_create_landing_page' );
