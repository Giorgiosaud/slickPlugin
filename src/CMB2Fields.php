<?php
namespace giorgiosaud\slickwp;

class CMB2Fields extends Singleton{
	public function __construct()
	{
		add_action( 'cmb2_admin_init', array($this'paquetes_aditionals_fields' ));
	}	
	


	public function paquetes_aditionals_fields() {
		$cmb = new_cmb2_box( array(
			'id'            => CMB2PREFIX . 'metabox',
			'title'         => esc_html__( 'Datos Para Carousel', 'Avada' ),
		'object_types'  => array( 'paquetes' ), // Post type
// 		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'after_title',
		'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
// 		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );	
		$cmb->add_field( array(
			'name'       => esc_html__( 'Short Description', 'Avada' ),
			'desc'       => esc_html__( 'Short description to show in Carousel', 'Avada' ),
			'id'         => 'short_description',
			'type'       => 'textarea_small',
		) );
		$cmb->add_field(array(
			'name'=> esc_html__('Image For Carousel','Avada'),
			'desc'=> esc_html__('Image For Carousel in home or other pages','Avada'),
			'id'         => 'image_carousel',
			'type'       => 'file',
		// Optional:
			'options' => array(
				'url' => false, // Hide the text input for the url
			),
			'text'    => array(
				'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
			),
			// query_args are passed to wp.media's library query.
			'query_args' => array(
			// 'type' => 'application/pdf', // Make library only display PDFs.
			// Or only allow gif, jpg, or png images
			'type' => array(
				'image/gif',
				'image/jpeg',
				'image/png',
				),
			),
			'preview_size' => 'carousel', // Image size to use when previewing in the admin.
		));
	}
	

}
}