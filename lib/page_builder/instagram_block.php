<?php
/** A simple text block **/
class AQ_Instagram_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Instagram block',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_instagram_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'username' 			=> '',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		?>

		<p>This plugin requires the Instagram Slider Widget installed.</p>

		<div class="description">
			<label for="<?php echo $this->get_field_id('username') ?>">
				Instagram username
				<?php echo aq_field_input('username', $block_id, $username, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		if ( !empty($username) && $username != '' && class_exists('JR_InstagramSlider') ) :
			echo '
			<div class="instagram-container">
				<div class="col-sm-3">
					<img alt="" src="' . get_template_directory_uri() . '/img/instagram-text.png">
				</div>
				<div class="col-sm-9">
					<div class="instagram-list">
	                  	<div class="row">';
							$args = array(
								'title' => '',
								'username' => $username,
								'template' => 'thumbs-no-border',
								'images_number' => 4,
								'columns' => 4,
								'images_link' => 'image_url'
							);
							the_widget('JR_InstagramSlider', $args); 
		    echo '		</div>
		    		</div>
		    	</div>
		    </div>';
		endif;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}