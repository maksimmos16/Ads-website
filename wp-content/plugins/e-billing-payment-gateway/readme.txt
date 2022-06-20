=== E-Billing Payment Gateway ===
Contributors: faboghe
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=GVEA6PSN5EWAG&source=url
Tags: woocommerce, payment gateway, e-billing
Stable tag: 1.0
Requires PHP: 5.3
Requires at least: 5.0
Tested up to: 5.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This E-Billing plugin for WooCommerce allows you to accept payments from mobile wallets of operators and banks on your WooCommerce store.
E-Billing is a payment gateway that aggregates mobile wallets of operators and banks in Gabon and Africa.


== Description ==

This is the official WooCommerce plugin of the E-Billing payment gateway.

This E-Billing plugin for WooCommerce allows you to accept payments from mobile wallets of operators and banks on your WooCommerce store.
E-Billing is a payment gateway that aggregates mobile wallets of operators and banks in Gabon and Africa.

E-Billing currently integrates the following mobile wallets:
-      Airtel Money (Gabon)
-      MobiCach (Gabon)

Only WooCommerce stores in Gabon can therefore use this plugin at the moment.
E-Billing does not manage any financial flows, all payments are validated by the mobile wallet. Customer is redirected to E-Billing portal which displays instructions for paying per wallet provider. Once the payment is validated by the operator or the bank, E-Billing is automatically notified and in return notifies the merchant of the validation of the payment. This plugin automates all this notification process.
This plugin comes with 3 deployment modes: LAB, STAGING, and PROD. By default, LAB Mode is active. It is highly recommended to test your integration in E-Billing LAB environment before you move to STAGING or PROD.


== Installation ==

= Automatic installation =
* Log in to your WordPress administration area.
* Go to "Plugins> Add new" in the left menu.
* In the search box, type "E-Billing Payment Gateway".
* From the search result, you will see "E-Billing Payment Gateway" click "Install now" to install the plugin.
* A popup window will ask you to confirm your wish to install the plugin.

= Manual installation =
1. Download the .zip file.
2. Unpack and upload the `ebilling` folder to the `/wp-content/plugins` directory.
3. Activate the plugin through the `Plugins` menu in WordPress.
4. Open the settings page for WooCommerce and click on the `Payment gateways` tab.
5. Enable `E-Billing` plugin.
6. Configure your `E-Bbilling` parameters. See below for more details.

= Configuration Parameters =
* __Enable / Disable__ - This controls to enable E-Billing Payment Gateway.
* __Deployment Mode__ - This controls which E-Billing environment between LAB, Staging, and Production that this e-commerce platform is connected to. By default, LAB environment is set. Depending on the option chosen, you must provide Username & SharedKey that correspond to the environment.
* __Title__ - This controls the title that user sees at checkout.
* __Description__ - This controls the description that user sees at checkout.
* __E-Billing Username__ - This is the merchant username in E-Billing platform. It is the same username used to login to E-Billing portal.
* __E-Billing SharedKey__ - This is the merchant shared key in E-Billing platform. This information is obtained at merchant profile in E-Billing portal. This is used to authenticate merchant requests.
* __Payment Timeout__ - This controls Payment timeout.
* __Transaction Description__ - This controls the description of the transaction that user sees at time he validates payment with the operator or bank.

= Setup on E-Billing Payment Gateway =
1. Login to E-Billing: `https://lab.billing-easy.net` (LAB), or `https://stg.billing-easy.com` (Staging), or `https://www.billing-easy.com` (Production).
2. Access your profile.
3. Click on Edit on top right.
4. Edit notification URL (`https://your-store-domain/wc-api/digitech-epg-notify-payment`).
5. Select following params: `billingid`, `reference`, `transactionid`, `amount`.


== Frequently Asked Questions ==

= What are the system requirements for using E-Billing? =
E-Billing has been successfully tested with Wordpress 5.0 to 5.7 on PHP5.3 and PHP7.  If you have problems on these (or other) configurations, feel free to contact via the [Digitech Africa Contact Forum](https://www.digitech-africa.com/contact).

= What do I need to use the plugin?
You must register E-Billing: `https://lab.billing-easy.net` (LAB), or `https://stg.billing-easy.com` (Staging), or `https://www.billing-easy.com` (Production) to obtain the username and shared key.


== Changelog ==
–Version 1.0.0–
This is the initial release of the plugin.
–Version 1.0.1–
Added debug logic.
–Version 1.0.2–
Fixed debug.
Updated Webhook.
–Version 1.0.3–
Debug Webhook.
–Version 1.0.4–
Updated Webhook.
–Version 1.0.5–
Updated error handler.
–Version 1.0.6–
Updated log level.
–Version 1.0.7–
Updated Webhook response.
–Version 1.0.8–
Tested on the latest Wordpress release.
–Version 1.0.9–
Add new payment mode for sandbox test.

== Screenshots ==
1. Settings of E-Billing Plugin on Woocommerce
2. E-Billing Plugin on Checkout Page
3. E-Billing Page
4. Setup Callback Configration in E-Billing