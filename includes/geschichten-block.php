<?php

add_action('init', 'acf_init_arrenberg_geschichten_block');
function acf_init_arrenberg_geschichten_block() {
	
	// geschichten block
	if( function_exists('acf_register_block') ) {
		
		// register a geschichten block
		acf_register_block(array(
			'name'				=> 'arrenberg-geschichten',
			'title'				=> __('Arrenberg Geschichten'),
			'description'		=> __('Geschichten am Arrenberg'),
			'render_callback'	=> 'geschichten_block_render_callback',
			'category'			=> 'common', //  quartiersplattform
			'icon'				=> 'text-page',
			'keywords'			=> array( 'geschichten', 'arrenberg', 'menschen' ),
		));
	}
}


function geschichten_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	if( file_exists(  __DIR__  . "/templates/geschichten-block.php" ) ) {
		include_once( __DIR__ . "/templates/geschichten-block.php" );
	}

}

?>