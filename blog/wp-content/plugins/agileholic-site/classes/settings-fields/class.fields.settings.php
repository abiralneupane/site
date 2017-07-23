<?php
class AGILEHOLIC_SETTINGS_FIELDS{
	protected $ag_settings;

	public function __construct(){
		$this->ag_settings = get_option('ag_settings');
	}
	public function ag_web_hook(){ 
		$web_hook_url = isset($this->ag_settings['web-hook-url'])?$this->ag_settings['web-hook-url']:'';
	?>
		<input type="text" name="ag_settings[web-hook-url]" class="regular-text" id="ag_web_hook" value="<?php echo $web_hook_url; ?>"  />
		<button type="button" class="button" id="agileholic-send" ><?php _e('Send Data to Agileholic','agileholic'); ?></button>
	<?php }
}