<?php

namespace Asquared;

class Categories {

	private $atts;

	/**
	 * Constructor
	 *
	 * @param array $atts
	 */
	public function __construct( $atts ) {
			$this->atts = $atts;
	}

	/**
	 * Get Categories
	 *
	 * @return \WP_REST_Response
	 */
	public function get_categories() {

		if ( ! class_exists( 'Woocommerce' ) ) {
			return new \WP_Error( 'Woocommerce_Required', __( 'Woocommerce Required', 'restoration' ) );
		}

		$categories = array();

		foreach ( $this->atts['categories'] as $category ) {
			// " to prevent re-ordering
			$categories[] = $this->get_category_data( $category );
		}

		return $categories;
	}

	/**
	 * Get category data.
	 *
	 * @param array $category.
	 * @return array
	 */
	protected function get_category_data( $category ) {

		$term = get_term_by( 'id', $category['id'], 'product_cat' );

		$data              = array();
		$data['id']        = $category['id'];
		$data['name']      = $term->name;
		$data['count']     = $term->count;
		$data['slug']      = $category['slug'];
		$data['image']     = $this->get_category_image( $category );
		$data['permalink'] = get_term_link( $category['id'], 'product_cat' );

		return $data;
	}

	/**
	 * Get category image.
	 *
	 * @param array $category.
	 * @return array
	 */
	protected function get_category_image( $category ) {
		$thumbnail_id = get_term_meta( $category['id'], 'thumbnail_id', true );
		return wp_get_attachment_url( $thumbnail_id );
	}


}
