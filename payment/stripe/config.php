<?php 
// Product Details 
// Minimum amount is $0.50 US 
// Test Stripe API configuration 

define('STRIPE_API_KEY', 'sk_test_51MFifRHCJ0fQpPqig4198VIJ3HZykwAP1YQsFo3bWryN0cPPg6BZp93k3nf5YdGYiZwMHk7e3mVVyvz0gYA6exIk00bmDLp6Dy');  
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51MFifRHCJ0fQpPqisowEtMKpOTcKSlwMeTxFYX9j4Fa2mRYB3lvZbgjl60YUKucwYr2QnPy31YZRwUIbUWmIJTG500qBRshtqF'); 

define('STRIPE_SUCCESS_URL', 'http://localhost/zelina.tech/payment/stripe/success.php'); 
define('STRIPE_CANCEL_URL', 'http://localhost/zelina.tech/payment/stripe/cancel.php'); 

// Database configuration   
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'codeat21'); 
?>



