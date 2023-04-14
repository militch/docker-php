<?php

namespace WCPM\Classes\Http;

use WCPM\Classes\Helpers;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Http {

	protected $options;
	protected $options_obj;
	protected $post_request_args;
	protected $server_base_path;
	protected $mp_purchase_hit_key;
	protected $mp_full_refund_hit_key;
	protected $mp_partial_refund_hit_key;
	protected $logger;
	protected $logger_context;

	public function __construct( $options ) {

//        $this->options     = get_option(WPM_DB_OPTIONS_NAME);
		$this->options     = $options;
		$this->options_obj = Helpers::get_options_object($options);

		$this->post_request_args = [
			'body'        => '',
			'timeout'     => 5,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => apply_filters('wpm_send_http_api_requests_blocking', apply_filters_deprecated('wooptpm_send_http_api_requests_blocking', [false], '1.13.0', 'wpm_send_http_api_requests_blocking')),
			'headers'     => [],
			'cookies'     => [],
			'sslverify'   => false,
		];

		$this->post_request_args = apply_filters_deprecated('wooptpm_http_post_request_args', [$this->post_request_args], '1.13.0', 'wpm_http_post_request_args');
		$this->post_request_args = apply_filters('wpm_http_post_request_args', $this->post_request_args);

		$this->logger_context = ['source' => 'PMW-http'];
	}

	protected function send_hit( $request_url, $payload = null ) {

		if ($payload) {
			$this->post_request_args['body'] = wp_json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		}

		// Log our request
		if (apply_filters('pmw_http_send_hit_logger', false)) {

			$this->post_request_args['blocking'] = true;

			$response = wp_safe_remote_post($request_url, $this->post_request_args);

			wc_get_logger()->debug('request url: ' . $request_url, $this->logger_context);

			if ($payload) {
				wc_get_logger()->debug('payload: ' . print_r($payload, true), $this->logger_context);
			}

			wc_get_logger()->debug('response code: ' . wp_remote_retrieve_response_code($response), $this->logger_context);

			if (
				200 !== wp_remote_retrieve_response_code($response)
				&& 204 !== wp_remote_retrieve_response_code($response)
			) {
				wc_get_logger()->error('response body: ' . wp_remote_retrieve_body($response), $this->logger_context);
			}

			if (is_wp_error($response)) {
				wc_get_logger()->error('response error message: ' . $response->get_error_message(), $this->logger_context);
			}

		} else {
			wp_safe_remote_post($request_url, $this->post_request_args);
		}
	}
}
