<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://khadkaravi.com.np/
 * @since      1.0.0
 *
 * @package    Saraajaxsearch
 * @subpackage Saraajaxsearch/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Saraajaxsearch
 * @subpackage Saraajaxsearch/admin
 * @author     Ravi Khadka <khadkaravi170@gmail.com>
 */
class Saraajaxsearch_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Saraajaxsearch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Saraajaxsearch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(isset($_GET['page'])=='dr-sara-ajax'){

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/saraajaxsearch-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Saraajaxsearch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Saraajaxsearch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if(isset($_GET['page'])=='dr-sara-ajax'){
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/saraajaxsearch-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'ytd-api', 'https://apis.google.com/js/platform.js', array( 'jquery' ), $this->version, false );
		}
		

	}

	


}


function sas_add_form(){
    require plugin_dir_path( __FILE__ ) . '/partials/saraajaxsearch-form.php';
}

$sasDisplayInPost = get_option('dr_sara_search_d_post');


if($sasDisplayInPost=='on' ){

function sas_posts($content){
	$sasCustomContent = do_shortcode( '[sara_search]' );
	$sasCustomContent .= $content;
	return $sasCustomContent;
}
if(!is_home() && !is_front_page()){
add_filter( 'the_content', 'sas_posts' );
}
}