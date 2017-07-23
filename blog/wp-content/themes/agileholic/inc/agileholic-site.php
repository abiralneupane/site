<?php

class AGILEHOLIC_SITE{
	function __construct(){
		add_action( 'init', array($this, 'register_posts') );
		add_action( 'init', array($this, 'register_tax') );

		add_image_size( 'profile-thumb', 232, 232, true );
	}

	public function register_posts(){
		new AGILEHOLIC_POSTTYPES('ag-process', 'Process', 'Processes', array('title','editor'));
		new AGILEHOLIC_POSTTYPES('ag-employment', 'Employment', 'Employments', array('title','editor'));
		new AGILEHOLIC_POSTTYPES('ag-education', 'Education', 'Educations', array('title','editor'));
		new AGILEHOLIC_POSTTYPES('ag-skills', 'Skill', 'Skills', array('title'));
		new AGILEHOLIC_POSTTYPES('ag-hobbies', 'Hobby', 'Hobbies', array('title'));
		new AGILEHOLIC_POSTTYPES('ag-services', 'Service', 'Services', array('title','editor'));
		new AGILEHOLIC_POSTTYPES('ag-testimonials', 'Testimonial', 'Testimonials', array('title','editor'));
		new AGILEHOLIC_POSTTYPES('ag-portfolio', 'Portfolio', 'Portfolios', array('title','editor', 'excerpt','post-thumbnail'));
		new AGILEHOLIC_POSTTYPES('ag-language', 'Language', 'Languages', array('title'));
	}

	public function register_tax(){
		new AGILEHOLIC_TAX('ag-skills-types','ag-skills','Type', 'Types' );
		new AGILEHOLIC_TAX('ag-portfolio-types','ag-portfolio','Type', 'Types' );	
	}
}


$GLOBALS['ag_site'] = new AGILEHOLIC_SITE();


add_action( 'wp_ajax_save_data_to_json', 'ah_save_data_to_json' );
function ah_save_data_to_json() {
	global $agileholic;
	$data = array(
		'process' => get_process(),
		'employment' => get_employment(),
		'education' => get_education(),
		'skills' => get_skills(),
		'hobbies' => get_hobbies(),
		'services' => get_services(),
		'testimonials' => get_testimonials(),
		'portfolio' => get_portfolio(),
		'languages' => get_languages(),
		
		'site' => array(
			'site_heading' 			=> $agileholic['site-heading'],
			'site_subtext' 			=> $agileholic['site-subtext'],
			'banner_image' 			=> $agileholic['banner-image'],
			'banner_title' 			=> $agileholic['banner-title'],
			'banner_subtitle' 		=> $agileholic['banner-subtitle'],
			'banner_button_text' 	=> $agileholic['banner-button-text'],
			'banner_button_url' 	=> $agileholic['banner-button-url']
		),

		'profile' => array(
			'description' 		=> $agileholic['description'],
			'dob' 				=> $agileholic['dob'],
			'signature_text' 	=> $agileholic['signature-text'],
			'knowledge_base' 	=> $agileholic['knowledge-base'],
			'resume' 			=> $agileholic['resume']
		),
		
		'contact' => array(
			'contact_name'		=> $agileholic['contact-name'],
			'phone'				=> $agileholic['phone'],
			'email'				=> $agileholic['email'],
			'address'			=> $agileholic['address'],
			'latitude'			=> $agileholic['latitude'],
			'longitude'			=> $agileholic['longitude'],
			'address_1'			=> $agileholic['address_1'],
			'address_2'			=> $agileholic['address_2'],
			'country'			=> $agileholic['country'],
			'facebook'			=> $agileholic['facebook'],
			'twitter'			=> $agileholic['twitter'],
			'instagram'			=> $agileholic['instagram'],
			'google_pls'		=> $agileholic['google_pls'],
			'linkedin'			=> $agileholic['linkedin'],
			'wordpress'			=> $agileholic['wordpress'],
			'skype'				=> $agileholic['skype']
		)
	);

	$data_to_save = json_encode($data);
	
	file_put_contents(ABSPATH.'/../data.json', $data_to_save);
	wp_die($data_to_save);
}

function get_process(){

	$process_raw = ah_post_query('ag-process');
	return $process_raw;
}


function get_employment(){
	
	$employment_raw = ah_post_query('ag-employment');
	return $employment_raw;

}


function get_education(){
	
	$education_raw = ah_post_query('ag-education');
	return $education_raw;

}


function get_skills(){

	$skills_raw = ah_post_query('ag-skills');
	return $skills_raw;
}


function get_hobbies(){

	$hobbies_raw = ah_post_query('ag-hobbies');
	return $hobbies_raw;

}


function get_services(){

	$services_raw = ah_post_query('ag-services');
	return $services_raw;

}


function get_testimonials(){

	$testimonials_raw = ah_post_query('ag-testimonials');
	return $testimonials_raw;

}


function get_portfolio(){

	$portfolio_raw = ah_post_query('ag-portfolio');
	return $portfolio_raw;

}


function get_languages(){

	$language_raw = ah_post_query('ag-language');
	return $language_raw;
	
}

function ah_post_query($post_type, $order_block = array(), $meta_query = array() ){
	$args = array(
		'posts_per_page'   => -1,
		'post_type'        => $post_type,
		'post_status'      => 'publish'
	);

	if( isset($order_block['orderby']) ){
		$args['orderby'] = $order_block['orderby'];
	}

	if( isset($order_block['order']) ){
		$args['order'] = $order_block['order'];
	}

	if($meta_query){
		$args['meta_query'] = $meta_query;
	}

	$posts = get_posts( $args );

	return $posts;
}