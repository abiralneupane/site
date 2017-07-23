<?php
class AGILEHOLIC_PROFILE_FIELDS{
		protected $ag_profile;

	public function __construct(){
		$this->ag_profile = get_option('ag_profile');
	}
	
	public function introduction(){
		$introduction = isset($this->ag_profile['my-intro'])?$this->ag_profile['my-intro']:'';
	?>	
		<input type="text" name="ag_settings[my-intro]" class="regular-text" id="ag_tools" value="<?php echo $introduction; ?>"  />	
	<?php }

	public function ag_tools(){ 
		$my_tools = isset($this->ag_profile['my-tools'])?$this->ag_profile['my-tools']:'';
	?>
		<input type="text" name="ag_profile[my-tools]" class="regular-text" id="ag_tools" value="<?php echo $my_tools; ?>"  />
	<?php }

	public function ag_my_quote(){
		$my_quote = isset($this->ag_profile['my-quote'])?$this->ag_profile['my-quote']:'';
	?>
		<input type="text" name="ag_profile[my-quote]" class="regular-text" id="my_quote" value="<?php echo $my_quote; ?>"  />
	<?php }

	public function ag_my_name(){
		$my_name = isset($this->ag_profile['my-name'])?$this->ag_profile['my-name']:'';
	?>
		<input type="text" name="ag_profile[my-name]" class="regular-text" id="my_name" value="<?php echo $my_name; ?>"  />
	<?php }

	public function ag_my_age(){
		$my_age = isset($this->ag_profile['my-age'])?$this->ag_profile['my-age']:'';
	?>
		<input type="text" name="ag_profile[my-age]" class="regular-text" id="my_age" value="<?php echo $my_age; ?>"  />
	<?php }

	public function ag_my_dob(){
		$my_dob = isset($this->ag_profile['my-dob'])?$this->ag_profile['my-dob']:'';
	?>
		<input type="date" name="ag_profile[my-dob]" class="regular-text" id="my_dob" value="<?php echo $my_dob; ?>"  />
	<?php }

	public function ag_my_address(){
		$my_address = isset($this->ag_profile['my-address'])?$this->ag_profile['my-address']:'';
	?>
		<input type="text" name="ag_profile[my-address]" class="regular-text" id="my_address" value="<?php echo $my_address; ?>"  />
	<?php }

	public function ag_my_country(){
		$my_country = isset($this->ag_profile['my-country'])?$this->ag_profile['my-country']:'';
	?>
		<input type="text" name="ag_profile[my-country]" class="regular-text" id="my_country" value="<?php echo $my_country; ?>"  />
	<?php }

	public function ag_my_email(){
		$my_email = isset($this->ag_profile['my-email'])?$this->ag_profile['my-email']:'';
	?>
		<input type="email" name="ag_profile[my-email]" class="regular-text" id="my_email" value="<?php echo $my_email; ?>"  />
	<?php }

	public function ag_my_phone(){
		$my_phone = isset($this->ag_profile['my-phone'])?$this->ag_profile['my-phone']:'';
	?>
		<input type="text" name="ag_profile[my-phone]" class="regular-text" id="my_phone" value="<?php echo $my_phone; ?>"  />
	<?php }

	public function ag_my_website(){
		$my_phone = isset($this->ag_profile['my-website'])?$this->ag_profile['my-website']:'';
	?>
		<input type="url" name="ag_profile[my-website]" class="regular-text" id="my_website" value="<?php echo $my_website; ?>"  />
	<?php }

	public function ag_my_profile_image(){
		$profile_id = isset($this->ag_profile['profile-image'])?$this->ag_profile['profile-image']:'';
		$profile_image = wp_get_attachment_image( $profile_id, 'thumbnail' );
	?>
		<button class="ag-upload-media" id="my_profile_image" ><?php _e('Upload','agileholic'); ?></button>
		<?php 
			if($profile_image): 
				echo $profile_image;
			else:
				echo '<img class="regular-text ag-uploaded-media" style="display:none;" />';
			endif;
		?>
		<input type="hidden" name="ag_profile[profile-image]" class="ag-uploaded-media-id" value="<?php echo $profile_id; ?>" />
	<?php }







}