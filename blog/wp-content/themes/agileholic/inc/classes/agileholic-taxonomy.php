<?php
class AGILEHOLIC_TAX{
	private $taxID;

	private $cptID;

	private $taxName;

	private $taxPlural;

	function __construct($id, $cptid, $name, $pluralName){
		$this->taxID = $id;
		$this->cptID = $cptid;
		$this->taxName = $name;
		$this->taxPlural = $pluralName;

		$this->createTax();
	}

	public function createTax(){
		$labels = array(
			'name'                       => _x( $this->taxName, 'Taxonomy General Name', 'agileholic' ),
			'singular_name'              => _x( $this->taxName, 'Taxonomy Singular Name', 'agileholic' ),
			'menu_name'                  => __( $this->taxPlural, 'agileholic' ),
			'all_items'                  => __( 'All '. $this->taxPlural, 'agileholic' ),
			'parent_item'                => __( 'Parent '.$this->taxName, 'agileholic' ),
			'parent_item_colon'          => __( 'Parent '.$this->taxName.':', 'agileholic' ),
			'new_item_name'              => __( 'New '.$this->taxName.' Name', 'agileholic' ),
			'add_new_item'               => __( 'Add New '.$this->taxName, 'agileholic' ),
			'edit_item'                  => __( 'Edit '.$this->taxName, 'agileholic' ),
			'update_item'                => __( 'Update '.$this->taxName, 'agileholic' ),
			'view_item'                  => __( 'View '.$this->taxName, 'agileholic' ),
			'separate_items_with_commas' => __( 'Separate '.strtolower($this->taxPlural).' with commas', 'agileholic' ),
			'add_or_remove_items'        => __( 'Add or remove '.strtolower($this->taxPlural), 'agileholic' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'agileholic' ),
			'popular_items'              => __( 'Popular '.$this->taxPlural, 'agileholic' ),
			'search_items'               => __( 'Search '.$this->taxPlural, 'agileholic' ),
			'not_found'                  => __( 'Not Found', 'agileholic' ),
			'items_list'                 => __( $this->taxPlural.' list', 'agileholic' ),
			'items_list_navigation'      => __( $this->taxPlural.' list navigation', 'agileholic' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_menu'				 => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_quick_edit'		 => true
		);
		register_taxonomy( $this->taxID, array($this->cptID), $args );
	}
}