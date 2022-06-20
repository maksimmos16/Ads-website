<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DHE_Form_Paypal {
	public function __construct(){
		add_filter('dhe_form_ajax_json_echo', array($this,'crete_checkout_url'),10,2);
	}
	
	private function _get_paypal_url($form_id,$paypal_args){
		$pp_sandbox = dhe_form_get_post_meta('_paypal_sandbox',$form_id);
		return !empty($pp_sandbox) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr?test_ipn=1&'.$paypal_args:'https://www.paypal.com/cgi-bin/webscr?'.$paypal_args;
	}
	
	protected function _write_log($message, $level = 'info'){
		if(apply_filters('dhe_form_disable_paypal_log', true))
			return;
		$timestamp = current_time( 'timestamp' );
		$time_string = date('c',$timestamp);
		$level_string = strtoupper( $level );
		$entry = "{$time_string} {$level_string} {$message}";
		$dir = dhe_form_upload_dir('dir').'/logs';
		if ( ! wp_mkdir_p( $dir ) ) {
			return false;
		}
		$htaccess_file =  $dir . '/.htaccess';
		if ( !file_exists( $htaccess_file ) && $handle = fopen( $htaccess_file, 'w' ) ) {
			fwrite( $handle, 'Deny from all' . "\n" );
			fclose( $handle );
		}
		$file = $dir.'/paypal.log';
		if ( ! file_exists( $file ) ) {
			$temphandle = @fopen( $file, 'w+' );
			@fclose( $temphandle );
			if ( defined( 'FS_CHMOD_FILE' ) ) {
				@chmod( $file, FS_CHMOD_FILE );
			}
			if ( $resource = @fopen( $file, 'a' ) ) {
				fwrite( $resource, $message . PHP_EOL);
				fclose( $resource );
			}
		}
		return ;
	}
	
	protected function _create_order($form_id, $order_name, $order_amount, $order_number='', $quantity = 1){
		$account = dhe_form_get_post_meta('_paypal_email',$form_id);
		$currency = dhe_form_get_paypal_currency($form_id);
		$return_url = dhe_form_get_post_meta('_paypal_return_url',$form_id,'');
		$cancel_url = dhe_form_get_post_meta('_paypal_cancel_url',$form_id,'');
		$order = array(
			'upload'        	=> 1,
			'no_note'       	=> 1,
			'business'			=> $account,
			'currency_code'		=> $currency,
			'charset'			=> 'utf-8',
			'rm'				=> is_ssl() ? 2 : 1,// return method for return url, use 1 for GET
			'return'			=> esc_url_raw( add_query_arg( 'utm_nooverride', '1' ,$return_url )),
			'cancel_return'		=> esc_url_raw( $cancel_url ),
			'cbt'				=> get_bloginfo('name'),
			'bn'				=> 'WPPlugin_SP',
			'item_number'		=> $order_number,
			'item_name'			=> $order_name,
			'quantity'			=> $quantity,
			'amount'			=> $order_amount,
			'cmd'				=> '_xclick',
		);
		return apply_filters('dhe_form_paypal_order', $order, $form_id);
	}
	
	/**
	 * 
	 * @param DHE_Form_Submission $submission
	 */
	public function crete_checkout_url($result,$submission){
		$form_id = $submission->get_form_id();
		if(empty($form_id) || !$submission->is('success'))
			return $result;
		
		include_once DHE_FORM_DIR.'/includes/eval-math.php';
		
		$form_checkout = dhe_form_get_post_meta('_paypal_checkout',$form_id);
		$checkout_url = '';
		if(!is_null($submission->get_posted_data('_dhe_form_paypal'))){
			$pp_field = (array) $submission->get_form_field('_dhe_form_paypal_field');
			
			$pp_items = (array) json_decode(base64_decode($pp_field['item_list']));
			$pp_amount = 0;
			$posted_data = $submission->get_posted_data();
			$posted_data = array_map('dhe_form_to_int',$posted_data);
			foreach ($pp_items as $item){
				if(is_numeric($item->price)){
					$pp_amount += floatval($item->price);
				}else{
					$math = str_replace(array_keys($posted_data), $posted_data, $item->price);
					$math = preg_replace('[^0-9\+-\*\/\(\) ]','',$math);
					$compute = DHE_Form_Eval_Math::evaluate($math);
					$pp_amount += $compute;
				}
			}
			$order_name = isset($pp_field['order_description']) ? esc_html($pp_field['order_description']) : 'DHE Form Order';
			$order_amount = $pp_amount;
			$order_amount = dhe_form_get_number($order_amount);
			
			$order = $this->_create_order($form_id, $order_name, $order_amount);
			$paypal_args = http_build_query($order,'', '&' );
			$checkout_url = $this->_get_paypal_url($form_id,$paypal_args);
			
		}elseif(!empty($form_checkout)){
			$order_number = dhe_form_get_post_meta('_paypal_order_id',$form_id);
			$order_name = dhe_form_get_post_meta('_paypal_order_description',$form_id);
			$order_amount = dhe_form_get_post_meta('_paypal_order_price',$form_id);
			$order_amount = dhe_form_get_number($order_amount);
			
			$order = $this->_create_order($form_id, $order_name, $order_amount, $order_number);
			$paypal_args = http_build_query($order,'', '&' );
			$checkout_url = $this->_get_paypal_url($form_id,$paypal_args);
		}
		if(!empty($checkout_url)){
			$this->_write_log('PayPal Request Args in form ID: '.$form_id.': ' . print_r( $paypal_args, true ) );
			$result['redirect'] = $checkout_url;
		}
		return $result;
	}
	
	
}
new DHE_Form_Paypal();