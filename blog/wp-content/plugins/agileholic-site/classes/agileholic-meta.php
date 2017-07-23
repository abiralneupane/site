<?php
	/* Process Meta */
	add_action( 'add_meta_boxes', 'agileholic_add_icon_box' );
	function agileholic_add_icon_box() {
		$screens = array( 'ag-process', 'ag-hobbies','ag-services' );
		foreach ( $screens as $screen ) {
			add_meta_box( 'agileholic-icon-box', __( 'Icon', 'agileholic' ), 'agileholic_icon_box_callback', $screen, 'side' );
		}

		add_meta_box( 'agileholic-level-box', __( 'Level', 'agileholic' ), 'agileholic_level_box_callback', 'ag-skills', 'side' );
		add_meta_box( 'agileholic-employment-box', __( 'Employment Details', 'agileholic' ), 'agileholic_employment_box_callback', 'ag-employment', 'side' );
		add_meta_box( 'agileholic-education-box', __( 'Education Details', 'agileholic' ), 'agileholic_education_box_callback', 'ag-education', 'side' );
	}

	function agileholic_level_box_callback( $post ){
		wp_nonce_field( 'agileholic_level_box_data', 'agileholic_level_box_nonce' );
		
		$agileholic_skill_level = get_post_meta( $post->ID, 'agileholic_level', true );
		if(empty($agileholic_skill_level)){
			$agileholic_skill_level = 0;
		}
		echo '<p><label for="agileholic_skill_level">'.__( 'Your Sklills Level', 'agileholic' ).'</label>: <span id="range-output">'.$agileholic_skill_level.'</span></p>';
		echo '<input type="range" id="agileholic_skill_level" name="agileholic_skill_level" value="' .$agileholic_skill_level. '" />';
		echo '<input type="number" id="skill-range-output" min=0 max=100 value="' .$agileholic_skill_level. '" />';

	}

	function agileholic_icon_box_callback( $post ) {
		wp_nonce_field( 'agileholic_icon_box_data', 'agileholic_icon_box_nonce' );
		$agileholic_font_icon = get_post_meta( $post->ID, 'agileholic_icon', true );
		
		echo '<label for="agileholic_font_icon">'.__( 'Font Icon', 'agileholic' ).'</label> ';
		echo '<input type="text" id="agileholic_font_icon" name="agileholic_font_icon" value="' .$agileholic_font_icon. '" size="25" />';
	}


	function agileholic_employment_box_callback( $post ){
		wp_nonce_field( 'agileholic_employment_box_data', 'agileholic_employment_box_nonce' );
		
		$employment_time = get_post_meta( $post->ID, 'employment_time', true );
		$employment_position = get_post_meta( $post->ID, 'employment_position', true );
		$employment_address = get_post_meta( $post->ID, 'employment_address', true );
		echo '<table>';
			echo '<tr>';
				echo '<th><label for="employment_time">'.__( 'Time', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="employment_time" name="employment_time" value="' .$employment_time. '" /></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th><label for="employment_position">'.__( 'Position', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="employment_position" name="employment_position" value="' .$employment_position. '" /></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th><label for="employment_address">'.__( 'Address', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="employment_address" name="employment_address" value="' .$employment_address. '" /></td>';
			echo '</tr>';
		echo '</table>';
	}

	function agileholic_education_box_callback( $post ){
		wp_nonce_field( 'agileholic_education_box_data', 'agileholic_education_box_nonce' );

		$education_time = get_post_meta( $post->ID, 'education_time', true );
		$education_level = get_post_meta( $post->ID, 'education_level', true );
		$education_score = get_post_meta( $post->ID, 'education_score', true );
		$education_address = get_post_meta( $post->ID, 'education_address', true );

		echo '<table>';
			echo '<tr>';
				echo '<th><label for="education_time">'.__( 'Time', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="education_time" name="education_time" value="' .$education_time. '" /></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th><label for="education_level">'.__( 'Level', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="education_level" name="education_level" value="' .$education_level. '" /></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th><label for="education_score">'.__( 'Score', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="education_score" name="education_score" value="' .$education_score. '" /></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th><label for="education_address">'.__( 'Address', 'agileholic' ).'</label>:</th>';
				echo '<td><input type="text" id="education_address" name="education_address" value="' .$education_address. '" /></td>';
			echo '</tr>';
		echo '</table>';
	}
	
	add_action( 'save_post', 'agileholic_save_icon_box_data' );
	function agileholic_save_icon_box_data( $post_id ) {
		if( wp_verify_nonce( $_POST['agileholic_level_box_nonce'], 'agileholic_level_box_data' )  ){
			
			$agileholic_skill_level = isset( $_POST['agileholic_skill_level'] )? $_POST['agileholic_skill_level']: '';
			update_post_meta( $post_id, 'agileholic_level', $agileholic_skill_level );

		}else if( wp_verify_nonce( $_POST['agileholic_icon_box_nonce'], 'agileholic_icon_box_data' ) ){
			
			$agileholic_icon = isset( $_POST['agileholic_font_icon'] )? $_POST['agileholic_font_icon']: '';
			update_post_meta( $post_id, 'agileholic_icon', $agileholic_icon );

		}else if( wp_verify_nonce( $_POST['agileholic_employment_box_nonce'], 'agileholic_employment_box_data' ) ){
			
			$employment_time = isset( $_POST['employment_time'] )? $_POST['employment_time']: '';
			$employment_position = isset( $_POST['employment_position'] )? $_POST['employment_position']: '';
			$employment_address = isset( $_POST['employment_address'] )? $_POST['employment_address']: '';
			
			update_post_meta( $post_id, 'employment_time', $employment_time );
			update_post_meta( $post_id, 'employment_position', $employment_position );
			update_post_meta( $post_id, 'employment_address', $employment_address );
		
		}else if( wp_verify_nonce( $_POST['agileholic_education_box_nonce'], 'agileholic_education_box_data' ) ){
			
			$education_time = isset( $_POST['education_time'] )? $_POST['education_time']: '';
			$education_level = isset( $_POST['education_level'] )? $_POST['education_level']: '';
			$education_score = isset( $_POST['education_score'] )? $_POST['education_score']: '';
			$education_address = isset( $_POST['education_address'] )? $_POST['education_address']: '';
			
			update_post_meta( $post_id, 'education_time', $education_time );
			update_post_meta( $post_id, 'education_level', $education_level );
			update_post_meta( $post_id, 'education_score', $education_score );
			update_post_meta( $post_id, 'education_address', $education_address );
		
		}
	}

