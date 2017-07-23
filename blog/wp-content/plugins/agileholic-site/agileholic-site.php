<?php
/*
Plugin Name: Agileholic Site
Description: Creates a platform for saving all the data required for Personal site
Plugin URI: http://abiralneupane.com.np
Author: Abiral Neupane
Author URI: http://abiralneupane.com.np
Version: 1.0
License: GPL2
Text Domain: agileholic
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once dirname(__FILE__).'/classes/agileholic-admin.php';
require_once dirname(__FILE__).'/classes/agileholic-postTypes.php';
require_once dirname(__FILE__).'/classes/agileholic-meta.php';
require_once dirname(__FILE__).'/classes/agileholic-taxonomy.php';
require_once dirname(__FILE__).'/classes/agileholic-settings-fields.php';
require_once dirname(__FILE__).'/classes/agileholic-collectdata.php';

require_once dirname(__FILE__).'/classes/settings-fields/class.fields.profiles.php';
require_once dirname(__FILE__).'/classes/settings-fields/class.fields.settings.php';

class AGILEHOLIC_SITE{
	function __construct(){
		add_action( 'init', array($this, 'agProcess') );
		add_action( 'init', array($this, 'agEmployment') );
		add_action( 'init', array($this, 'agEducation') );
		add_action( 'init', array($this, 'agSkills') );
		add_action( 'init', array($this, 'agHobbies') );
		add_action( 'init', array($this, 'agServices') );
		add_action( 'init', array($this, 'agPortfolio') );
		add_action( 'admin_enqueue_scripts', array($this, 'load_admin_agileholic_scripts') );
		add_action('wp_ajax_agileholic_collect_data', array($this,'agileholic_collect_data') );
		add_image_size( 'profile-thumb', 232, 232, true );
	}

	public function agileholic_collect_data(){
		$data['settings'] = '';
		$data['home'] = '';
		$data['profile'] = '';
		$data['process'] = $GLOBALS['ag_collect_data']->getProcess();
		$data['resume'] = $GLOBALS['ag_collect_data']->getResume();
		$data['portfolio'] = '';
		$data['social'] = '';
		$data['quotes'] = '';

		echo json_encode($data);
		die();
	}

	public function load_admin_agileholic_scripts(){
		wp_enqueue_script ( 'ah-admin', plugins_url( 'assets/js/admin.js', __FILE__ ), array('jquery') );
		wp_localize_script( 'ah-admin' ,'AGILEHOLIC', array( 'ajaxurl'=>admin_url('admin-ajax.php') ) );
	}

	public function agProcess(){
		new AGILEHOLIC_POSTTYPES('ag-process', 'Process', 'Processes', array('title','editor'));
	}

	public function agEmployment(){
		new AGILEHOLIC_POSTTYPES('ag-employment', 'Employment', 'Employments', array('title','editor'));
		/*
			"time":"2015 - Present", --meta
			"position":"Web Developer", --meta
			"company":"eVision IT", -- title
			"address":"Bansbari, Kathmandu", --meta
			"description":"Working as Django &amp; WordPress Developer " -- content

		*/
	}

	public function agEducation(){
		new AGILEHOLIC_POSTTYPES('ag-education', 'Education', 'Educations', array('title','editor'));	
		/*
			"time":"Since 2014", -- meta
			"level":"MSc. IT", -- meta
			"service_center":"Institute of International Management Science", --title
			"score":"", --meta
			"address":"Dhobidhara, Kathmandu", --meta
			"description":"In the affiliation of Lovely Professional University, Punjaab" --content
		*/
	}

	public function agSkills(){
		new AGILEHOLIC_POSTTYPES('ag-skills', 'Skill', 'Skills', array('title'));	
		/*
			"title":"PHP", -- title
			"level":"95" -- meta
		*/
		new AGILEHOLIC_TAX('ag-skills-types','ag-skills','Type', 'Types' );
		//types (taxonomy): hardskills, softskills
	}

	public function agHobbies(){
		new AGILEHOLIC_POSTTYPES('ag-hobbies', 'Hobby', 'Hobbies', array('title'));	
		/*
			"title":"Programming", --title
			"icon":"", --x
			"font_icon":"fa fa-futbol-o" --meta
		*/
	}

	public function agServices(){
		new AGILEHOLIC_POSTTYPES('ag-services', 'Service', 'Services', array('title','editor'));
		/*	
			"title":"Desktop Application", --title
			"icon":"icon-laptop", --x
			"font_icon":"fa fa-laptop", -- meta
			"description":"Desktop Application development using C# .NET" --description
		*/
	}

	public function agPortfolio(){
		new AGILEHOLIC_POSTTYPES('ag-portfolio', 'Portfolio', 'Portfolios', array('title','editor', 'excerpt','post-thumbnail'));
		/*
			"title":"Namaste Nepal", -- title
			"link_title":"See Live", -- meta
			"thumb":"http://abiralneupane.com.np/data/data/portfolio/namaste-thumb.jpg", -- featured Image
			"medium":"http://abiralneupane.com.np/data/data/portfolio/namaste-770.jpg", -- featured Image
			"large":"http://abiralneupane.com.np/data/data/portfolio/namaste.jpg", -- featured Image
			"url":"http://namastenepal.info/", -- meta
			"excerpt":"Namaste Nepal is a knowledege portal, through which we folks share our experience and thoughts", --excerpt
			"description":"Namaste Nepal is specially meant for someone who is unknown about Nepal's history, custom and traditions, and so on and so forth. Anyone can request for a blog composition, and they can share their experience, knowledge and thoughts through the site." -- description
		*/
		new AGILEHOLIC_TAX('ag-portfolio-types','ag-portfolio','Type', 'Types' );
		//types (taxonomy): sites, coursewares, plugins
	}
}

$GLOBALS['ag_collect_data'] = new AGILEHOLIC_COLLECTDATA();
$GLOBALS['ag_admin'] = new AGILEHOLIC_ADMIN();
$GLOBALS['ag_site'] = new AGILEHOLIC_SITE();

$GLOBALS['ag_settings_fields'] = new AGILEHOLIC_SETTINGS_FIELDS();
$GLOBALS['ag_general_fields'] = new AGILEHOLIC_GENERAL_FIELDS();
$GLOBALS['ag_profile_fields'] = new AGILEHOLIC_PROFILE_FIELDS();


/*
	For Settings
	--> settings
	--> home
	--> profile
	--> "tools":["Adobe PhotoShop","GIT","PyCharms","Sublime Text","FileZilla","Tortoise SVN"],
	--> social
	--> quotes
	--> contact
	
*/