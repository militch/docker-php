<?php
if ( ! class_exists( 'Kirki' ) ) {
	return;
}
// Use Google CDN
add_filter( 'kirki_use_local_fonts', '__return_false' );

// Core Functions
function thb_customizer_field( $settings ) {
	return Kirki::add_field(
		'restoration',
		$settings
	);
}

// Functions
function thb_payment_icons_array() {
	$array = array(
		'amazon'                 => 'Amazon',
		'american-express'       => 'American Express',
		'american-express-alt'   => 'American Express - 2',
		'atm'                    => 'atm',
		'bankomat'               => 'Bankomat',
		'bank-transfer'          => 'Bank Transfer',
		'bitcoin'                => 'Bitcoin',
		'bitcoin-sign'           => 'Bitcoin Sign',
		'braintree'              => 'BrainTree',
		'btc'                    => 'BTC',
		'card'                   => 'Card',
		'carta-si'               => 'Carta Si',
		'cash'                   => 'Cash',
		'cash-on-delivery'       => 'Cash On Delivery',
		'cb'                     => 'CB',
		'cirrus'                 => 'Cirrus',
		'cirrus-alt'             => 'Cirrus - 2',
		'clickandbuy'            => 'Click and Buy',
		'credit-card'            => 'Credit Card',
		'diners'                 => 'Diners',
		'discover'               => 'Discover',
		'ec'                     => 'EC',
		'eps'                    => 'EPS',
		'eur'                    => 'EURO',
		'facture'                => 'Facture',
		'fattura'                => 'Fattura',
		'flattr'                 => 'Flattr',
		'giropay'                => 'GiroPay',
		'google-wallet'          => 'Google Wallet - Alt',
		'gpb'                    => 'GPB',
		'gratipay'               => 'GratiPay',
		'ideal'                  => 'Ideal',
		'ils'                    => 'ILS',
		'inr'                    => 'INR',
		'invoice'                => 'Invoice',
		'jcb'                    => 'JCB',
		'jpy'                    => 'JPY',
		'krw'                    => 'KRW',
		'maestro'                => 'Maestro',
		'maestro-alt'            => 'Maestro - 2',
		'mastercard'             => 'MasterCard',
		'mastercard-alt'         => 'MasterCard - 2',
		'mastercard-securecode'  => 'MasterCard - Secure Code',
		'ogone'                  => 'Ogone',
		'paybox'                 => 'PayBox',
		'paylife'                => 'PayLife',
		'paypal'                 => 'PayPal',
		'paypal-alt'             => 'PayPal - 2',
		'paysafecard'            => 'PaySafe Card',
		'postepay'               => 'Poste Pay',
		'quick'                  => 'Quick',
		'rechnung'               => 'Rechnung',
		'ripple'                 => 'Ripple',
		'rub'                    => 'RUB',
		'skrill'                 => 'Skrill',
		'sofort'                 => 'SoFort',
		'square'                 => 'Square',
		'stripe'                 => 'Stripe',
		'truste'                 => 'TrustE',
		'try'                    => 'TRY',
		'unionpay'               => 'Union Pay',
		'usd'                    => 'USD',
		'verified-by-visa'       => 'Verified by Visa',
		'verisign'               => 'VeriSign',
		'visa'                   => 'VISA',
		'visa-electron'          => 'Visa Electron',
		'western-union'          => 'Western Union',
		'western-union-alt'      => 'Western Union - 2',
		'wirecard'               => 'Wire Card',
		'sepa'                   => 'Sepa',
		'sepa-alt'               => 'Sepa - 2',
		'apple-pay'              => 'Apple Pay',
		'interac'                => 'Interac',
		'dankort'                => 'Dankort',
		'bancontact-mister-cash' => 'Bancontact Mister Cash',
		'moip'                   => 'Moip',
		'pagseguro'              => 'Pagseguro',
		'cash-on-pickup'         => 'Cash on Pickup',
		'sage'                   => 'Sage',
		'elo'                    => 'Elo',
		'elo-alt'                => 'Elo - 2',
		'payu'                   => 'Pay U',
		'mercado-pago'           => 'Mercado Pago',
		'payshop'                => 'PayShop',
		'multibanco'             => 'Multi Banco',
		'six'                    => 'Six',
		'cashcloud'              => 'Cash Cloud',
		'klarna'                 => 'Klarna',
		'bitpay'                 => 'Bitpay',
		'venmo'                  => 'Venmo',
		'visa-debit'             => 'Visa Debit',
		'alipay'                 => 'Ali Pay',
		'hipercard'              => 'Hipercard',
		'direct-debit'           => 'Direct Debit',
		'sodexo'                 => 'Sodexo',
		'bpay'                   => 'B Pay',
		'contactless'            => 'Contactless',
		'eth'                    => 'ETH',
		'ltc'                    => 'LTC',
		'visa-pay'               => 'Visa Pay',
		'wechat-pay'             => 'WeChat Pay',
		'amazon-pay'             => 'Amazon Pay',
		'amazon-pay-alt'         => 'Amazon Pay - 2',
	);
	return $array;
}

// Pages
Kirki::add_config(
	'restoration',
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

Kirki::add_panel(
	'restoration',
	array(
		'priority'    => 1,
		'title'       => esc_html__( 'Restoration', 'restoration' ),
		'description' => esc_html__( 'Restoration Theme Settings', 'restoration' ),
	)
);
$kirki_settings = array(
	'subheader',
	'header',
	'header-secondary',
	'blog',
	'article',
	'shop',
	'colors',
	'backgrounds',
	'typography',
	'mobilemenu',
	'footer',
	'subfooter',
);
foreach ( $kirki_settings as $val ) {
	require_once get_parent_theme_file_path( '/inc/framework/kirki/' . $val . '.php' );
}

// Output Customizer
function thb_customizer( $key, $default = false ) {
	$r = get_theme_mod( $key, $default );

	return $r;
}
