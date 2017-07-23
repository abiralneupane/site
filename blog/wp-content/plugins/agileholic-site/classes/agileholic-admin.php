<?php

class AGILEHOLIC_ADMIN{
	function __construct(){
		add_action( 'admin_menu', array($this, 'register_agileholic_menu') );
		add_action('admin_init', array($this,'ag_page_init') );
	}
	public function register_agileholic_menu(){
		add_menu_page( 'agileholic', 'Agileholic', 'manage_options', 'agileholic', null);
		add_submenu_page( 'agileholic', 'Agileholic', 'Settings', 'manage_options', 'agileholic-options', array($this,'ag_admin_settings') );
	}

	public function ag_admin_settings() { ?>
		<div class="wrap">
			<h2><i class=""></i> <?php _e('Get Agileholic','agileholic'); ?></h2>
			<?php 
				$active_tab = 'general';
				if( isset( $_GET[ 'tab' ] ) ) {
	                $active_tab = $_GET[ 'tab' ];
	            }
			?>
			<h2 class="nav-tab-wrapper">
	            <a href="?page=agileholic-options&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
	            <a href="?page=agileholic-options&tab=settings" class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>">Settings</a>
	            <a href="?page=agileholic-options&tab=home" class="nav-tab <?php echo $active_tab == 'home' ? 'nav-tab-active' : ''; ?>">Home</a>
	            <a href="?page=agileholic-options&tab=profile" class="nav-tab <?php echo $active_tab == 'profile' ? 'nav-tab-active' : ''; ?>">Profile</a>
	            <a href="?page=agileholic-options&tab=contact" class="nav-tab <?php echo $active_tab == 'contact' ? 'nav-tab-active' : ''; ?>">Contact</a>
	        </h2>
		    <?php settings_errors(); ?>
		    <form method="post" enctype="multipart/form-data" action="options.php">
				<?php 
				    if( $active_tab == 'settings' ) {
		            	settings_fields( 'ag-settingsOpt' );   
		            	do_settings_sections( 'ag-settings' );
		            }else if( $active_tab == 'home' ) {
		            	settings_fields( 'ag-homeOpt' );   
		            	do_settings_sections( 'ag-home' );
		            }else if( $active_tab == 'profile' ) {
		            	settings_fields( 'ag-profileOpt' );   
		            	do_settings_sections( 'ag-profile' );
		            }else if( $active_tab == 'contact' ) {
		            	settings_fields( 'ag-contactOpt' );   
		            	do_settings_sections( 'ag-contact' );
		            }else{
		            	settings_fields( 'ag-generalOpt' );   
			        	do_settings_sections( 'ag-general' );
		            }
				    submit_button(); 
				?>
			</form>
		</div>
	<?php
	}

	public function ag_page_init(){
		register_setting(
	        'ag-generalOpt',
	        'ag_general',
	        array($this,'ag_validate_settings_fields')
	    );

	    register_setting(
	        'ag-settingsOpt',
	        'ag_settings',
	        array($this,'ag_validate_settings_fields')
	    );

	    register_setting(
	        'ag-homeOpt',
	        'ag_home',
	        array($this,'ag_validate_settings_fields')
	    );

	    register_setting(
	        'ag-profileOpt',
	        'ag_profile',
	        array($this,'ag_validate_settings_fields')
	    );

		$this->general_settings();
	    $this->profile_settings();
		$this->settings();
	}

	public function general_settings(){
		add_settings_section(
	        'ag-general-section',
	        __('Site Settings','agileholic'),
	        null,
	        'ag-general'
	    );
		
		add_settings_field(
		    'ag_web_hook',
		    '<label for="ag_web_hook">'.__('Hooked URL','agileholic').'</label>',
		    array($GLOBALS['ag_general_fields'],'ag_web_hook'),
		    'ag-general',
		    'ag-general-section' 
		);
	}

	public function settings(){
		add_settings_section(
	        'ag-settings-section',
	        __('Site Settings','agileholic'),
	        null,
	        'ag-settings'
	    );
		
		add_settings_field(
		    'ag_web_hook',
		    '<label for="ag_web_hook">'.__('Hooked URL','agileholic').'</label>',
		    array($GLOBALS['ag_settings_fields'],'ag_web_hook'),
		    'ag-settings',
		    'ag-settings-section' 
		);

	}

	public function home_settings(){
		add_settings_section(
	        'ag-home-section',
	        __('Home Settings','agileholic'),
	        null,
	        'ag-home'
	    );
		    
	    /*add_settings_field(
		    'ag_my_tools',
		    '<label for="ag_tools">'.__('Tools I use','agileholic').'</label>',
		    array($GLOBALS['ag_settings_fields'],'ag_tools'),
		    'ag-settings',
		    'ag-home-section' 
		);*/
	}

	public function profile_settings(){
		
		add_settings_section(
	        'ag-profile-section',
	        null,
	        null,
	        'ag-profile'
	    );
		   
		add_settings_field(
		    'ag_my_intro',
		    '<label for="ag_my_intro">'.__('Introduction','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'introduction'),
		    'ag-profile',
		    'ag-profile-section'
		);

	    add_settings_field(
		    'ag_my_tools',
		    '<label for="ag_tools">'.__('Tools I use','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_tools'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_quote',
		  	'<label for="my_quote">'.__('Quote','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_quote'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_name',
		  	'<label for="my_name">'.__('My Name','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_name'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_age',
		  	'<label for="my_age">'.__('My Age','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_age'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_dob',
		  	'<label for="my_age">'.__('My DOB','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_dob'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_address',
		  	'<label for="my_address">'.__('My Address','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_address'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_country',
		  	'<label for="my_country">'.__('My Country','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_country'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_email',
		  	'<label for="my_email">'.__('My Email','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_email'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_phone',
		  	'<label for="my_phone">'.__('My Phone','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_phone'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_website',
		  	'<label for="my_website">'.__('My Website','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_website'),
		    'ag-profile',
		    'ag-profile-section'
		);

		add_settings_field(
			'ag_my_profile_image',
		  	'<label for="my_profile">'.__('My Image','agileholic').'</label>',
		    array($GLOBALS['ag_profile_fields'],'ag_my_profile_image'),
		    'ag-profile',
		    'ag-profile-section'
		);
	}

	public function ag_validate_settings_fields($input){
		return $input;
	}
}