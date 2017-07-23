<?php
class AGILEHOLIC_POSTTYPES{
	private $cptID;

	private $cptSingular;
	
	private $cptPlural;
	
	private $cptSupports = array();

	function __construct($id, $singular, $plural, $supports){
		$this->cptID = $id;
		$this->cptSingular = $singular;
		$this->cptPlural = $plural;
		$this->cptSupports = $supports;

		$this->createCPT();
	}

	public function createCPT(){
		$labels = array(
			'name'                  => _x( $this->cptPlural, 'Post Type General Name', 'agileholic' ),
			'singular_name'         => _x( $this->cptSingular, 'Post Type Singular Name', 'agileholic' ),
			'menu_name'             => __( $this->cptPlural, 'agileholic' ),
			'name_admin_bar'        => __( 'Post Type', 'agileholic' ),
			'parent_item_colon'     => __( 'Parent '.$this->cptSingular.':', 'agileholic' ),
			'all_items'             => __( $this->cptPlural, 'agileholic' ),
			'add_new_item'          => __( 'Add New '.$this->cptSingular, 'agileholic' ),
			'add_new'               => __( 'Add New', 'agileholic' ),
			'new_item'              => __( 'New '.$this->cptSingular, 'agileholic' ),
			'edit_item'             => __( 'Edit '.$this->cptSingular, 'agileholic' ),
			'update_item'           => __( 'Update '.$this->cptSingular, 'agileholic' ),
			'view_item'             => __( 'View '.$this->cptSingular, 'agileholic' ),
			'search_items'          => __( 'Search '.$this->cptSingular, 'agileholic' ),
			'not_found'             => __( 'Not found', 'agileholic' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'agileholic' ),
			'items_list'            => __( strtolower($this->cptPlural).' list', 'agileholic' ),
			'items_list_navigation' => __( strtolower($this->cptSingular).' list navigation', 'agileholic' ),
			'filter_items_list'     => __( 'Filter '.strtolower($this->cptPlural).' list', 'agileholic' ),
		);
		
		$args = array(
			'label'                 => $this->cptSingular,
			'description'           => __( 'Agileholic Settings', 'agileholic' ),
			'labels'                => $labels,
			'supports'              => $this->cptSupports,
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => 'agileholic',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'               => true,
		);

		register_post_type( $this->cptID, $args );
	}
}