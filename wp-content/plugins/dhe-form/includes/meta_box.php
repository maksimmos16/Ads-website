<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DHE_Form_Metabox {
	public function __construct(){
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 1000 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action ( 'save_post', array ($this,'save_meta_boxes' ), 1, 2 );
	}
	
	public function remove_meta_boxes(){
		remove_meta_box( 'vc_teaser', 'dheform' , 'side' );
		remove_meta_box( 'commentsdiv', 'dheform' , 'normal' );
		remove_meta_box( 'commentstatusdiv', 'dheform' , 'normal' );
		remove_meta_box( 'slugdiv', 'dheform' , 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'dheform', 'normal');
		remove_meta_box( 'pageparentdiv', 'dheform', 'side');
	}
	
	public function save_meta_boxes($post_id, $post){
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) ) {
			return;
		}
		
		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}
		
		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}
		
		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// Check the post type
		if ('dheform'!==$post->post_type ) {
			return;
		}
		
		foreach ((array)$this->_get_tabs() as $key=>$tab){
			$call_fnc = '_'.$key.'_setting';
			if(is_callable(array($this,$call_fnc))){
				$settings = call_user_func(array($this,$call_fnc));
				foreach ($settings as $meta_box){
					if(isset($meta_box['name'])){
						$meta_name = false !== strpos($meta_box['name'], 'dhe_form_messages') ? 'dhe_form_messages': $meta_box['name'];
						$meta_value = isset($_POST[$meta_name]) ? $_POST[$meta_name] : null;
						if(is_array($meta_value)){
							$meta_value = array_map( 'sanitize_text_field', (array) $meta_value ) ;
							if(false === strpos($meta_box['name'], 'dhe_form_messages'))
								$meta_value = array_filter($meta_value);
						}
						if (empty( $meta_value ) && false === strpos($meta_box['name'], 'dhe_form_messages') ) {
							delete_post_meta( $post_id, '_'.$meta_name );
						} elseif($meta_value !== null) {
							update_post_meta( $post_id, '_'.$meta_name , $meta_value );
						}
					}
				}
			}
		}
		
	}
	
	protected function _get_form_acition_options(){
		$actions = dhe_form_get_actions();
		$options = array('');
		foreach ($actions as $action){
			$options[$action] = ucfirst($action);
		}
		return $options;
	}
	
	public function add_meta_boxes(){
		add_meta_box( 'dheform-options', __( 'Form Options', 'dhe-form' ), array($this,'render_with_tabs'), 'dheform', 'normal', 'high' );
	}
	
	private function _general_setting(){
		$settings = array(
			array (
				"type" => "heading",
				"label"=>__('General','dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Save Submitted Form to Data ?", 'dhe-form' ),
				"name" => "save_data",
				"cbvalue" =>1,
				'description' => __('If checked, the submitted form data will be saved to your database.','dhe-form')
			),
			array (
				"type" => "select",
				"label" => __ ( "Action Type", 'dhe-form' ),
				"name" => "action_type",
				"options" => array (
					'default'=>__ ( 'Default', 'dhe-form' ),
					'external_url'=>__ ( 'External URL', 'dhe-form' )
				)
			),
			array (
				"type" => "text",
				"label" => __ ( "Enter URL", 'dhe-form' ),
				"name" => "action_url",
				"dependency" => array ('element' => "action_type",'value' => array ('external_url')),
				'description' => __('Enter a action URL.','dhe-form')
			),
			array (
				"type" => "select",
				"label" => __ ( "Use form action", 'dhe-form' ),
				"name" => "form_action",
				"options"=>$this->_get_form_acition_options()
			)
		);
		if(defined('DHE_FORM_SUPORT_WYSIJA')){
			$settings[] = array (
				"type" => "checklist",
				"label" => __ ( "Mailpoet subscribers to These Lists", 'dhe-form' ),
				"name" => "mailpoet",
				"options" => dhe_form_get_mailpoet_subscribers_list(),
			);
		}
		if(defined('DHE_FORM_SUPORT_MYMAIL')){
			$settings[] = array (
				"type" => "checklist",
				"label" => __ ( "Mymail subscribers to These Lists", 'dhe-form' ),
				"name" => "mymail",
				"options" => dhe_form_get_mymail_subscribers_list(),
			);
			$settings[] = array (
				"type" => "checkbox",
				"label" => __ ( "Mymail Double Opt In ", 'dhe-form' ),
				"name" => "mymail_double_opt_in",
				'description'=>__('Users have to confirm their subscription','dhe-form'),
				"cbvalue" =>1
			);
		}
		if(defined('DHE_FORM_SUPORT_GROUNDHOGG')){
			$settings[] = array (
				"type" => "checklist",
				"label" => __ ( "Apply Groundhogg Tags", 'dhe-form' ),
				"name" => "groundhogg_tags",
				"options" =>WPGH()->tags->get_tags_select(),
				'description'=>__('Once a contact is created this tag will be applied.','dhe-form')
			);
		}
		return array_merge($settings, array(
			array (
				"type" => "select",
				"label" => __ ( "Method", 'dhe-form' ),
				"name" => "method",
				"options" => array (
					'post'=>__ ( 'Post', 'dhe-form' ),
					'get'=>__ ( 'Get', 'dhe-form' )
				)
			),
			array (
				"type" => "heading",
				"label"=>__('Successful submit settings','dhe-form')
			),
			array (
				"type" => "select",
				"label" => __ ( "On successful submit", 'dhe-form' ),
				"name" => "on_success",
				"options" => array (
					'message'=>__ ( 'Display a message', 'dhe-form' ),
					'redirect'=>__ ( 'Redirect to another page', 'dhe-form' ),
					'refresh'=>__ ( 'Refresh current page', 'dhe-form' ),
				)
			),
			array (
				"type" => "textarea_variable",
				"label" => __ ( "Message", 'dhe-form' ),
				"name" => "message",
				"value"=>'Your message has been sent. Thanks!',
				"dependency" => array ('element' => "on_success",'value' => array ('message')),
				'description' =>  __('This is the text or HTML that is displayed when the form is successfully submitted','dhe-form')
			),
			array (
				"type" => "select",
				"label" => __ ( "Message Position", 'dhe-form' ),
				"name" => "message_position",
				'description' =>  __('You can use "Form Response" shortcode to locating response message box anywhere','dhe-form'),
				"options"=>array(
					'top'=>__('Top','dhe-form'),
					'bottom'=>__('Bottom','dhe-form')
				),
			),
			array (
				"type" => "select",
				"label" => __ ( "Redirect to", 'dhe-form' ),
				"name" => "redirect_to",
				"dependency" => array ('element' => "on_success",'value' => array ('redirect')),
				"options" => array (
					'to_page'=>__ ( 'Page', 'dhe-form' ),
					'to_post'=>__ ( 'Post', 'dhe-form' ),
					'to_url'=>__ ( 'Url', 'dhe-form' ),
				),
				"description"=>__('When the form is successfully submitted you can redirect the user to post, page or URL.','dhe-form'),
			),
			array (
				"type" => "select",
				"label" => __ ( "Select page", 'dhe-form' ),
				"name" => "page",
				"options" => dhe_form_get_pages(),
				"dependency" => array ('element' => "redirect_to",'value' => array ('to_page')),
			),
			array (
				"type" => "select",
				"label" => __ ( "Select post", 'dhe-form' ),
				"name" => "post",
				"options" => dhe_form_get_posts(),
				"dependency" => array ('element' => "redirect_to",'value' => array ('to_post')),
			),
			array (
				"type" => "text",
				"label" => __ ( "Enter URL", 'dhe-form' ),
				"name" => "url",
				"dependency" => array ('element' => "redirect_to",'value' => array ('to_url')),
			),
				
			array (
				"type" => "heading",
				"label"=>__('Form popup settings','dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Display the form in a popup ?", 'dhe-form' ),
				"name" => "form_popup",
				"cbvalue" =>1
			),
			array (
				"type" => "labelpopup",
				"name" => 'form_popup_labelpopup',
				"label" => __ ('Set data-toggle="dheformpopup" on a controller element, like a button, along with a data-target="#dheformpopup-{form_ID}" or href="#dheformpopup-{form_ID}" to target a specific form popup to toggle.', 'dhe-form' ),
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Show popup title ?", 'dhe-form' ),
				"name" => "form_popup_title",
				"cbvalue" =>1
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Form popup width (px)', 'dhe-form' ),
				'name' => 'form_popup_width',
				'value'=>600,
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Auto open popup ?", 'dhe-form' ),
				"name" => "form_popup_auto_open",
				"cbvalue" =>1,
				"description"=>__('If selected, form popup will auto open when load page.','dhe-form'),
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Popup open delay (ms)', 'dhe-form' ),
				'name' => 'form_popup_auto_open_delay',
				'value'=>2000,
				"description"=>__('Time delay for open popup.','dhe-form'),
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Auto close popup ?", 'dhe-form' ),
				"name" => "form_popup_auto_close",
				"cbvalue" =>1,
				"description"=>__('If selected, form popup will auto close.','dhe-form'),
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Popup close delay (ms)', 'dhe-form' ),
				'name' => 'form_popup_auto_close_delay',
				'value'=>10000,
				"description"=>__('Time delay for close popup.','dhe-form'),
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Only one time ?", 'dhe-form' ),
				"name" => "form_popup_one",
				"cbvalue" =>1,
				"description"=>__('If selected,form will opens only on the first visit your site.','dhe-form'),
			),
		) );
	}
	
	private function _mail_setting(){
		return array(
			array (
				"type" => "heading",
				"label"=>__('Notifications email settings','dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Send form data via email ?", 'dhe-form' ),
				"name" => "notice",
				"cbvalue" =>1
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Sender Name', 'dhe-form' ),
				'name' => 'notice_name',
				'value'=>get_bloginfo('name'),
				"dependency" => array ('element' => "notice",'not_empty' => true),
			),
			array (
				'type' => 'select',
				'label' => __ ( 'Sender Email Type', 'dhe-form' ),
				'name' => 'notice_email_type',
				'value'=>'email_text',
				'options'=>array(
					'email_text'=>__ ( 'Email', 'dhe-form' ),
					'email_field'=>__ ( 'Email Field', 'dhe-form' ),
				),
				"dependency" => array ('element' => "notice",'not_empty' => true),
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Sender Email', 'dhe-form' ),
				'name' => 'notice_email',
				'value'=>get_bloginfo('admin_email'),
				"dependency" => array ('element' => "notice",'not_empty' => true),
			),
			array (
				'type' => 'select_recipient',
				'label' => __ ( 'Sender Field', 'dhe-form' ),
				'name' => 'notice_variables',
				"description"=>__('The form must have at least one Email Address element to use this feature.','dhe-form')
			),
			array (
				'type' => 'recipient',
				'label' => __ ( 'Recipients', 'dhe-form' ),
				'name' => 'notice_recipients',
				'value'=>get_bloginfo('admin_email'),
				"dependency" => array ('element' => "notice",'not_empty' => true),
				"description"=>__('Add email address(es) which the submitted form data will be sent to.','dhe-form')
			),
			array (
				'type' => 'select_recipient',
				'label' => __ ( 'Reply To', 'dhe-form' ),
				'name' => 'notice_reply_to',
				"description"=>__('The form must have at least one Email Address element to use this feature.','dhe-form')
			),
			array (
				'type' => 'input_variable',
				'label' => __ ( 'Email subject', 'dhe-form' ),
				'name' => 'notice_subject',
				"dependency" => array ('element' => "notice",'not_empty' => true),
				'value'=>__('New form submission','dhe-form')
			),
			array (
				'type' => 'textarea_variable',
				'label' => __ ( 'Email body', 'dhe-form' ),
				'name' => 'notice_body',
				'value'=>'[form_body]',
				"description"=>__("Use the label [form_body] to insert the form data in the email body. To use form control in email. please enter form control variables <strong>[form_control_name]</strong> in email.",'dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Use HTML content type ?", 'dhe-form' ),
				"name" => "notice_html",
				"cbvalue" =>1
			),
			array (
				"type" => "heading",
				"label"=>__('Autoreply email settings','dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Send autoreply email ?", 'dhe-form' ),
				"name" => "reply",
				"cbvalue" => 1
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Sender Name', 'dhe-form' ),
				'name' => 'reply_name',
				'value'=>get_bloginfo('name'),
				"dependency" => array ('element' => "reply",'not_empty' => true),
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Sender Email', 'dhe-form' ),
				'name' => 'reply_email',
				'value'=>get_bloginfo('admin_email'),
				"dependency" => array ('element' => "reply",'not_empty' => true),
			),
			array (
				'type' => 'select_recipient',
				'label' => __ ( 'Recipients', 'dhe-form' ),
				'name' => 'reply_recipients',
				"description"=>__('The form must have at least one Email Address element to use this feature.','dhe-form')
			),
			array (
				'type' => 'input_variable',
				'label' => __ ( 'Email subject', 'dhe-form' ),
				'name' => 'reply_subject',
				"dependency" => array ('element' => "reply",'not_empty' => true),
				'value'=>__('Just Confirming','dhe-form')
			),
			array (
				'type' => 'textarea_variable',
				'label' => __ ( 'Email body', 'dhe-form' ),
				'name' => 'reply_body',
				"dependency" => array ('element' => "reply",'not_empty' => true),
				'value'=>__('This is just a confirmation message. We have received you reply.','dhe-form'),
				"description"=>__("Use the label [form_body] to insert the form data in the email body. To use form control in email. please enter form control variables <strong>[form_control_name]</strong> in email.",'dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Use HTML content type ?", 'dhe-form' ),
				"name" => "reply_html",
				"cbvalue" =>1
			),
		);
	}
	
	private function _additional_setting(){
		return array(
			array (
				"type" => "heading",
				"label"=>__('Additional settings','dhe-form')
			),
			array(
				'type'=>'textarea',
				'label'=>__('Additional Settings','dhe-form'),
				"description"=>__('Trigger with form AJAX.','dhe-form'),
				'name'=>'additional_setting'
			),
		);
	}
	
	private function _message_setting(){
		$default_messages = dhe_form_get_messages();
		$settings = array();
		$settings[] = array (
			"type" => "heading",
			"label"=>__('Messagess settings','dhe-form')
		);
		foreach ($default_messages as $key=>$message){
			$label = 'On '.ucwords(implode(' ', explode('_', $key)));
			$settings[] = array (
				'type' => 'text',
				'label' => $label,
				'name' =>'dhe_form_messages['.$key.']',
				'value'=>$message
			);
		}
		return $settings;
	}
	
	private function _payment_setting(){
		return array(
			array (
				"type" => "heading",
				"label"=>__('PayPal Settings','dhe-form')
			),
			array (
				'type' => 'text',
				'label' => __ ( 'PayPal Email', 'dhe-form' ),
				'name' => 'paypal_email',
			),
			array (
				'type' => 'select',
				'label' => __ ( 'PayPal Currency', 'dhe-form' ),
				'name' => 'paypal_currency',
				'value'=>'USD',
				'options'=>dhe_form_get_currencies()
			),
			array (
				'type' => 'select',
				'label' => __ ( 'Currency position', 'dhe-form' ),
				'name' => 'paypal_currency_position',
				'value'=>'left',
				'options'=>array(
					'left'        =>__('Left','dhe-form'),
					'right'       =>__('Right','dhe-form'),
					'left_space'  =>__('Left with space','dhe-form'),
					'right_space' =>__('Right with space','dhe-form'),
				)
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "PayPal sandbox", 'dhe-form' ),
				"name" => "paypal_sandbox",
				"cbvalue" => 1,
				'description'=>sprintf(__('PayPal sandbox can be used to test payments. Sign up for a <a href="%s" target="_blank">developer account</a>.','dhe-form'),'https://developer.paypal.com/')
			),
			array (
				'type' => 'text',
				'label' => __ ( 'PayPal Cancel URL', 'dhe-form' ),
				'name' => 'paypal_cancel_url',
				'description'=>__('Optional','dhe-form')
			),
			array (
				'type' => 'text',
				'label' => __ ( 'PayPal Return URL', 'dhe-form' ),
				'name' => 'paypal_return_url',
				'description'=>__('Optional','dhe-form')
			),
			array (
				"type" => "heading",
				"label"=>__('Paypal checkout','dhe-form')
			),
			array (
				"type" => "checkbox",
				"label" => __ ( "Submit form to paypal checkout", 'dhe-form' ),
				"name" => "paypal_checkout",
				"cbvalue" => 1
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Order Description', 'dhe-form' ),
				'name' => 'paypal_order_description',
				'description'=>__('Optional, if left blank customer will be able to enter their own description at checkout','dhe-form')
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Order Price', 'dhe-form' ),
				'name' => 'paypal_order_price',
				'description'=>__('Optional, if left blank customer will be able to enter their own price at checkout','dhe-form')
			),
			array (
				'type' => 'text',
				'label' => __ ( 'Order ID', 'dhe-form' ),
				'name' => 'paypal_order_id',
				'description'=>__('Optional','dhe-form')
			),
		);
	}
	
	private function _get_tabs(){
		return apply_filters('dhe_form_meta_box_tabs', array(
			'general'=>array(
				'label'=>__("General",'dhe-form')
			),
			'mail'=>array(
				'label'=>__("Mail",'dhe-form')
			),
			'message'=>array(
				'label'=>__("Messages",'dhe-form')
			),
			'payment'=>array(
				'label'=>__("Payments",'dhe-form')
			),
			'additional'=>array(
				'label'=>__("Additional",'dhe-form')
			),
		));
	}
	
	public function render_with_tabs(){
		
		$tabs_content = '';
		?>
		<div class="dheform_options">
			<h2 class="nav-tab-wrapper dheform-nav-tab-wrapper" style="padding: 0px;">
				<?php $i = 1;?>
				<?php foreach ((array)$this->_get_tabs() as $key=>$tab):?>
					<a class="nav-tab<?php echo ($i==1) ? ' nav-tab-active':''?>" href="<?php echo '#dheform_meta_box_'.esc_attr($key)?>">
						<?php echo esc_html($tab['label'])?>
					</a>
				<?php 
				$call_fnc = '_'.$key.'_setting';
				if(is_callable(array($this,$call_fnc))){
					$settings = call_user_func(array($this,$call_fnc));
					$tabs_content .='<div id="dheform_meta_box_'.$key.'" class="dheform-tab-panel" '.($i==1 ? '':' style="display:none"' ).'>';
					foreach ($settings as $setting){
						ob_start();
						$this->_render_metabox_field($setting);
						$tabs_content .= ob_get_clean();
					}
					$tabs_content .='</div>';
				}
				?>
				
				<?php $i++;?>
				<?php endforeach;?>
			</h2>
			<div class="nav-tab-content dheform-tab-content">
				<?php echo $tabs_content?>
			</div>
		</div>
		<?php
	}
	
	public function render(){
		?>
		<div class="dheform_options">
			<?php 
			foreach ($this->_get_meta_boxs_fields() as $meta_box){
				$this->_render_metabox_field($meta_box);
			}	
			?>
		</div>
		<?php
	}
	
	protected function _render_metabox_field($field){
		global $post;
	
		if(!isset($field['type']))
			echo '';
	
		$field['name']          = isset( $field['name'] ) ? $field['name'] : '';
		$value_name = false !== strpos($field['name'], 'dhe_form_messages') ? '_dhe_form_messages':'_'.$field['name'];
		$value = get_post_meta( $post->ID, $value_name, true );
		$field['value']         = isset( $field['value'] ) ? $field['value'] : '';
		
		if($value){
			if('_dhe_form_messages'===$value_name){
				$field_name = str_replace(array('dhe_form_messages[',']'),'', $field['name']);
				$field['value'] = isset($value[$field_name]) ? $value[$field_name] : '';
			}else{
				$field['value'] = $value;
			}
		}
	
		$field['id'] 			= isset( $field['id'] ) ? $field['id'] : $field['name'];
		$field['description'] 	= isset($field['description']) ? $field['description'] : '';
		$field['label'] 		= isset( $field['label'] ) ? $field['label'] : '';
		$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : $field['label'];
		$field['dependency']    = isset($field['dependency']) ? $field['dependency'] : array();
		$data_dependency = '';
		switch ($field['type']){
			case 'heading':
				echo '<h3>'.esc_html($field['label']).'</h3>';
				break;
			case 'labelpopup':
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field ">';
				echo $field['label'].__('Example:','dhe-form').'<br><strong><em>'.esc_html('<button type="button" data-toggle="dheformpopup" data-target="#dheformpopup-'.get_the_ID().'">'.__('Launch form popup','dhe-form').'</button>').'</strong></em>';
				echo '</p>';
				break;
			case 'input_variable':
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label>';
				echo '<select onchange="dhe_form_select_variable(this)" class="dhe-form-select-variable">';
				echo '<option value="">'.__('Insert variable...','dhe-form').'</option>';
				foreach (dhe_form_get_variables() as $label=>$key){
					echo '<option value="'.esc_attr($key).'">'.esc_html($label).'</option>';
				}
				echo  '</select>';
				echo '<input type="text" class="input_text" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" /> ';
					
				if ( ! empty( $field['description'] ) ) {
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
				}
				echo '</p>';
				break;
			case 'text':
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label><input type="text" class="input_text" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" /> ';
					
				if ( ! empty( $field['description'] ) ) {
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
				}
				echo '</p>';
				break;
			case 'color':
				wp_enqueue_style( 'wp-color-picker');
				wp_enqueue_script( 'wp-color-picker'); 
				
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label><input data-default-color="'.esc_attr( $field['value'] ).'" type="text" class="input_text" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" /> ';
				if ( ! empty( $field['description'] ) ) {
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
				}
				echo '<script type="text/javascript">
						jQuery(document).ready(function($){
						    $("#'.$field['id'].'").wpColorPicker();
						});
					 </script>
					 ';
				echo '</p>';
				break;
			case 'hidden':
				echo '<input type="hidden" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) .  '" /> ';
				break;
			case 'textarea_variable':
				echo '<p  '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label>';
				echo '<select onchange="dhe_form_select_variable(this)" class="dhe-form-select-variable">';
				echo '<option value="">'.__('Insert variable...','dhe-form').'</option>';
				foreach (dhe_form_get_variables() as $label=>$key){
					echo '<option value="'.esc_attr($key).'">'.esc_html($label).'</option>';
				}
				echo  '</select>';
				echo '<textarea name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="5" cols="20">' . esc_textarea( $field['value'] ) . '</textarea> ';
	
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</p>';
				break;
			case 'textarea':
				echo '<p  '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label><textarea name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="5" cols="20">' . esc_textarea( $field['value'] ) . '</textarea> ';
	
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</p>';
				break;
			case 'recipient':
				echo '<div  '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field "><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label>';
				//echo '<textarea name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="5" cols="20">' . esc_textarea( $field['value'] ) . '</textarea> ';
	
				$values = (array)$field['value'];
				echo '<table  cellspacing="0" data-name="' . esc_attr( $field['name'] ) . '" class="dhe-form-recipient-lists">';
				echo '<thead><tr><td>'.__('Email','dhe-form').'</td><td></td></tr></thead>';
				echo '<tbody>';
				foreach ($values as $val){
					echo '<tr>';
					echo '<td>';
					echo '<input type="text" name="' . esc_attr( $field['name'] ) . '[]" value="'.esc_attr($val).'" />';
					echo '</td>';
					echo '<td>';
					echo '<a href="#" class="button" onclick="return dhe_form_recipient_remove(this)">'.__('Remove','dhe-form').'</a>';
					echo '</td>';
					echo '</tr>';
				}
				echo '<thead><tr><td><a href="#" class="button" onclick="return dhe_form_recipient_add(this)">'.__('Add','dhe-form').'</a></td><td></td></tr></thead>';
				echo '</tbody>';
				echo '</table>';
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</div>';
				break;
					
			case 'checkbox':
	
				$field['cbvalue']       = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 'yes';
	
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field"><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label><input class="checkbox" type="checkbox" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . ' /> ';
	
				if ( ! empty( $field['description'] ) ) echo '<span class="description">' . ( $field['description'] ) . '</span>';
	
				echo '</p>';
				break;
			case 'checklist':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				
				if(!is_array($field['value']))
					$field['value'] = array();
				
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field"><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label>';
	
				foreach ( $field['options'] as $key => $value ) {
					echo '<input class="checkbox" type="checkbox" '.(in_array(esc_attr($key), $field['value']) ? 'checked':'').' name="' . esc_attr( $field['name'] ) . '[]" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $key ) . '"  /> '.esc_html( $value ) .'<br/>';
	
				}
	
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</p>';
				break;
			case 'select':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
	
				echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field"><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '">';
	
				foreach ( $field['options'] as $key => $value ) {
	
					echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
	
				}
	
				echo '</select> ';
	
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</p>';
				break;
			case 'select_recipient':
				$form_control = get_post_meta($post->ID,'_form_control',true);
				if($form_control){
					$form_control_arr = $form_control;
					if(is_array($form_control_arr) && !empty($form_control_arr)){
						$options = array();
						foreach ($form_control_arr as $control){
							if($control['tag'] == 'dhe_form_email'){
								$option_label = !empty($control['control_label']) ? $control['control_label'] : $control['control_name'];
								if(!empty($control['control_name']))
									$options[$control['control_name']] = $option_label;
							}
						}
						$field['options']       = $options;
	
						echo '<p '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field"><label for="' . esc_attr( $field['id'] ) . '">' . ( $field['label'] ) . '</label>';
						if(!empty($options)){
							echo '<select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '">';
							echo '<option value="" ></option>';
							foreach ( $field['options'] as $key => $value ) {
									
								echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
									
							}
								
							echo '</select> ';
						}
	
						if ( ! empty( $field['description'] ) ) {
	
							if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
								echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
							} else {
								echo '<span class="description">' . ( $field['description'] ) . '</span>';
							}
	
						}
						echo '</p>';
					}
				}
				break;
			case 'radio':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				echo '<fieldset '.$data_dependency.' class="form-field ' . esc_attr( $field['id'] ) . '_field"><legend>' . ( $field['label'] ) . '</legend><ul class="dhe-form-meta-radios">';
	
				foreach ( $field['options'] as $key => $value ) {
	
					echo '<li><label><input
				        		name="' . esc_attr( $field['name'] ) . '"
				        		value="' . esc_attr( $key ) . '"
				        		type="radio"
								class="radio"
				        		' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
				        		/> ' . esc_html( $value ) . '</label>
				    	</li>';
				}
				echo '</ul>';
	
				if ( ! empty( $field['description'] ) ) {
	
					if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
						echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' .DHE_FORM_URL . '/assets/images/help.png" height="16" width="16" />';
					} else {
						echo '<span class="description">' . ( $field['description'] ) . '</span>';
					}
	
				}
				echo '</fieldset>';
				break;
					
			default:
				break;
		}
	
	}
}

new DHE_Form_Metabox();