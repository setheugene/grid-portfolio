<?php
/**
 * Custom REST API endpoints.
 *
 * Registers a POST endpoint at /wp-json/portfolio/v1/contact that handles
 * contact form submissions without a plugin. Demonstrates: custom namespace,
 * typed args with sanitize/validate callbacks, honeypot spam protection,
 * and wp_mail() delivery.
 *
 * @package SethPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register routes.
 */
function portfolio_register_rest_routes(): void {
	register_rest_route(
		'portfolio/v1',
		'/contact',
		[
			'methods'             => WP_REST_Server::CREATABLE, // POST
			'callback'            => 'portfolio_handle_contact',
			'permission_callback' => '__return_true',
			'args'                => portfolio_contact_args(),
		]
	);
}
add_action( 'rest_api_init', 'portfolio_register_rest_routes' );

/**
 * Argument definitions for the /contact endpoint.
 *
 * Sanitization and validation are handled by the REST API layer before
 * portfolio_handle_contact() is ever called.
 *
 * @return array<string, array<string, mixed>>
 */
function portfolio_contact_args(): array {
	return [
		'name'    => [
			'required'          => true,
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		],
		'email'   => [
			'required'          => true,
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_email',
			'validate_callback' => static function ( string $value ): bool {
				return is_email( $value );
			},
		],
		'message' => [
			'required'          => true,
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_textarea_field',
		],
		'honey'   => [
			'required'          => false,
			'type'              => 'string',
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		],
	];
}

/**
 * Handle a contact form submission.
 *
 * @param WP_REST_Request $request Incoming request.
 * @return WP_REST_Response
 */
function portfolio_handle_contact( WP_REST_Request $request ): WP_REST_Response {
	// Honeypot — bots fill hidden fields, humans don't.
	if ( '' !== $request->get_param( 'honey' ) ) {
		// Return 200 so bots don't know they were blocked.
		return new WP_REST_Response( [ 'success' => true ], 200 );
	}

	$name    = $request->get_param( 'name' );
	$email   = $request->get_param( 'email' );
	$message = $request->get_param( 'message' );

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'Portfolio contact from %s', $name );
	$body    = sprintf(
		"Name: %s\nEmail: %s\n\nMessage:\n%s",
		$name,
		$email,
		$message
	);
	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	];

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		return new WP_REST_Response(
			[ 'success' => true, 'message' => "Message sent." ],
			200
		);
	}

	return new WP_REST_Response(
		[ 'success' => false, 'message' => 'Could not send message. Please try again.' ],
		500
	);
}
