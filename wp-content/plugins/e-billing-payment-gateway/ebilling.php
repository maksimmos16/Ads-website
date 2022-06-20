<?php
/*
 * Plugin Name:   E-Billing Payment Gateway
 * Plugin URI:    https://www.billing-easy.com/
 * Description:   E-Billing Payment Gateway aggregates wallet platforms from mobile operators and banks in Africa.
 * Author:        Digitech Africa
 * Author URI:    https://www.digitech-africa.com/
 * License:       GPL-2.0+
 * License URI:   http://www.gnu.org/licenses/gpl-2.0.txt
 * Version:       1.0.9
 */

/*
 * This action hook registers PHP class as a WooCommerce payment gateway
 */
add_filter( 'woocommerce_payment_gateways', 'ebilling_add_gateway_class' );
function ebilling_add_gateway_class( $gateways ) {
    $gateways[] = 'WC_Ebilling_Gateway';
    return $gateways;
}

/*
 * The class itself, please note that it is inside plugins_loaded action hook
 */
add_action( 'plugins_loaded', 'ebilling_init_gateway_class' );
function ebilling_init_gateway_class() {
    class WC_Ebilling_Gateway extends WC_Payment_Gateway {
        public function __construct() {
            $this->id = 'ebilling';
            $this->icon = plugins_url('/assets/images/ebilling-payer.png', __FILE__);
            $this->has_fields = true;
            $this->method_title = 'E-Billing';
            $this->method_description = 'E-Billing Payment Gateway aggregates wallet platforms from mobile operators and banks in Africa. E-Billing does not process payment. Customers will be directed to E-Billing payment portal. This portal provides steps to validate payment with mobile wallet provider of customer.';

            $this->prod_server_url = 'https://www.billing-easy.com/api/v1/merchant/e_bills';
            $this->prod_redirect_url = 'https://www.billing-easy.net/checkoutnow';
            $this->lab_server_url = 'https://lab.billing-easy.net/api/v1/merchant/e_bills';
            $this->lab_redirect_url = 'https://test.billing-easy.net/checkoutnow';
            $this->staging_server_url = 'https://stg.billing-easy.com/api/v1/merchant/e_bills';
            $this->staging_redirect_url = 'https://staging.billing-easy.net/checkoutnow';

            // gateways can support subscriptions, refunds, saved payment methods,
            $this->supports = array(
                'products'
            );

            // Method with all the options fields
            $this->init_form_fields();

            // Load the settings.
            $this->init_settings();
            $this->enabled = $this->get_option( 'enabled' );
            $this->title = $this->get_option( 'title');
            $this->description = $this->get_option( 'description' );
            $this->enabled = $this->get_option( 'enabled' );
            $this->merchant_name = $this->get_option( 'merchant_name' );
            $this->merchant_sharedkey = $this->get_option( 'merchant_sharedkey' );
            $this->mode = $this->get_option( 'mode' );
            switch ($this->mode) {
                case 'LAB':
                    $this->server_url = $this->lab_server_url;
                    $this->redirect_url = $this->lab_redirect_url;
                    break;

                case 'STAGING':
                    $this->server_url = $this->staging_server_url;
                    $this->redirect_url = $this->staging_redirect_url;
                    break;

                case 'PROD':
                    $this->server_url = $this->prod_server_url;
                    $this->redirect_url = $this->prod_redirect_url;
                    break;

                default:
                    $this->server_url = $this->lab_server_url;
                    $this->redirect_url = $this->lab_redirect_url;
                    break;
            }
            $this->expiry_period = $this->get_option( 'expiry_period' );
            $this->transaction_description = $this->get_option( 'transaction_description' );

            // Site URL
            $this->siteUrl = get_site_url();

            // This action hook saves the settings
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options') );

            // Register a webhook
            add_action( 'woocommerce_api_digitech-epg-notify-payment', array( $this, 'webhook' ) );
        }

        /*
         * Plugin options
         */
        public function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title'       => 'Enable/Disable',
                    'label'       => 'Enable E-Billing Payment Gateway',
                    'type'        => 'checkbox',
                    'description' => '',
                    'default'     => 'no'
                ),
                'mode' => array(
                    'title'       => 'Deployment Mode',
                    'label'       => 'Deployment Mode',
                    'type'        => 'select',
                    'description' => 'This controls which E-Billing environment between LAB, Staging, and Production that this e-commerce platform is connected to. By default, LAB environment is set. Depending on the option chosen, you must provide Username & SharedKey that correspond to the environment.',
                    'default'     => 'LAB',
                    'options'     => array(
                        'LAB'     => 'LAB',
                        'STAGING' => 'STAGING',
                        'PROD'    => 'PROD',
                    ),
                    'desc_tip'    => true,
                ),
                'title' => array(
                    'title'       => 'Title',
                    'type'        => 'text',
                    'description' => 'This controls the title that user sees at checkout.',
                    'default'     => 'E-Billing',
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => 'Description',
                    'type'        => 'textarea',
                    'description' => 'This controls the description that user sees at checkout.',
                    'default'     => 'Pay securely with E-Billing platform. You will be directed to your mobile wallet operator or bank to validate payment.',
                    'desc_tip'    => true,
                ),
                'merchant_name' => array(
                    'title'       => 'E-Billing Username',
                    'type'        => 'text',
                    'description' => 'This is the merchant username in E-Billing platform. It is the same username used to login to E-Billing portal.',
                    'default'     => '',
                    'desc_tip'    => true,
                ),
                'merchant_sharedkey' => array(
                    'title'       => 'E-Billing SharedKey',
                    'type'        => 'password',
                    'description' => 'This is the merchant shared key in E-Billing platform. This information is obtained at merchant profile in E-Billing portal. This is used to authenticate merchant requests.',
                    'default'     => '',
                    'desc_tip'    => true,
                ),
                'expiry_period' => array(
                    'title'       => 'Payment Timeout',
                    'type'        => 'select',
                    'description' => 'Payment timeout',
                    'default'     => 60,
                    'desc_tip'    => true,
                    'options'     => array(
                        '0'       => __( 'No timeout' ),
                        '30'      => __( '30 min' ),
                        '60'      => __('1h'),
                        '180'     => __('3h'),
                        '360'     => __('6h'),
                        '720'     => __('12h'),
                        '1440'    => __('24h'),
                    )
                ),
                'transaction_description' => array(
                    'title'       => 'Transaction Description',
                    'type'        => 'text',
                    'description' => 'This controls the description of the transaction that user sees at time he validates payment with the operator or bank.',
                    'default'     => 'Merchant payment',
                    'desc_tip'    => true,
                ),
            );
        }

        /*
         * Fields validation
         */
        public function validate_fields() {
            return true;
        }

        /*
         * Response handled for payment gateway
         */
        public function process_payment( $order_id ) {
            $order = new WC_Order( $order_id );

            // Mark as on-hold (Awaiting the payment)
            $order->update_status( 'on-hold', __( 'Awaiting offline payment', 'wc-gateway-offline' ) );

            // Process E-Billing Payment
            $payload = array(
                'email'              => false,
                'sms'                => false,
                'payer_email'        => $order->get_billing_email(),
                'payer_msisdn'       => $order->get_billing_phone(),
                'amount'             => $order->get_total(),
                'short_description'  => $this->transaction_description . ' ' . $order->get_order_number(),
                'external_reference' => $order_id,
                'payer_name'         => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
                'expiry_period'      => $this->expiry_period,
            );

            $response = wp_remote_post( $this->server_url, array(
                'method'    => 'POST',
                'body'      => json_encode( $payload ),
                'sslverify' => false,
                'headers'   => array(
                    'Authorization' => 'Basic ' . base64_encode( $this->merchant_name . ':' . $this->merchant_sharedkey ),
                    'Content-type'  => 'application/json',
                ),
            ));
            $response_code = wp_remote_retrieve_response_code( $response );
            $response_body = json_decode(wp_remote_retrieve_body( $response ));

            if ( $response_code < 200 || $response_code > 299 ) {
                $error_message = '';
                if ( is_wp_error( $response ) ) {
                    $error_message = $response->get_error_message();
                } else {
                    $error_message = wp_remote_retrieve_body( $response );
                }
                $logger = wc_get_logger();
                $logger->error( $error_message, array( 'source' => 'ebilling' ) );
                throw new Exception( __( 'Unexpected error has occurred while processing the payment. The store owner has been notified. Please try again later.', $this->id ) );
            }

            $ebilling_id = $response_body->e_bill->bill_id;
            $order->update_meta_data( '_digitech_epg_ebilling_id', $ebilling_id );
            $order->save();

            $redirect_url = $this->redirect_url . '?invoice_number=' . $ebilling_id . '&merchant_redirect_url=' . $this->get_return_url( $order );

            // Redirect to E-Billing Portal
            return array(
                'result'   => 'success',
                'redirect' => $redirect_url,
            );
        }

        /*
         * E-Billing calls the Webhook to notify payment.
         */
        public function webhook() {
            global $woocommerce;

            $logger = wc_get_logger();

            $logger->info( 'Enter Webhook', array( 'source' => 'ebilling' ) );

            $error_message = '';
            foreach ($_POST as $key => $value) {
                $error_message .= htmlspecialchars($key) . ' -> ' . htmlspecialchars($value) . '<br>';
            }
            $logger->debug( $error_message, array( 'source' => 'ebilling' ) );

            try {
                $order = new WC_Order( intval($_POST['reference']) );

                $order->add_order_note( __( 'E-Billing payment completed.', 'ebilling' ) );

                // Add E-Billing response to meta data
                $order->update_meta_data( '_digitech_epg_amount', floatval($_POST['amount']) );
                $order->update_meta_data( '_digitech_epg_operator', sanitize_text_field($_POST['paymentsystem']) );
                $order->update_meta_data( '_digitech_epg_ebilling_id', sanitize_text_field($_POST['billingid']) );
                $order->update_meta_data( '_digitech_epg_transaction_id', sanitize_text_field($_POST['transactionid']) );
                $order->save();

                // Mark the payment completed
                $order->payment_complete( sanitize_text_field($_POST['transactionid']) );

                // Clear Cart
                $woocommerce->cart->empty_cart();

                // Reduce stock levels
                wc_reduce_stock_levels($order->id);

                header( 'HTTP/1.1 200 OK' );
            } catch (Exception $e) {
                $logger->error( $e, array( 'source' => 'ebilling' ) );

                header( 'HTTP/1.1 400 Bad Request' );
                echo $e->getMessage();die();
            } finally {
                $logger->info( 'Exit Webhook', array( 'source' => 'ebilling' ) );
            }

            return;
        }
    }
}