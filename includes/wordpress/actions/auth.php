<?php

add_action( 'elementor_pro/forms/validation', function ( $record, $ajax_handler ) {
	// Validation for the whole form.
}, 10, 2);

add_action( 'elementor_pro/forms/validation/new_password', function( $field, $record, $ajax_handler ) {
	// New password validation
}, 10, 2);

add_action( 'elementor_pro/forms/validation/confirm_new_pass', function( $field, $record, $ajax_handler ) {
	// Confirm new password validation
}, 10, 2);

add_action('elementor_pro/forms/new_record', function($record, $handler){
	// Fires after the new record has been submitted.
}, 10, 2);