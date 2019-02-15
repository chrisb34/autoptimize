<?php

/**
 * Create "apply To" option for http2 options
 *
 * @package    Autoptimize-beta
 * @author     percipero <chris@percipero.com>
 * 
 * derived from http_push_content
 * by:    piwebsolution <rajeshsingh520@gmail.com>
 * 
 */
if(!class_exists("autoptimizeContentApplyTo")){
class autoptimizeContentApplyTo {

	

	public $apply_to;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( ) {
				
	}

	function apply_to_options(){
		?>
			<option disabled><?php _e('Select', 'autoptimize'); ?></option>
			<option value="all" {{if value.apply_to == 'all'}}selected="selected"{{/if}}>All Pages</option>
			<option value="front_page" {{if value.apply_to == 'front_page'}}selected="selected"{{/if}}>On Front Page</option>
			<option value="page" {{if value.apply_to == 'page'}}selected="selected"{{/if}}>On Page</option>                        
		<?php
	}

	/**
	 * Check the asset type and call appropriate check function 
	 * and if asset apply to matches present page type then return true else return false
	 * if any mismatch happens it will return true and asset will be applied on global scale
	 */
	function check($apply_to){
		if(isset($apply_to)){
			$apply_to = $apply_to;
			if(method_exists($this, 'is_'.$apply_to)){
				return $this->{'is_'.$apply_to}();
			}else{
				return true;
			}
		}else{
			return true;
		}
	}

	function is_all(){
		return true;
	}

	function is_front_page(){
		return is_front_page();
	}

	function is_page(){
		return is_page();
	}

	
}

}