<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require './autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'Ae1IXIgNPrmSz0X3iZhElB-ueCAi4gZ6k4mW8o9uQxrnPbhwm06C0A021GVCVDLnp_7lRWIlnsdkAsbn',
    'client_secret' => 'EOOo40EQ5-JCnmQacX0lnhjG1oesyKIrIQaWVdCFK6XkuOH3v43c1YosMgjHryCAQB73o44Z1rK5rvo-',
    'return_url' => 'http://localhost/zelina.tech/payment/paypal/response.php',
    'cancel_url' => 'http://localhost/zelina.tech/payment/paypal/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'cc-eshop'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
