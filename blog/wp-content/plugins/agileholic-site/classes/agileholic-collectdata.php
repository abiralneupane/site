<?php
	class AGILEHOLIC_COLLECTDATA{
		public function getProcess(){
			$data = array();
			$temp = array();

			$args = array( 'post_type' => 'ag-process');
			$posts = get_posts( $args );

			foreach($posts as $post){
				$font_icon = get_post_meta($post->ID,'agileholic_icon',true);
				
				$temp['id'] = $post->ID;
				$temp['title'] = $post->post_title;
				$temp['font_icon'] = $font_icon;
				$data[] = $temp;
			}
			return $data;
		}

		public function getResume(){
			$data = array();
			$data['employment'] =  $this->getEmployment();
			$data['education'] =  $this->getEducation();
			$data['hard_skills'] =  $this->getSkill('hard-skills');
			$data['soft_skills'] =  $this->getSkill('soft-skills');
			$data['hobbies'] =  $this->getHobbies();
			$data['tools'] =  $this->getTools();
			$data['services'] =  $this->getServices();

			return $data;
		}

		private function getEmployment(){
			$data = array();
			$temp = array();

			$args = array( 'post_type' => 'ag-employment');
			$posts = get_posts( $args );

			foreach($posts as $post){
				$employment_time = get_post_meta( $post->ID, 'employment_time', true );
				$employment_position = get_post_meta( $post->ID, 'employment_position', true );
				$employment_address = get_post_meta( $post->ID, 'employment_address', true );

				$temp['id'] = $post->ID;
				$temp['time'] = $employment_time;
				$temp['position'] = $employment_position;
				$temp['company'] = $post->post_title;
				$temp['address'] = $employment_address;
				$temp['description'] = $post->post_content;

				$data[] = $temp;
			}
			return $data;
		}

		private function getEducation(){
			$data = array();
			$temp = array();

			$args = array( 'post_type' => 'ag-education');
			$posts = get_posts( $args );

			foreach($posts as $post){
				$education_time = get_post_meta( $post->ID, 'education_time', true );
				$education_level = get_post_meta( $post->ID, 'education_level', true );
				$education_score = get_post_meta( $post->ID, 'education_score', true );
				$education_address = get_post_meta( $post->ID, 'education_address', true );	

				$temp['id'] = $post->ID;
				$temp['time'] = $education_time;
				$temp['level'] = $education_level;
				$temp['service_center'] = $post->post_title;
				$temp['score'] = $education_score;
				$temp['address'] = $education_address;
				$temp['description'] = $post->post_content;

				$data[] = $temp;
			}
			return $data;
		}

		private function getTools(){
			$data = array();
			$ag_settings = get_option('ag_settings');
			$my_tools = isset($ag_settings['my-tools'])?$ag_settings['my-tools']:'';
			if(!empty($my_tools)){
				$data = explode(',', $my_tools);
			}
			return $data;
		}
		private function getHobbies(){
			$data = array();
			$temp = array();

			$args = array( 'post_type' => 'ag-hobbies');
			$posts = get_posts( $args );

			foreach($posts as $post){
				$font_icon = get_post_meta($post->ID,'agileholic_icon',true);

				$temp['id'] = $post->ID;
				$temp['title'] = $post->post_title;
				$temp['font_icon'] = $font_icon;
				$data[] = $temp;
			}
			return $data;
		}

		private function getServices(){
			$data = array();
			$temp = array();

			$args = array( 'post_type' => 'ag-services');
			$posts = get_posts( $args );

			foreach($posts as $post){
				$font_icon = get_post_meta($post->ID,'agileholic_icon',true);

				$temp['id'] = $post->ID;
				$temp['title'] = $post->post_title;
				$temp['font_icon'] = $font_icon;
				$data[] = $temp;
			}
			return $data;
		}

		private function getSkill($type){
			$data = array();
			$temp = array();

			$args = array( 
				'post_type' => 'ag-skills',
				'tax_query' => array(
					array(
						'taxonomy' => 'ag-skills-types',
						'field'    => 'slug',
						'terms'    => $type,
					),
				),
			);
			$posts = get_posts( $args );

			foreach($posts as $post){
				$agileholic_level = get_post_meta($post->ID,'agileholic_level',true);

				$temp['id'] = $post->ID;
				$temp['title'] = $post->post_title;
				$temp['level'] = $agileholic_level;
				$data[] = $temp;
			}
			return $data;
		}
	}
